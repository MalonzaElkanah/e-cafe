// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","../../../../../core/libs/gl-matrix-2/gl-matrix","./viewUtils"],function(g,h,a,e){return function(){function f(){this.origin=a.vec3f64.create();this.start=a.vec3f64.create();this.end=a.vec3f64.create()}f.prototype.update=function(b,c,d){a.vec3.copy(this.start,b);a.vec3.copy(this.end,c);if(d)switch(d){case "start":a.vec3.copy(this.origin,this.start);break;case "center":e.midpoint([b,c],this.origin);break;case "end":a.vec3.copy(this.origin,this.end);break;default:a.vec3.copy(this.origin,
d)}else e.midpoint([b,c],this.origin)};return f}()});