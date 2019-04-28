// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../core/tsSupport/declareExtendsHelper ../core/tsSupport/decorateHelper ../core/kebabDictionary ../core/accessorSupport/decorators ./SimpleLineSymbol ./Symbol".split(" "),function(l,m,f,c,g,b,h,k){var d=g({esriSFS:"simple-fill",esriPFS:"picture-fill"});return function(e){function a(a){a=e.call(this,a)||this;a.outline=null;a.type=null;return a}f(a,e);c([b.property({type:h,json:{default:null,write:!0}})],a.prototype,"outline",void 0);c([b.property({type:d.apiValues,readOnly:!0,
json:{type:d.jsonValues}})],a.prototype,"type",void 0);return a=c([b.subclass("esri.symbols.FillSymbol")],a)}(b.declared(k))});