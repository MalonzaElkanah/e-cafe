// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../core/tsSupport/extendsHelper dojo/Deferred dojo/promise/all ../sources/Empty ../support/FeatureSet ../support/IdSet ../support/shared ../../../geometry/geometryEngineAsync".split(" "),function(v,w,t,q,u,n,g,r,f,p){var m=function(b){function e(a){var c=b.call(this,a)||this;c._relation="";c._relationGeom=null;c._relationString="";c.declaredClass="esri.arcade.featureset.actions.SpatialFilter";c._relationString=a.relationString;c._parent=a.parentfeatureset;c._maxProcessing=
40;c._relation=a.relation;c._relationGeom=a.relationGeom;return c}t(e,b);e.prototype._getSet=function(a){var c=this,d=new q;null===this._wset?this._ensureLoaded().then(f.callback(function(){c._parent._getFilteredSet("esriSpatialRelRelation"!==c._relation?c._relation:c._relation+":"+c._relationString,c._relationGeom,null,null,a).then(f.callback(function(b){c._checkCancelled(a);c._wset=new r(b._candidates.slice(0),b._known.slice(0),b._ordered,c._clonePageDefinition(b.pagesDefinition));d.resolve(c._wset)},
d),f.errback(d))},d),f.errback(d)):d.resolve(this._wset);return d.promise};e.prototype._isInFeatureSet=function(a){var c=this._parent._isInFeatureSet(a);if(c===f.IdState.NotInFeatureSet)return c;c=this._idstates[a];return void 0===c?f.IdState.Unknown:c};e.prototype._getFeature=function(a,c,b){return this._parent._getFeature(a,c,b)};e.prototype._getFeatures=function(a,c,b,f){return this._parent._getFeatures(a,c,b,f)};e.prototype._featureFromCache=function(a){return this._parent._featureFromCache(a)};
e.prototype.executeSpatialRelationTest=function(a){if(null===a.geometry){var c=new q;c.resolve(!1);return c.promise}switch(this._relation){case "esriSpatialRelEnvelopeIntersects":return c=f.shapeExtent(this._relationGeom),a=f.shapeExtent(a.geometry),p.intersects(c,a);case "esriSpatialRelIntersects":return p.intersects(this._relationGeom,a.geometry);case "esriSpatialRelContains":return p.contains(this._relationGeom,a.geometry);case "esriSpatialRelOverlaps":return p.overlaps(this._relationGeom,a.geometry);
case "esriSpatialRelWithin":return p.within(this._relationGeom,a.geometry);case "esriSpatialRelTouches":return p.touches(this._relationGeom,a.geometry);case "esriSpatialRelCrosses":return p.crosses(this._relationGeom,a.geometry);case "esriSpatialRelRelation":return p.relate(this._relationGeom,a.geometry,this._relationString)}};e.prototype._fetchAndRefineFeatures=function(a,c,b){var d=this,e=new q,l=new r([],a,!1,null),h=Math.min(c,a.length);this._parent._getFeatures(l,-1,h,b).then(f.callback(function(){d._checkCancelled(b);
for(var l=[],k=0;k<h;k++){var g=d._parent._featureFromCache(a[k]);l.push(d.executeSpatialRelationTest(g))}u(l).then(f.callback(function(b){for(var l=0;l<c;l++)d._idstates[a[l]]=!0===b[l]?f.IdState.InFeatureSet:f.IdState.NotInFeatureSet;e.resolve("success")},e),f.errback(e))},e),f.errback(e));return e.promise};e.prototype._getFilteredSet=function(a,c,b,e,g){var d=this,h=new q;this._ensureLoaded().then(f.callback(function(){d._parent._getFilteredSet("esriSpatialRelRelation"!==d._relation?d._relation:
d._relation+":"+d._relationString,d._relationGeom,b,e,g).then(f.callback(function(a){d._checkCancelled(g);a=null!==c?new r(a._candidates.slice(0).concat(a._known.slice(0)),[],a._ordered,d._clonePageDefinition(a.pagesDefinition)):new r(a._candidates.slice(0),a._known.slice(0),a._ordered,d._clonePageDefinition(a.pagesDefinition));h.resolve(a)},h),f.errback(h))},h),f.errback(h));return h.promise};e.prototype._stat=function(a,c,b,e,g,l,h){var d=this,k=new q;""!==b?k.resolve({calculated:!1}):this._parent._stat(a,
c,"esriSpatialRelRelation"!==this._relation?this._relation:this._relation+":"+this._relationString,this._relationGeom,g,l,h).then(f.callback(function(m){!1===m.calculated?null===g&&""===b&&null===e?d._manualStat(a,c,l,h).then(f.callback(function(a){k.resolve(a)},k),f.errback(k)):k.resolve({calculated:!1}):k.resolve(m)},k),f.errback(k));return k.promise};e.prototype._canDoAggregates=function(a,c,b,e,f){var d=new q;return""!==b||null!==e||null===this._parent?(d.resolve(!1),d.promise):this._parent._canDoAggregates(a,
c,"esriSpatialRelRelation"!==this._relation?this._relation:this._relation+":"+this._relationString,this._relationGeom,f)};e.prototype._getAggregatePagesDataSourceDefinition=function(a,c,b,e,f,g,h){b=new q;if(null===this._parent)b.reject(Error("Should never be called"));else return this._parent._getAggregatePagesDataSourceDefinition(a,c,"esriSpatialRelRelation"!==this._relation?this._relation:this._relation+":"+this._relationString,this._relationGeom,f,g,h);return b.promise};e.prototype.arcadeScriptStep=
function(a,b,d){a=this.arcadeAssignNextScriptStepIdentifiers(d);switch(this._relation){case "esriSpatialRelEnvelopeIntersects":return"var "+a.newFeatureSet+" \x3d "+this.bigDataCachePipeline("envelopeIntersects( "+a.currentFeatureSet+","+this.constructArcadeGeom(null===this._relationGeom?null:this._relationGeom.extent,b,d)+")")+"; ";case "esriSpatialRelIntersects":return"var "+a.newFeatureSet+" \x3d "+this.bigDataCachePipeline("intersects( "+a.currentFeatureSet+","+this.constructArcadeGeom(this._relationGeom,
b,d)+")")+"; ";case "esriSpatialRelContains":return"var "+a.newFeatureSet+" \x3d "+this.bigDataCachePipeline("contains( "+a.currentFeatureSet+","+this.constructArcadeGeom(this._relationGeom,b,d)+")")+"; ";case "esriSpatialRelOverlaps":return"var "+a.newFeatureSet+" \x3d "+this.bigDataCachePipeline("overlaps( "+a.currentFeatureSet+","+this.constructArcadeGeom(this._relationGeom,b,d)+")")+"; ";case "esriSpatialRelWithin":return"var "+a.newFeatureSet+" \x3d "+this.bigDataCachePipeline("within( "+a.currentFeatureSet+
","+this.constructArcadeGeom(this._relationGeom,b,d)+")")+"; ";case "esriSpatialRelTouches":return"var "+a.newFeatureSet+" \x3d "+this.bigDataCachePipeline("touches( "+a.currentFeatureSet+","+this.constructArcadeGeom(this._relationGeom,b,d)+")")+"; ";case "esriSpatialRelCrosses":return"var "+a.newFeatureSet+" \x3d "+this.bigDataCachePipeline("crosses( "+a.currentFeatureSet+","+this.constructArcadeGeom(this._relationGeom,b,d)+")")+"; ";case "esriSpatialRelRelation":return"var "+a.newFeatureSet+" \x3d "+
this.bigDataCachePipeline("relate( "+a.currentFeatureSet+","+this.constructArcadeGeom(this._relationGeom,b,d)+', "'+this._relationString+'")')+";"}return"var "+a.newFeatureSet+" \x3d null; "};return e}(g);g._featuresetFunctions.intersects=function(b){return null===b||void 0===b?new n({parentfeatureset:this}):new m({parentfeatureset:this,relation:"esriSpatialRelIntersects",relationGeom:b})};g._featuresetFunctions.envelopeIntersects=function(b){return null===b||void 0===b?new n({parentfeatureset:this}):
new m({parentfeatureset:this,relation:"esriSpatialRelEnvelopeIntersects",relationGeom:b})};g._featuresetFunctions.contains=function(b){return null===b||void 0===b?new n({parentfeatureset:this}):new m({parentfeatureset:this,relation:"esriSpatialRelContains",relationGeom:b})};g._featuresetFunctions.overlaps=function(b){return null===b||void 0===b?new n({parentfeatureset:this}):new m({parentfeatureset:this,relation:"esriSpatialRelOverlaps",relationGeom:b})};g._featuresetFunctions.within=function(b){return null===
b||void 0===b?new n({parentfeatureset:this}):new m({parentfeatureset:this,relation:"esriSpatialRelWithin",relationGeom:b})};g._featuresetFunctions.touches=function(b){return null===b||void 0===b?new n({parentfeatureset:this}):new m({parentfeatureset:this,relation:"esriSpatialRelTouches",relationGeom:b})};g._featuresetFunctions.crosses=function(b){return null===b||void 0===b?new n({parentfeatureset:this}):new m({parentfeatureset:this,relation:"esriSpatialRelCrosses",relationGeom:b})};g._featuresetFunctions.relate=
function(b,e){return null===b||void 0===b?new n({parentfeatureset:this}):new m({parentfeatureset:this,relation:"esriSpatialRelRelation",relationGeom:b,relationString:e})};return m});