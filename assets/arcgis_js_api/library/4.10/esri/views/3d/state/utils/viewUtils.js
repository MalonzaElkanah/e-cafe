// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","../../../../core/libs/gl-matrix-2/gl-matrix","../../support/mathUtils"],function(h,a,b,f){Object.defineProperty(a,"__esModule",{value:!0});a.viewAngle=function(c,a,g){c.worldUpAtPosition(a,e);b.vec3.subtract(d,g,a);c=b.vec3.length(d);return 0===c?0:f.acos(b.vec3.dot(d,e)/c)};var e=b.vec3f64.create(),d=b.vec3f64.create()});