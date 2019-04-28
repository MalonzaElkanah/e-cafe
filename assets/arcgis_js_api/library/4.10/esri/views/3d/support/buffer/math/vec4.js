// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports"],function(l,c){Object.defineProperty(c,"__esModule",{value:!0});c.scale=function(a,b,d){var c=Math.min(a.count,b.count),e=a.typedBuffer;a=a.typedBufferStride;var f=b.typedBuffer;b=b.typedBufferStride;for(var g=0;g<c;g++){var h=g*a,k=g*b;e[h]=d*f[k];e[h+1]=d*f[k+1];e[h+2]=d*f[k+2];e[h+3]=d*f[k+3]}}});