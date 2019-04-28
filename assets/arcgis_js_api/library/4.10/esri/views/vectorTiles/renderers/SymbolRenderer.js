// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","./IconRenderer","./SDFRenderer"],function(r,t,d,e){return function(){function a(b){this._iconRenderer=new d(b);this._sdfRenderer=new e(b)}a.prototype.dispose=function(){this._iconRenderer&&(this._iconRenderer.dispose(),this._iconRenderer=null);this._sdfRenderer&&(this._sdfRenderer.dispose(),this._sdfRenderer=null)};a.prototype.render=function(b,c,a,f,g,h,k,l,d,e,m,n,q,p){c.hasData()&&(0<c.markerPerPageElementsMap.size&&this._iconRenderer.render(b,c,a,f,g,h,k,l,d,m,n,p),
0<c.glyphPerPageElementsMap.size&&this._sdfRenderer.render(b,c,a,f,g,h,k,l,e,m,n,q,p))};return a}()});