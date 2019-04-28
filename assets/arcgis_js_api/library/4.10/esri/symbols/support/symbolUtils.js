// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","./utils"],function(e,b,d){Object.defineProperty(b,"__esModule",{value:!0});b.getDisplayedSymbol=function(a,b){if(a){var c=a.get("layer.opacity")||a.get("sourceLayer.opacity");if(a.symbol)return a=a.symbol.clone(),d.applyColorToSymbol(a,null,c),a;if((c=a.get("layer.renderer")||a.get("sourceLayer.renderer"))&&"getDisplayedSymbol"in c)return c.getDisplayedSymbol(a,b)}}});