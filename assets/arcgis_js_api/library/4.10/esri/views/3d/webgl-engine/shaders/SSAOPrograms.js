// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","../lib/DefaultVertexAttributeLocations","./sources/resolver"],function(d,a,c,b){Object.defineProperty(a,"__esModule",{value:!0});a.ssaoPass={name:"ssao",shaders:function(a){return{vertexShader:b.resolveIncludes("util/quad.vert"),fragmentShader:"#define SAMPLES "+a.samples+"\n"+b.resolveIncludes("renderer/ssao/ssao.frag")}},attributes:c.Default3D};a.blurPass={name:"ssao-blur",shaders:function(a){return{vertexShader:b.resolveIncludes("util/quad.vert"),fragmentShader:"#define RADIUS "+
a.radius+"\n"+b.resolveIncludes("renderer/ssao/blur.frag")}},attributes:c.Default3D}});