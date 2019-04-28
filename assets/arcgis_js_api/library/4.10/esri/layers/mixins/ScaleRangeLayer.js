// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../core/tsSupport/declareExtendsHelper ../../core/tsSupport/decorateHelper ../../core/Accessor ../../core/accessorSupport/decorators".split(" "),function(g,h,e,c,f,b){return function(d){function a(){var a=null!==d&&d.apply(this,arguments)||this;a.minScale=0;a.maxScale=0;return a}e(a,d);c([b.property({type:Number,json:{write:!0}})],a.prototype,"minScale",void 0);c([b.property({type:Number,json:{write:!0}})],a.prototype,"maxScale",void 0);return a=c([b.subclass("esri.layers.mixins.ScaleRangeLayer")],
a)}(b.declared(f))});