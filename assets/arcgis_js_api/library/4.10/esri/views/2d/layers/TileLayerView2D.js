// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../core/tsSupport/declareExtendsHelper ../../../core/tsSupport/decorateHelper ../../../core/Error ../../../core/promiseUtils ../../../core/accessorSupport/decorators ../engine/BitmapContainer ../engine/BitmapTile ./LayerView2D ./support/popupUtils2D ../tiling/TileInfoView ../tiling/TileKey ../tiling/TileQueue ../tiling/TileStrategy ../../layers/TileLayerView".split(" "),function(B,C,n,p,h,t,k,q,l,r,u,v,w,x,y,z){var A=[0,0];return function(f){function c(){var a=null!==
f&&f.apply(this,arguments)||this;a._tileStrategy=null;a._tileInfoView=null;a._fetchQueue=null;a._tileRequests=new Map;a.container=new q.BitmapContainer;a.layer=null;return a}n(c,f);c.prototype.initialize=function(){var a=this.layer.tileInfo,a=a&&a.spatialReference,b;a||(b=new h("layerview:tiling-information-missing","The layer doesn't provide tiling information",{layer:this.layer}));a.equals(this.view.spatialReference)||(b=new h("layerview:spatial-reference-incompatible","The spatial reference of this layer does not meet the requirements of the view",
{layer:this.layer}));b&&this.addResolvingPromise(t.reject(b))};c.prototype.hitTest=function(a,b){return null};c.prototype.update=function(a){this._fetchQueue.pause();this._fetchQueue.state=a.state;this._tileStrategy.update(a);this._fetchQueue.resume();this.notifyChange("updating")};c.prototype.attach=function(){var a=this;this._tileInfoView=new v(this.layer.tileInfo,this.layer.fullExtent);this._fetchQueue=new x({tileInfoView:this._tileInfoView,tileServers:"tileServers"in this.layer?this.layer.tileServers:
null,concurrency:this.layer.url&&-1!==this.layer.url.indexOf("tiles.arcgis.com")?12:6,process:function(b,c){return a.fetchTile(b,c)}});this._tileStrategy=new y({cachePolicy:"keep",acquireTile:function(b){return a.acquireTile(b)},releaseTile:function(b){return a.releaseTile(b)},tileInfoView:this._tileInfoView})};c.prototype.detach=function(){this._tileStrategy.destroy();this._fetchQueue.clear();this.container.removeAllChildren();this._fetchQueue=this._tileStrategy=this._tileInfoView=null};c.prototype.moveStart=
function(){this.requestUpdate()};c.prototype.viewChange=function(){this.requestUpdate()};c.prototype.moveEnd=function(){this.requestUpdate()};c.prototype.createFetchPopupFeaturesQueryGeometry=function(a,b){return u.createQueryGeometry(a,b,this.view)};c.prototype.doRefresh=function(){var a=this;this.updateRequested||this.suspended||(this._fetchQueue.reset(),this._tileStrategy.tiles.forEach(function(b){return a._enqueueTileFetch(b)}),this.notifyChange("updating"))};c.prototype.isUpdating=function(){var a=
!0;this._tileRequests.forEach(function(b){a=a&&b.isFulfilled()});return!a};c.prototype.getTileBounds=function(a,b){return this._tileInfoView.getTileBounds(a,b)};c.prototype.getTileCoords=function(a,b){return this._tileInfoView.getTileCoords(a,b)};c.prototype.getTileResolution=function(a){return this._tileInfoView.getTileResolution(a)};c.prototype.acquireTile=function(a){var b=l.BitmapTile.pool.acquire();b.key.set(a);a=this._tileInfoView.getTileCoords(A,b.key);b.x=a[0];b.y=a[1];b.resolution=this._tileInfoView.getTileResolution(b.key);
this._enqueueTileFetch(b);this.requestUpdate();return b};c.prototype.releaseTile=function(a){var b=this,c=this._tileRequests.get(a);c&&!c.isFulfilled()&&c.cancel();this._tileRequests.delete(a);this.container.removeChild(a);a.once("detach",function(){l.BitmapTile.pool.release(a);b.requestUpdate()});this.requestUpdate()};c.prototype.fetchTile=function(a,b){var c=this;if(b="tilemapCache"in this.layer?this.layer.tilemapCache:null){var d=w.pool.acquire();return b.fetchAvailabilityUpsample(a.level,a.row,
a.col,d).then(function(){return c._fetchImage(d)}).catch(function(b){if("AbortError"===b.name)throw b;return c._fetchImage(a)}).then(function(b){if(d.level===a.level)return b;var g=c._tileInfoView.tileInfo.size,m=c._tileInfoView.getTileResolution(d.level),f=c._tileInfoView.getTileResolution(a.level),e=c._tileInfoView.getLODInfoAt(a.level),h=e.getXForColumn(a.col),k=e.getYForRow(a.row),e=c._tileInfoView.getLODInfoAt(d.level),l=e.getXForColumn(d.col),e=e.getYForRow(d.row),n=Math.round((h-l)/m),p=Math.round(-(k-
e)/m),q=Math.round(f/m*g[0]),r=Math.round(f/m*g[1]);return t.create(function(a){var c=document.createElement("canvas"),d=c.getContext("2d");c.width=g[0];c.height=g[1];d.drawImage(b,n,p,q,r,0,0,g[0],g[1]);a(c)})})}return this._fetchImage(a)};c.prototype._enqueueTileFetch=function(a){var b=this;if(!this._fetchQueue.has(a.key)){var c=this._fetchQueue.push(a.key).then(function(c){a.source=c;a.width=b._tileInfoView.tileInfo.size[0];a.height=b._tileInfoView.tileInfo.size[1];a.once("attach",function(){return b.requestUpdate()});
b.container.addChild(a);b.requestUpdate()});this._tileRequests.set(a,c)}};c.prototype._fetchImage=function(a){return this.layer.fetchTile(a.level,a.row,a.col,{timestamp:this.refreshTimestamp})};return c=p([k.subclass("esri.views.2d.layers.TileLayerView2D")],c)}(k.declared(r,z))});