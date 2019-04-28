// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports"],function(f,b){Object.defineProperty(b,"__esModule",{value:!0});b.isGraphic=function(c){return c&&"esri.Graphic"===c.declaredClass};b.lookupData=function(c,a){if(a){var d=0,b=a.length-1;a.some(function(a,e){if(c<a)return b=e,!0;d=e;return!1});return[d,b,(c-a[d])/(a[b]-a[d])]}}});