// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","../lib/DefaultVertexAttributeLocations","./sources/resolver"],function(d,a,c,b){Object.defineProperty(a,"__esModule",{value:!0});a.colorPass={name:"checker-board-color",shaders:{vertexShader:b.resolveIncludes("materials/checkerBoard/checkerBoard.vert"),fragmentShader:b.resolveIncludes("materials/checkerBoard/checkerBoard.frag")},attributes:c.Default3D}});