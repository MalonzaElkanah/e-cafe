// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../core/tsSupport/declareExtendsHelper ../../../core/tsSupport/decorateHelper ../../../core/accessorSupport/decorators ./Chart ./Chart/utils".split(" "),function(k,l,f,d,b,g,h){return function(e){function a(a){a=e.call(this)||this;a.type="pie-chart";return a}f(a,e);c=a;a.prototype.clone=function(){return new c({title:this.title,caption:this.caption,value:this.value?this.value.clone():null})};var c;d([b.property({type:["pie-chart"],readOnly:!0,json:{read:!1,write:h.chartTypeKebabDict.write}})],
a.prototype,"type",void 0);return a=c=d([b.subclass("esri.support.ContentElement.Media.PieChart")],a)}(b.declared(g))});