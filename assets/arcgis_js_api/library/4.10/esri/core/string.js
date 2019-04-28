// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","./object"],function(e,a,d){Object.defineProperty(a,"__esModule",{value:!0});a.replace=function(a,c,b){void 0===b&&(b=/\{([^\}]+)\}/g);return a.replace(b,"object"===typeof c?function(a,b){return d.getDeepValue(b,c)}:c)}});