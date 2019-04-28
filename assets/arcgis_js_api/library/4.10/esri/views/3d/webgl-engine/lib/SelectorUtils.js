// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","../../../../core/libs/gl-matrix-2/gl-matrix","../../support/geometryUtils/boundedPlane"],function(h,a,b,d){Object.defineProperty(a,"__esModule",{value:!0});a.sliceFilterPredicate=function(a){return function(e,f,g){b.vec3.lerp(c,e,f,g);return!d.extrusionContainsPoint(a,c)}};var c=b.vec3f64.create()});