define(["require", "exports", "../../request", "../../core/promiseUtils", "../2d/tiling/enums", "./WorkerTile", "./style/StyleRepository"], function (require, exports, esriRequest, promiseUtils, enums_1, WorkerTile, StyleRepository) {
    /**
     * WorkerTileHandler is the target module loaded by the worker thread. It is responsible for loadind and parsing vector-tiles.
     */
    var WorkerTileHandler = /** @class */ (function () {
        function WorkerTileHandler() {
            //--------------------------------------------------------------------------
            //
            //  Life cycle
            //
            //--------------------------------------------------------------------------
            /**
             * An dictionary of tileId to parsed vector-tile data. Each parsed-tile is kept by the worker for the duration of the lifetime of the tile.
             * This is needed in order to allow recalculation of the labels collision when the map's rotation changes. Once the tile
             * gets destructed it signals the owner worker to discard the parsed tile-data.
             * @type {HashMap<WorkerTile>} the dictionary of tileId to parsed vector-tile data
             * @private
             */
            this._tiles = new Map();
            /**
             * A dictionary of sprite name to sprite metric {SpriteMosaicItem}
             * @type {HashMap<SpriteMosaicItem>}
             * @private
             */
            this._spriteInfo = {};
            /**
             * A dictionary of font to glyph metric array. within the array, each glyph is referenced by the glyph Id.
             * @type {HashMap<GlyphMosaicItem[]>}
             * @private
             */
            this._glyphInfo = {}; // array of glyph indexed by code point, mapped by font
        }
        //--------------------------------------------------------------------------
        //
        //  Public Methods
        //
        //--------------------------------------------------------------------------
        /**
         * Reset the worker-handler info. we need to reset all the worker's resources. This will usually happen in a case
         * where the device resolution had changed and the data that the worker is holding onto is no longer relevant, or when
         * The user changes the style being used.
         * This is followed by a cancellation of all pending tile requests made from the main thread.
         * @private
         * @return {promise.Promise<any>}
         */
        WorkerTileHandler.prototype.reset = function () {
            this._spriteInfo = {};
            this._glyphInfo = {};
            // reset all tiles
            var tiles = this._tiles;
            tiles.forEach(function (workerTile) { return workerTile.setObsolete(); });
            tiles.clear();
            return promiseUtils.resolve();
        };
        /**
         * Return the array of style layers defining the style used with the service
         * @returns {StyleLayer[]}
         */
        WorkerTileHandler.prototype.getLayers = function () {
            return this._layers;
        };
        /**
         * Sets the JSON payload of the style-layers defining the style used with the service
         * @param params {any} the raw JSON payload with the style info
         * @returns {IPromise<{data: string}>}
         */
        WorkerTileHandler.prototype.setLayers = function (params) {
            var styleRepo = new StyleRepository(params);
            this._layers = styleRepo.layers;
            return promiseUtils.resolve({ data: "" });
        };
        // TODO: we need to define what we pass back with the promise (this is where we return the metadata and the buffers)
        /**
         * Gets and parse a requested vector-tile
         * @param params {{key: string; refKey: string, rotation: number, cacheTile: boolean}} the request information serialized from the main thread.
         * It includes the requested tile, the reference tile and the map's rotation.
         * @param options {RemoteClient} a worker connection allowing the implemntation to call on the main thread and
         * request resources such as sprite and glyph metrics
         * @return a promise with the parsed tile data together with
         * an array of transferable array-buffers.
         */
        WorkerTileHandler.prototype.getTile = function (params, options) {
            var _this = this;
            var key = params.key, cacheTile = params.cacheTile;
            var tile = WorkerTile.pool.acquire();
            tile.initialize(params.key, params.refKey, this, params.rotation);
            // invoke the request
            return esriRequest(params.url, {
                responseType: "array-buffer",
                signal: options && options.signal
            })
                .then(function (response) { return tile.setDataAndParse(response.data, options); })
                .then(function (parseParams) {
                // when parsing is done simply resolve the promise with the data and transferables
                // this includes all the data that is needed to be transferred back to the main thread
                // add the key to the tiles dictionary
                // only upon success add the tile to the tiles list
                if (cacheTile && tile.status !== enums_1.TileStatus.INVALID) {
                    _this._tiles.set(key, tile);
                }
                return parseParams; // data and buffers...
            })
                .catch(function (error) {
                tile.setObsolete();
                WorkerTile.pool.release(tile);
                if (_this._tiles.has(tile.tileKey)) {
                    _this._tiles["delete"](tile.tileKey);
                }
                return promiseUtils.reject(error);
            })
                .catch(function (error) {
                return error;
            })
                .then(function (resultOrError) {
                if (!cacheTile) {
                    WorkerTile.pool.release(tile);
                }
                return resultOrError;
            });
        };
        /**
         * Updating an existing tile'd symbol data given a map's rotation
         * @param params {{key: string; rotation: number }} serialized params with the tile Id to update and the new map's rotation
         * @returns a promise with the parsed tile'd symbol data together with
         * an array of transferable array-buffers.
         */
        WorkerTileHandler.prototype.updateSymbols = function (params) {
            var workerTile = this._tiles.get(params.key);
            if (!workerTile) {
                return promiseUtils.reject();
            }
            return workerTile.updateSymbols(params.rotation);
        };
        WorkerTileHandler.prototype.updateStyle = function (params, options) {
            var styleRepo = new StyleRepository(params);
            this._layers = styleRepo.layers;
            // we need to issue an update of all the tiles which we are holding onto
            this._tiles.forEach(function (tile, key) {
                tile.reparse(options).then(function (reparsedParams) {
                    // we need to invoke a method which will assign the new payload to the tile
                    options.client.invoke("updateTileData", {
                        tileId: tile.tileKey,
                        tileData: reparsedParams.result
                    });
                });
            });
            return promiseUtils.resolve({ data: "" });
        };
        /**
         * Instruct the worker-handler to discard the parsed payload of a given tile. Once a tile get disposed it signals the
         * worker to discard its payload since until that point it may request the wrker to update the tile's symbols
         * @param params {{key: string}} the tile Id to get discarded
         * @returns {IPromise<void>}
         */
        WorkerTileHandler.prototype.destructTileData = function (key) {
            if (this._tiles.has(key)) {
                WorkerTile.pool.release(this._tiles.get(key));
                this._tiles["delete"](key);
            }
            return promiseUtils.resolve();
        };
        // ensure sprites are in the cache
        /**
         * Gets the metrics for a set of sprites. If the worker is not already holding onto the metric for a given sprite it will
         * fetch it from the main thread.
         * @param sprites {Set<string>} a set with sprite Ids needed.
         * @param connection {RemoteClient} a worker connection allowing the implemntation to call on the main thread and
         * request resources such as sprite and glyph metrics
         * @returns {IPromise<void>} a promise which gets resolved once all requested sprite metrics are available
         */
        WorkerTileHandler.prototype.fetchSprites = function (sprites, connection) {
            // this is the list of sprite items that we need to get from the main thread
            var spritesToFetch = [];
            // iterating over the existing cached items and get all the ones that already exists on the worker side
            var spriteInfo = this._spriteInfo;
            sprites.forEach(function (sprite) {
                // check whether the sprite exists
                var spriteItem = spriteInfo[sprite];
                if (spriteItem === undefined) {
                    // we need to go and fetch the metrics for this sprite item
                    spritesToFetch.push(sprite);
                }
            });
            // we need to see what we already have:
            // if we already have all the sprites that the caller asked we can immediately resolve the promise
            if (spritesToFetch.length === 0) {
                return promiseUtils.resolve();
            }
            // we don't have all the items that the caller asked, therefore we need to fetch them from the main thread
            return connection.invoke("getSprites", spritesToFetch).then(function (spriteItems) {
                for (var spriteName in spriteItems) {
                    var spriteItem = spriteItems[spriteName];
                    // spriteItem may be null if the sprite does not exist
                    spriteInfo[spriteName] = spriteItem;
                }
            });
        };
        /**
         * Get the dictionary of sprite metrics owned by this worker
         * @returns {HashMap<SpriteMosaicItem>}
         */
        WorkerTileHandler.prototype.getSpriteItems = function () {
            return this._spriteInfo;
        };
        // ensure glyphs are in the cache
        /**
         * Get the metrics for a set of code-points for a given font needed for a tile being parsed. If the worker is not holding
         * onto the requested metrics it would request it from the main thread.
         * @param tileID {string} an encoded tile Id which is the tile being parsed
         * @param font {string} the font that the code-points belong to
         * @param codePoints {Set<number>} a set of code-point needed by the parsed tile
         * @param connection {RemoteClient} a worker connection allowing the implemntation to call on the main thread and
         * request resources such as sprite and glyph metrics
         * @returns {IPromise<void>}  a promise which gets resolved once all requested code-point metrics are available
         */
        WorkerTileHandler.prototype.fetchGlyphs = function (tileID, font, codePoints, connection) {
            // this is the list of glyph items that we need to get from the main thread
            var codePointsToFetch = [];
            var fontGlyphs = this._glyphInfo[font];
            if (!fontGlyphs) {
                // prepare a valid font stack
                fontGlyphs = this._glyphInfo[font] = [];
                // ask for all code points
                codePoints.forEach(function (cp) { return codePointsToFetch.push(cp); });
            }
            else {
                codePoints.forEach(function (cp) {
                    var glyphItem = fontGlyphs[cp];
                    if (!glyphItem) {
                        codePointsToFetch.push(cp);
                    }
                });
            }
            if (codePointsToFetch.length === 0) {
                return promiseUtils.resolve();
            }
            return connection
                .invoke("getGlyphs", {
                tileID: tileID,
                font: font,
                codePoints: codePointsToFetch
            })
                .then(function (glyphItems) {
                for (var codePoint in glyphItems) {
                    fontGlyphs[codePoint] = glyphItems[codePoint];
                }
            });
        };
        /**
         * Gets the glyph metrics for a given font
         * @param font {string} the name of the font
         * @returns {GlyphMosaicItem[]} an array with glyph metrics
         */
        WorkerTileHandler.prototype.getGlyphItems = function (font) {
            return this._glyphInfo[font];
        };
        return WorkerTileHandler;
    }());
    return WorkerTileHandler;
});
