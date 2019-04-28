// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../core/tsSupport/extendsHelper dojo/Deferred ../../../Graphic ../support/FeatureSet ../support/IdSet ../support/shared ../../../geometry/Geometry ../../../layers/support/Field ../../../tasks/support/Query ../polyfill/FeatureLayerAndTable".split(" "),function(z,A,u,m,v,w,p,h,x,q,r,y){return function(t){function d(a){var b=t.call(this,a)||this;b.declaredClass="esri.arcade.featureset.sources.FeatureLayerMemory";b._removeGeometry=!1;b._overrideFields=null;a.spatialReference&&
(b.spatialReference=a.spatialReference);b._transparent=!0;b._maxProcessing=1E3;b._layer=a.layer;b._wset=null;void 0!==a.outFields&&(b._overrideFields=a.outFields);void 0!==a.includeGeometry&&(b._removeGeometry=!1===a.includeGeometry);return b}u(d,t);d.prototype._maxQueryRate=function(){return h.defaultMaxRecords};d.prototype.end=function(){return this._layer};d.prototype.optimisePagingFeatureQueries=function(a){};d.prototype.load=function(){var a=this;null===this._loadPromise&&(this._loadPromise=
new m);null!==this._layer&&(!0===this._layer.loaded?!1===this._loadPromise.isFulfilled()&&(this._initialiseFeatureSet(),this._loadPromise.resolve(this)):(this._layer.when(function(){try{a._initialiseFeatureSet(),a._loadPromise.resolve(a)}catch(b){a._loadPromise.reject(b)}},function(b){a._loadPromise.reject(b)}),this._layer.load()));return this._loadPromise.promise};d.prototype._initialiseFeatureSet=function(){null==this.spatialReference&&(this.spatialReference=this._layer.spatialReference);this.geometryType=
this._layer.geometryType;!0===this._layer.handleAsTable&&(this.geometryType="");this.fields=this._layer.fields.slice(0);if(1!==this._layer.outFields.length||"*"!==this._layer.outFields[0]){for(var a=[],b=0,e=this.fields;b<e.length;b++){var c=e[b];if("oid"===c.type)a.push(c);else for(var g=0,d=this._layer.outFields;g<d.length;g++){var f=d[g];if(f.toLowerCase()===c.name.toLowerCase()){a.push(c);break}}}this.fields=a}if(null!==this._overrideFields)if(1===this._overrideFields.length&&"*"===this._overrideFields[0])this._overrideFields=
null;else{a=[];b=[];e=0;for(g=this.fields;e<g.length;e++)if(c=g[e],"oid"===c.type)a.push(c),b.push(c.name);else for(var d=0,k=this._overrideFields;d<k.length;d++)if(f=k[d],f.toLowerCase()===c.name.toLowerCase()){a.push(c);b.push(c.name);break}this.fields=a;this._overrideFields=b}this.objectIdField=this._layer.objectIdField;this.hasM=this._layer.supportsM;this.hasZ=this._layer.supportsZ;this._databaseType=h.FeatureServiceDatabaseType.Standardised;this.typeIdField=this._layer.typeIdField;this.types=
this._layer.types};d.prototype.isTable=function(){return"table"===this._layer.type||!0===this._layer.handleAsTable||!this._layer.geometryType};d.prototype._isInFeatureSet=function(a){return h.IdState.InFeatureSet};d.prototype._transformSetWithIdChanges=function(a){};d.prototype._candidateIdTransform=function(a){return a};d.prototype._getSet=function(a){var b=this,e=new m;null===this._wset?this._ensureLoaded().then(h.callback(function(){b._getFilteredSet("",null,null,null,a).then(function(a){b._wset=
a;e.resolve(a)},h.errback(e))},e),h.errback(e)):e.resolve(this._wset);return e.promise};d.prototype._changeFeature=function(a){for(var b={},e=0,c=this.fields;e<c.length;e++){var d=c[e];b[d.name]=a.attributes[d.name]}return new v({geometry:!0===this._removeGeometry?null:a.geometry,attributes:b})};d.prototype._getFilteredSet=function(a,b,e,c,d){var g=this,f=new m,k="",n=!1;null!==c&&(k=c.constructClause(),n=!0);if(this.isTable()&&b&&null!==a&&""!==a)return a=new p([],[],!0,null),f.resolve(a),f.promise;
c=new r;c.where=null===e?null===b?"1\x3d1":"":e.toWhereClause(h.FeatureServiceDatabaseType.Standardised);c.spatialRelationship=this._makeRelationshipEnum(a);c.outSpatialReference=this.spatialReference;c.orderByFields=""!==k?k.split(","):null;c.geometry=null===b?null:b;c.returnGeometry=!0;c.relationParameter=this._makeRelationshipParam(a);this._layer.queryFeatures(c).then(h.callback(function(a){if(null===a)f.resolve(new p([],[],n,null));else{g._checkCancelled(d);var b=[];a.features.forEach(function(a){var c=
a.attributes[g._layer.objectIdField];b.push(c);g._featureCache[c]=g._changeFeature(a)});a=new p([],b,n,null);f.resolve(a)}},f),h.errback(f));return f.promise};d.prototype._makeRelationshipEnum=function(a){if(0<=a.indexOf("esriSpatialRelRelation"))return"relation";switch(a){case "esriSpatialRelRelation":return"relation";case "esriSpatialRelIntersects":return"intersects";case "esriSpatialRelContains":return"contains";case "esriSpatialRelOverlaps":return"overlaps";case "esriSpatialRelWithin":return"within";
case "esriSpatialRelTouches":return"touches";case "esriSpatialRelCrosses":return"crosses";case "esriSpatialRelEnvelopeIntersects":return"envelope-intersects"}return a};d.prototype._makeRelationshipParam=function(a){return 0<=a.indexOf("esriSpatialRelRelation")?a.split(":")[1]:""};d.prototype._queryAllFeatures=function(){var a=this,b=new m;if(this._wset)return b.resolve(this._wset),b.promise;var e=new r;e.where="1\x3d1";this._ensureLoaded().then(h.callback(function(c){if(a._layer.source&&a._layer.source.items){var d=
[];a._layer.source.items.forEach(function(b){var c=b.attributes[a._layer.objectIdField];d.push(c);a._featureCache[c]=a._changeFeature(b)});a._wset=new p([],d,!1,null);b.resolve(a._wset)}else a._layer.queryFeatures(e).then(h.callback(function(c){var e=[];c.features.forEach(function(b){var c=b.attributes[a._layer.objectIdField];e.push(c);a._featureCache[c]=a._changeFeature(b)});a._wset=new p([],e,!1,null);b.resolve(a._wset)},b),h.errback(b))},b),h.errback(b));return b.promise};d.prototype._getFeatures=
function(a,b,e,c){c=new m;var d=[];-1!==b&&void 0===this._featureCache[b]&&d.push(b);for(var h=a._lastFetchedIndex;h<a._known.length&&!(a._lastFetchedIndex+=1,void 0===this._featureCache[a._known[h]]&&(a._known[h]!==b&&d.push(a._known[h]),d.length>e));h++);0===d.length?c.resolve("success"):c.reject(Error("Unaccounted for Features. Not in Feature Collection"));return c.promise};d.prototype._refineSetBlock=function(a,b,d){b=new m;b.resolve(a);return b.promise};d.prototype._stat=function(a,b,d,c,g,h,
f){a=new m;a.resolve({calculated:!1});return a.promise};d.prototype._canDoAggregates=function(a,b,d,c,g){a=new m;a.resolve(!1);return a.promise};d._cloneAttr=function(a){var b={},d;for(d in a)b[d]=a[d];return b};d.create=function(a,b){var e=a.layerDefinition.objectIdField,c=a.layerDefinition.geometryType;void 0===c&&(c=a.featureSet.geometryType||"");var g=a.featureSet.features,h=b.toJSON();if(""===e||void 0===e){for(var f=!1,k=0,n=a.layerDefinition.fields;k<n.length;k++){var l=n[k];if("oid"===l.type||
"esriFieldTypeOID"===l.type){e=l.name;f=!0;break}}if(!1===f){e="FID";f=!0;for(k=0;f;){for(var n=!0,m=0,p=a.layerDefinition.fields;m<p.length;m++)if(l=p[m],l.name===e){n=!1;break}!0===n?f=!1:(k++,e="FID"+k.toString())}a.layerDefinition.fields.push({type:"esriFieldTypeOID",name:e,alias:e});l=[];for(f=0;f<g.length;f++)l.push({geometry:a.featureSet.features[f].geometry,attributes:a.featureSet.features[f].attributes?this._cloneAttr(a.featureSet.features[f].attributes):{}}),l[f].attributes[e]=f;g=l}}f=
[];k=0;for(a=a.layerDefinition.fields;k<a.length;k++)l=a[k],l instanceof q?f.push(l):f.push(q.fromJSON(l));switch(c){case "esriGeometryPoint":c="point";break;case "esriGeometryPolyline":c="polyline";break;case "esriGeometryPolygon":c="polygon";break;case "esriGeometryExtent":c="extent";break;case "esriGeometryMultipoint":c="multipoint"}a=0;for(k=g;a<k.length;a++)l=k[a],l.geometry&&!1===l.geometry instanceof x&&(l.geometry.type=c,void 0===l.geometry.spatialReference&&(l.geometry.spatialReference=h));
g={outFields:["*"],source:g,fields:f,objectIdField:e,spatialReference:b};g.geometryType=c?c:"point";g=new y(g);""===c&&(g.handleAsTable=!0);return new d({layer:g,spatialReference:b})};d.prototype.canBeBigDataFeatureSet=function(){return!1};d.prototype.shouldBeResolvedAsBigData=function(){return!1};return d}(w)});