// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../../core/tsSupport/extendsHelper ../../../../core/tsSupport/generatorHelper ../../../../core/tsSupport/awaiterHelper ../../../../core/libs/gl-matrix-2/gl-matrix ../../../../geometry/support/aaBoundingBox ../../../../geometry/support/aaBoundingRect ./graphicUtils".split(" "),function(h,v,w,q,r,n,g,t,u){h=function(){function b(a,f,b){this.type="draped";this.graphics3DSymbolLayer=a;this.renderGeometries=f;this.boundingBox=b;this.stage=null;this._visible=!1}b.prototype.initialize=
function(a,f){this.stage=f};b.prototype.setVisibility=function(a){if(null!=this.stage)return this._visible!==a?((this._visible=a)?this.stage.getDrapedTextureRenderer().addRenderGeometries(this.renderGeometries):this.stage.getDrapedTextureRenderer().removeRenderGeometries(this.renderGeometries),!0):!1};b.prototype.destroy=function(){this.stage&&this._visible&&this.stage.getDrapedTextureRenderer().removeRenderGeometries(this.renderGeometries);this._visible=!1;this.stage=null};b.prototype.getBSRadius=
function(){return this.renderGeometries.reduce(function(a,f){return Math.max(a,f.bsRadius)},0)};b.prototype.getCenterObjectSpace=function(a){void 0===a&&(a=n.vec3f64.create());return n.vec3.set(a,0,0,0)};b.prototype.getBoundingBoxObjectSpace=function(a){void 0===a&&(a=g.create());return g.empty(a)};b.prototype.addHighlight=function(a,f){var b=this.stage.getDrapedTextureRenderer();this.renderGeometries.forEach(function(c){var d=b.addRenderGeometryHighlight(c,f);a.addRenderGeometry(c,b,d)})};b.prototype.removeHighlight=
function(a){this.renderGeometries.forEach(function(b){a.removeRenderGeometry(b)})};b.prototype.getProjectedBoundingBox=function(a,b,e,c){return r(this,void 0,void 0,function(){var d,f,k,h;return q(this,function(l){switch(l.label){case 0:g.empty(c);for(d=0;d<this.renderGeometries.length;d++)f=this.renderGeometries[d],this._getRenderGeometryProjectedBoundingRect(f,a,p,e),g.expand(c,p);if(!b)return[3,5];g.center(c,m);k=void 0;h=u.demResolutionForBoundingBox(c,b);l.label=1;case 1:return l.trys.push([1,
3,,4]),[4,b.service.queryElevation(m[0],m[1],h)];case 2:return k=l.sent(),[3,4];case 3:return l.sent(),k=null,[3,4];case 4:null!=k&&(c[2]=Math.min(c[2],k),c[5]=Math.max(c[5],k)),l.label=5;case 5:return[2,c]}})})};b.prototype._getRenderGeometryProjectedBoundingRect=function(a,b,h,c){if(this.boundingBox)g.set(e,this.boundingBox);else{var d=a.center;a=a.bsRadius;e[0]=d[0]-a;e[1]=d[1]-a;e[2]=d[2]-a;e[3]=d[0]+a;e[4]=d[1]+a;e[5]=d[2]+a}b(e,0,2);this.calculateRelativeScreenBounds&&c.push({location:g.center(e),
screenSpaceBoundingRect:this.calculateRelativeScreenBounds()});return g.toRect(e,h)};return b}();var p=t.create(),e=g.create(),m=[0,0,0];return h});