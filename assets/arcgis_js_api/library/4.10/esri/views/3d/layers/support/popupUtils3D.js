// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../../core/tsSupport/extendsHelper ../../../../core/tsSupport/decorateHelper ../../../../geometry/Extent ../../../../geometry/support/scaleUtils ../../../../layers/graphics/dehydratedFeatures ../../../../renderers/support/clickToleranceUtils".split(" "),function(p,f,q,r,h,g,l,n){function m(a,c,d){var b=d.get("basemapTerrain"),e=d.get("basemapTerrain.overlayManager"),e=e?e.overlayPixelSizeInMapUnits(a):1,b=b&&!b.spatialReference.equals(d.spatialReference)?g.getMetersPerUnitForSR(b.spatialReference)/
g.getMetersPerUnitForSR(d.spatialReference):c*e;c=a.clone().offset(-b,-b);a=a.clone().offset(b,b);return new h({xmin:Math.min(c.x,a.x),ymin:Math.min(c.y,a.y),xmax:Math.max(c.x,a.x),ymax:Math.max(c.y,a.y),spatialReference:d.spatialReference})}Object.defineProperty(f,"__esModule",{value:!0});f.createQueryGeometry=m;f.queryDrapedGraphics=function(a){var c=a.area,d=a.view,b=a.loadedGraphics,e=a.popupTemplate,f=a.layer;a=a.clientGraphics;var g=n.calculateTolerance(),h=m(c,g,d),k=[];b.forEach(function(a){a.visible&&
h.intersects(a.geometry)&&(e||l.isHydratedGraphic(a)&&a.popupTemplate)&&k.push(l.hydrateGraphic(a,f))});return a&&a.length?a.concat(k):k}});