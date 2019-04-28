// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","./TerrainConst","./TilePerLayerInfo"],function(l,m,h,k){return function(){function b(a){this.parent=null;this.lij=a;this.layerInfo=Array(h.LayerClass.COUNT)}b.prototype.hasDataAvailable=function(a,c,d){return(c=this.layerInfo[d][c].tilemap)?"unavailable"!==c.getAvailability(a.lij[1],a.lij[2]):!0};b.prototype.modifyLayers=function(a,c,d){a=this.layerInfo[d];for(var b=c.length,f=Array(b),e=0;e<b;e++){var g=c[e];f[e]=-1<g?a[g]:k.makeEmptyLayerInfo(d)}this.layerInfo[d]=f};
return b}()});