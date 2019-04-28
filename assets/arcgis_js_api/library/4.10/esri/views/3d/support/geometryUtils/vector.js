// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","../../../../core/libs/gl-matrix-2/gl-matrix","../mathUtils"],function(g,c,d,f){function e(a,b){return d.vec3.dot(a,b)/d.vec3.length(a)}Object.defineProperty(c,"__esModule",{value:!0});c.projectPoint=function(a,b,c){b=e(a,b);return d.vec3.scale(c,a,b)};c.projectPointSignedLength=e;c.angle=function(a,b){a=d.vec3.dot(a,b)/(d.vec3.length(a)*d.vec3.length(b));return-f.acos(a)}});