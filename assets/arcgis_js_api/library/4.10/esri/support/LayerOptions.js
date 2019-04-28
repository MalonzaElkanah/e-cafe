// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../core/tsSupport/declareExtendsHelper ../core/tsSupport/decorateHelper ../core/JSONSupport ../core/accessorSupport/decorators".split(" "),function(h,k,f,d,g,b){return function(e){function a(a){a=e.call(this)||this;a.showNoDataRecords=null;return a}f(a,e);c=a;a.prototype.clone=function(){return new c({showNoDataRecords:this.showNoDataRecords})};var c;d([b.property({type:Boolean,json:{write:!0}})],a.prototype,"showNoDataRecords",void 0);return a=c=d([b.subclass("esri.support.LayerOptions")],
a)}(b.declared(g))});