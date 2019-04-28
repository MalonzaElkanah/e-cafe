// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../../../core/tsSupport/declareExtendsHelper ../../../../../core/tsSupport/decorateHelper ../../../../../core/Accessor ../../../../../core/HandleOwner ../../../../../core/accessorSupport/decorators".split(" "),function(d,f,g,c,h,k,b){Object.defineProperty(f,"__esModule",{value:!0});d=function(d){function a(a){a=d.call(this)||this;a.tiles=new Map;a.layer=null;return a}g(a,d);a.prototype.destroy=function(){this.tiles.clear();this.layer=this.layerView=this.tileInfoView=
this.highlightOptions=this.configuration=this.tiles=null};Object.defineProperty(a.prototype,"updating",{get:function(){return this.isUpdating()},enumerable:!0,configurable:!0});a.prototype.acquireTile=function(a){var b=this,e=this.createTile(a);e.once("isReady",function(){return b.notifyChange("updating")});this.tiles.set(a.id,e);return e};a.prototype.forEachTile=function(a){this.tiles.forEach(a)};a.prototype.releaseTile=function(a){this.tiles.delete(a.key.id);this.disposeTile(a)};a.prototype.isUpdating=
function(){var a=!0;this.tiles.forEach(function(b){a=a&&b.isReady});return!a};a.prototype.requestUpdate=function(){this.layerView.requestUpdate()};c([b.property()],a.prototype,"configuration",void 0);c([b.property()],a.prototype,"highlightOptions",void 0);c([b.property()],a.prototype,"layer",void 0);c([b.property()],a.prototype,"layerView",void 0);c([b.property()],a.prototype,"tileInfoView",void 0);c([b.property()],a.prototype,"updating",null);return a=c([b.subclass()],a)}(b.declared(h,k));f.default=
d});