// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../core/compilerUtils ./previewSymbol2D ./previewSymbol3D ./previewWebStyleSymbol".split(" "),function(k,c,e,f,g,h){function d(a,b){switch(a.type){case "web-style":return h.previewWebStyleSymbol(a,d,b);case "label-3d":case "line-3d":case "mesh-3d":case "point-3d":case "polygon-3d":return g.previewSymbol3D(a,b);case "simple-marker":case "simple-line":case "simple-fill":case "picture-marker":case "picture-fill":case "text":return f.previewSymbol2D(a,b);default:e.neverReached(a)}}
Object.defineProperty(c,"__esModule",{value:!0});c.renderPreviewHTML=d});