// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../core/tsSupport/declareExtendsHelper ../../core/tsSupport/decorateHelper ../../core/Accessor ../../core/accessorSupport/decorators ./ViewOverlayItem maquette".split(" "),function(n,p,h,c,k,d,l,m){var f={left:0,top:0,width:0,height:0,x1:0,y1:0,x2:0,y2:0};return function(g){function b(a){a=g.call(this,a)||this;a.startX=0;a.startY=0;a.endX=0;a.endY=0;a.width=1;a.color=[0,0,0,.5];a.visible=!0;return a}h(b,g);Object.defineProperty(b.prototype,"startPosition",{get:function(){return[this.startX,
this.startY]},set:function(a){this._set("startX",a[0]);this._set("startY",a[1])},enumerable:!0,configurable:!0});Object.defineProperty(b.prototype,"endPosition",{get:function(){return[this.endX,this.endY]},set:function(a){this._set("endX",a[0]);this._set("endY",a[1])},enumerable:!0,configurable:!0});Object.defineProperty(b.prototype,"strokeStyle",{get:function(){var a=this.color;return"rgba("+a[0]+", "+a[1]+", "+a[2]+", "+a[3]+")"},enumerable:!0,configurable:!0});Object.defineProperty(b.prototype,
"lineCap",{get:function(){return"round"},enumerable:!0,configurable:!0});b.prototype.render=function(){var a=this.calculateCoordinates(f);return m.h("div",{classes:{"esri-line-overlay-item":!0},styles:{left:a.left+"px",top:a.top+"px",width:a.width+"px",height:a.height+"px",visibility:this.visible?"visible":"hidden"},innerHTML:"\x3csvg width\x3d"+a.width+" height\x3d"+a.height+"\x3e"+("\x3cline x1\x3d"+a.x1+" y1\x3d"+a.y1+" x2\x3d"+a.x2+" y2\x3d"+a.y2+' style\x3d"stroke: '+this.strokeStyle+"; stroke-width: "+
this.width+"; stroke-linecap: "+this.lineCap+';"\x3e\x3c/line\x3e')+"\x3c/svg\x3e"})};b.prototype.renderCanvas=function(a){if(this.visible){a.strokeStyle=this.strokeStyle;a.lineWidth=this.width;a.lineCap=this.lineCap;var b=this.calculateCoordinates(f);a.beginPath();a.moveTo(b.left+b.x1,b.top+b.y1);a.lineTo(b.left+b.x2,b.top+b.y2);a.stroke()}};b.prototype.calculateCoordinates=function(a){var b=Math.min(this.startX,this.endX),d=Math.max(this.startX,this.endX),c=Math.min(this.startY,this.endY),f=Math.max(this.startY,
this.endY),e=this.width;a.left=b-e;a.top=c-e;a.width=d-b+2*e;a.height=Math.max(20,f-c+2*e);a.x1=this.startX-b+e;a.y1=this.startY-c+e;a.x2=this.endX-b+e;a.y2=this.endY-c+e;return a};c([d.property()],b.prototype,"startX",void 0);c([d.property()],b.prototype,"startY",void 0);c([d.property()],b.prototype,"endX",void 0);c([d.property()],b.prototype,"endY",void 0);c([d.property({dependsOn:["startX","startY"]})],b.prototype,"startPosition",null);c([d.property({dependsOn:["endX","endY"]})],b.prototype,"endPosition",
null);c([d.property()],b.prototype,"width",void 0);c([d.property()],b.prototype,"color",void 0);c([d.property()],b.prototype,"visible",void 0);c([d.property({readOnly:!0,dependsOn:["color"]})],b.prototype,"strokeStyle",null);return b=c([d.subclass("esri.views.overlay.LineOverlayItem")],b)}(d.declared(k,l))});