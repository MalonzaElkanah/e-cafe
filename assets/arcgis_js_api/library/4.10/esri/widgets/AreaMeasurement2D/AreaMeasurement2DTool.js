// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../core/tsSupport/declareExtendsHelper ../../core/tsSupport/decorateHelper ../../Graphic ../../core/Collection ../../core/Handles ../../core/accessorSupport/decorators ../../geometry/geometryEngine ../../geometry/Point ../../geometry/Polygon ../../geometry/Polyline ../../geometry/projection ../../geometry/ScreenPoint ../../geometry/SpatialReference ../../geometry/support/geodesicUtils ../../layers/GraphicsLayer ../../views/2d/draw/Draw ../../views/interactive/InteractiveToolBase ../../views/interactive/interactiveToolUtils".split(" "),
function(F,G,y,f,r,k,v,e,l,z,A,w,n,B,t,q,C,D,E,u){return function(x){function c(b){b=x.call(this,b)||this;b._handles=new v;b._mapHandles=new v;b._sketchHandles=new v;b._sketchLayer=new C;b._vertices=null;b._vertexDrag=null;b._vertexHoverIndex=-1;return b}y(c,x);c.prototype.initialize=function(){var b=this;this._draw=new D({view:this.view});var a=this.view;a.map.add(this._sketchLayer);a.focus();this._mapHandles.add(a.on("pointer-move",function(a){return b._updateCursor(new B(a.x,a.y))}));this._mapHandles.add(a.on("drag",
function(c){switch(c.action){case "start":a.hitTest(c).then(function(a){a=new k(a.results);if(0!==a.length){var g=b._sketchLayer.graphics.filter(function(a){return"point"===a.geometry.type});if(0!==g.length&&(a=a.find(function(a){return-1!==g.indexOf(a.graphic)}))){var m=a.graphic.geometry;a=(new k(b._vertices)).findIndex(function(a){return a[0]===m.x&&a[1]===m.y});b._vertexDrag={index:a,origin:m};u.setActive(b,!0);c.stopPropagation()}}});break;case "update":if(b._vertexDrag){var h=a.toMap(c.origin),
m=a.toMap(c);b._vertices[b._vertexDrag.index]=[b._vertexDrag.origin.x+m.x-h.x,b._vertexDrag.origin.y+m.y-h.y];b._updateMeasurements();c.stopPropagation()}break;case "end":b._vertexDrag=null,u.setActive(b,!1)}}));this._handles.add(this.watch(["viewModel.unit","viewModel.mode"],function(){b._updateMeasurements()}));this.projectionEngineRequired&&this.projectionEngineSupported&&(n.isLoaded()||n.load())};c.prototype.destroy=function(){this.detach();this._sketchHandles.removeAll();this._mapHandles.removeAll();
this._sketchLayer.removeAll();this.viewModel.view.map.remove(this._sketchLayer);this.viewModel.measurement=null;this._draw&&(this._draw.destroy(),this._draw=null);this._drawAction&&(this._drawAction.destroy(),this._drawAction=null);this._mapHandles&&(this._mapHandles.destroy(),this._mapHandles=null);this._sketchHandles&&(this._sketchHandles.destroy(),this._sketchHandles=null);this._sketchLayer&&(this._sketchLayer.destroy(),this._sketchLayer=null);this._handles&&(this._handles.destroy(),this._handles=
null)};Object.defineProperty(c.prototype,"editable",{set:function(b){this._set("editable",b);!b&&this._drawAction&&(this._drawAction.destroyed||this._drawAction.destroy(),this._drawAction=null,this._sketchHandles.removeAll());this._updateMeasurements()},enumerable:!0,configurable:!0});Object.defineProperty(c.prototype,"projectionEngineRequired",{get:function(){if(!this.view||!this.view.spatialReference)return!1;var b=this.view.spatialReference;return!b.isWebMercator&&!b.isWGS84&&!q.isSupported(b)},
enumerable:!0,configurable:!0});Object.defineProperty(c.prototype,"projectionEngineSupported",{get:function(){return n.isSupported()},enumerable:!0,configurable:!0});c.prototype.show=function(){this._sketchLayer.visible=!0};c.prototype.hide=function(){this._sketchLayer.visible=!1};c.prototype.reset=function(){this._vertexDrag=this._vertices=null;this._vertexHoverIndex=-1;this._sketchLayer.removeAll();this.viewModel.measurement=null};c.prototype.newMeasurement=function(){this.reset();u.setActive(this,
!0);this._startSketch()};c.prototype.clearMeasurement=function(){this.reset()};c.prototype._startSketch=function(){var b=this;this._drawAction=this._draw.create("polyline",{mode:"click"});this._sketchHandles.add([this._drawAction.on("vertex-add",function(a){return b._updateSketch(a.vertices)}),this._drawAction.on("vertex-update",function(a){return b._updateSketch(a.vertices)}),this._drawAction.on("vertex-remove",function(a){return b._updateSketch(a.vertices)}),this._drawAction.on("cursor-update",
function(a){return b._updateSketch(a.vertices)}),this._drawAction.on("undo",function(a){return b._updateSketch(a.vertices)}),this._drawAction.on("redo",function(a){return b._updateSketch(a.vertices)}),this._drawAction.on("draw-complete",function(){return b._stopSketch()})])};c.prototype._stopSketch=function(){this._sketchHandles.removeAll();this._drawAction=null;u.setActive(this,!1)};c.prototype._updateSketch=function(b){this._vertices=b;this._updateMeasurements()};c.prototype._updateCursor=function(b){var a=
this,c=this.viewModel.view;this._vertexDrag?this.cursor="grabbing":this._drawAction?this.cursor="crosshair":c.hitTest(b).then(function(b){var c=-1;if(0!==b.results.length&&(b=(new k(b.results)).map(function(a){return a.graphic}).find(function(b){return b&&b.layer===a._sketchLayer&&"point"===b.geometry.type})))var m=b.geometry,c=(new k(a._vertices)).findIndex(function(a){return a[0]===m.x&&a[1]===m.y});c!==a._vertexHoverIndex&&(a._vertexHoverIndex=c,a.cursor=-1===a._vertexHoverIndex?null:"pointer",
a._updateMeasurements())})};c.prototype._updateMeasurements=function(){var b=this;if(!(!this._vertices||this.projectionEngineRequired&&!n.isLoaded()||(this._sketchLayer.removeAll(),2>this._vertices.length))){var a=this._vertices.slice(),c=this.viewModel,h=c.palette,e=c.view.spatialReference,f=[],g=q.isSupported(e),k=!g&&!e.isWebMercator&&!e.isWGS84;if(2===a.length){var d=new w({paths:[a],spatialReference:e});k&&(d=n.project(d,t.WGS84));if(g||k)d=q.geodesicDensify(d,1E5);else if(g=l.geodesicLength(d,
"meters"),"geodesic"===c.mode||"auto"===c.mode&&g>=c.geodesicDistanceThreshold)d=l.geodesicDensify(d,1E5,"meters");f.push(new r({geometry:d,symbol:{type:"simple-line",color:h.pathColor,width:h.pathWidth}}))}else{a.push(a[0]);var d=new A({rings:[a],spatialReference:e}),a=new w({paths:[a],spatialReference:e}),p=d.clone(),d=l.simplify(d);k&&(d=n.project(d,t.WGS84),p=n.project(p,t.WGS84),a=n.project(a,t.WGS84));g||k?(c.measurement={geometry:d,area:q.geodesicAreas([d],"square-meters")[0],perimeter:q.geodesicLengths([d],
"meters")[0]},p=q.geodesicDensify(p,1E5),a=q.geodesicDensify(a,1E5)):(g=l.planarLength(d,"meters"),"geodesic"===c.mode||"auto"===c.mode&&g>=c.geodesicDistanceThreshold?(c.measurement={geometry:d,area:l.geodesicArea(d,"square-meters"),perimeter:l.geodesicLength(d,"meters")},p=l.geodesicDensify(p,1E5,"meters"),a=l.geodesicDensify(a,1E5,"meters")):c.measurement={geometry:d,area:l.planarArea(d,"square-meters"),perimeter:g});f.push(new r({geometry:p,symbol:{type:"simple-fill",style:"solid",color:h.fillColor,
outline:{type:"simple-line",width:0}}}),new r({geometry:a,symbol:{type:"simple-line",style:"solid",color:h.pathColor,width:h.pathWidth}}));f.push(new r({geometry:p.centroid,symbol:{type:"text",color:[255,255,255,1],haloColor:[0,0,0,.5],haloSize:2,text:c.measurementLabel.area,font:{size:14,family:"sans-serif"}}}))}this.editable&&this._vertices.forEach(function(a,c){c=b._vertexHoverIndex===c?1.5:1;f.push(new r({geometry:new z({x:a[0],y:a[1],spatialReference:e}),symbol:{type:"simple-marker",style:"circle",
color:h.handleColor,size:h.handleWidth*c,outline:{type:"simple-line",width:0}}}))});this._sketchLayer.addMany(f)}};f([e.property({constructOnly:!0})],c.prototype,"viewModel",void 0);f([e.property()],c.prototype,"cursor",void 0);f([e.property({value:!0})],c.prototype,"editable",null);f([e.property({dependsOn:["view.spatialReference"],readOnly:!0})],c.prototype,"projectionEngineRequired",null);f([e.property({readOnly:!0})],c.prototype,"projectionEngineSupported",null);return c=f([e.subclass("esri.widgets.AreaMeasurement2D.AreaMeasurement2DTool")],
c)}(e.declared(E))});