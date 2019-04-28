// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../../core/tsSupport/extendsHelper ./Graphics3DGraphic ./Graphics3DObject3DGraphicLayer ./Graphics3DSymbolLayerFactory ./symbolComplexity ../../support/PromiseLightweight".split(" "),function(w,x,n,p,q,r,t,u){return function(l){function d(a,g,c){var b=l.call(this)||this;b.symbol=a;b.referenced=0;a=a.symbolLayers;c&&(a=c.concat(a));c=a.length;b.childGraphics3DSymbols=Array(a.length);b.childGraphics3DSymbolPromises=Array(a.length);for(var e=g.layerOrder,f=0,d=0,m=function(a,
c){c&&(b.childGraphics3DSymbols[a]=c,d++);f--;!b.isRejected()&&1>f&&(0<d?b.resolve():b.reject())},h=0;h<c;h++){var k=a.getItemAt(h);!1!==k.enabled&&(g.layerOrder=e+(1-(1+h)/c),g.layerOrderDelta=1/c,k=r.make(b.symbol,k,g,k._ignoreDrivers))&&(f++,b.childGraphics3DSymbolPromises[h]=k)}g.layerOrder=e;if(0===f)b.resolve();else{g=function(a){var b=v.childGraphics3DSymbolPromises[a];b&&b.then(function(){return m(a,b)},function(){return m(a,null)})};for(var v=this,h=0;h<c;h++)g(h)}return b}n(d,l);d.prototype.createGraphics3DGraphic=
function(a,g){for(var c=a.graphic,b=Array(this.childGraphics3DSymbols.length),e=0;e<this.childGraphics3DSymbols.length;e++){var f=this.childGraphics3DSymbols[e];f&&(b[e]=f.createGraphics3DGraphic(a))}return new p(c,g||this,b,a.layer)};Object.defineProperty(d.prototype,"complexity",{get:function(){return t.totalSymbolComplexities(this.childGraphics3DSymbols.map(function(a){return a&&a.complexity}))},enumerable:!0,configurable:!0});d.prototype.layerPropertyChanged=function(a,g){for(var c=this.childGraphics3DSymbols.length,
b=function(b){var c=e.childGraphics3DSymbols[b],d=function(a){a=a._graphics[b];return a instanceof q?a:null};if(c&&!c.layerPropertyChanged(a,g,d))return{value:!1}},e=this,f=0;f<c;f++){var d=b(f);if("object"===typeof d)return d.value}return!0};d.prototype.applyRendererDiff=function(a,d){return this.isResolved()?this.childGraphics3DSymbols.reduce(function(c,b,g){return c&&(!b||b.applyRendererDiff(a,d))},!0):!1};d.prototype.getFastUpdateStatus=function(){var a=0,d=0,c=0;this.childGraphics3DSymbolPromises.forEach(function(b){b&&
!b.isFulfilled()?a++:b&&b.isFastUpdatesEnabled()?c++:b&&d++});return{loading:a,slow:d,fast:c}};d.prototype.setDrawOrder=function(a,d){for(var c=this.childGraphics3DSymbols.length,b=1/c,e=0;e<c;e++){var f=this.childGraphics3DSymbols[e];f&&f.setDrawOrder(a+(1-(1+e)/c),b,d)}};d.prototype.destroy=function(){if(this.destroyed)console.error("Graphics3DSymbol.destroy called when already destroyed!");else{this.isFulfilled()||this.reject();for(var a=0;a<this.childGraphics3DSymbolPromises.length;a++)this.childGraphics3DSymbolPromises[a]&&
this.childGraphics3DSymbolPromises[a].destroy();this.childGraphics3DSymbols=this.childGraphics3DSymbolPromises=null}};Object.defineProperty(d.prototype,"destroyed",{get:function(){return null==this.childGraphics3DSymbols},enumerable:!0,configurable:!0});return d}(u.Promise)});