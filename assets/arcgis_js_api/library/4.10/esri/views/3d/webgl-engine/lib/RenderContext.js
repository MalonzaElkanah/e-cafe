// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports"],function(b,c){return function(){function a(){this.camera=null;this.pixelRatio=1;this.normals=this.lightingData=this.highlight=this.depth=null;this.pass=0;this.shadowMap=null;this.slot=0;this.options=this.rctx=this.framebufferTex=this.stencilRenderingHelper=this.sliceHelper=this.offscreenRenderingHelper=this.ssaoHelper=null;this.renderOccludedOnly=!1}Object.defineProperty(a.prototype,"isHighlightPass",{get:function(){return 4===this.pass},enumerable:!0,configurable:!0});
return a}()});