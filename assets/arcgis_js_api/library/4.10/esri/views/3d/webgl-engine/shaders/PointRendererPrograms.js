// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","./sources/resolver","../../../webgl/programUtils"],function(f,b,c,e){Object.defineProperty(b,"__esModule",{value:!0});var d=function(a){return e.glslifyDefineMap({DEPTH_PASS:a.depthPass,DRAW_SCREEN_SIZE:a.drawScreenSize,SLICE:a.slicePlaneEnabled})};b.program={name:"point-renderer",shaders:function(a){return{vertexShader:d(a)+c.resolveIncludes("pointRenderer/pointRenderer.vert"),fragmentShader:d(a)+c.resolveIncludes("pointRenderer/pointRenderer.frag")}},attributes:{aPosition:0,
aColor:1}}});