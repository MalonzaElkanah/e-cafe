// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../core/tsSupport/declareExtendsHelper ../../../core/tsSupport/decorateHelper ../../../core/Accessor ../../../core/accessorSupport/decorators ./TipSource".split(" "),function(k,l,f,c,g,b,h){return function(e){function a(a){a=e.call(this)||this;a.id=null;a.image=null;a.title=null;return a}f(a,e);d=a;a.prototype.clone=function(){return new d({content:this.content,id:this.id,image:this.image,source:this.source,title:this.title})};var d;c([b.property()],a.prototype,"content",
void 0);c([b.property()],a.prototype,"id",void 0);c([b.property()],a.prototype,"image",void 0);c([b.property({type:h})],a.prototype,"source",void 0);c([b.property()],a.prototype,"title",void 0);return a=d=c([b.subclass("esri.widgets.Tip.TipItem")],a)}(b.declared(g))});