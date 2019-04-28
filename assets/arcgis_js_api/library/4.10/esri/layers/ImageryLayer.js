// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require ../core/lang ../core/promiseUtils ./Layer ./mixins/ArcGISImageService ./mixins/OperationalLayer ./mixins/PortalLayer ./mixins/ScaleRangeLayer ./mixins/RefreshableLayer ./support/commonProperties".split(" "),function(d,f,e,g,h,k,l,m,n,b){var c={canvas2D:"2d",webGL:"webgl",expWebGL:"experimental-webgl",webGL2:"webgl2",expWebGL2:"experimental-webgl2"};return g.createSubclass([h,k,l,m,n],{declaredClass:"esri.layers.ImageryLayer",normalizeCtorArgs:function(a,p){return"string"===typeof a?
f.mixin({},{url:a},p):a},load:function(){this.addResolvingPromise(this.loadFromPortal({supportedTypes:["Image Service"]}).then(this._fetchService.bind(this),this._fetchService.bind(this)))},properties:{url:b.url,drawMode:!0,drawType:{value:c.canvas2D,cast:function(a){return a in c?a:c.canvas2D}},legendEnabled:b.legendEnabled,operationalLayerType:{type:["ArcGISImageServiceLayer"],value:"ArcGISImageServiceLayer"},popupEnabled:b.popupEnabled,pixelFilter:null,type:{value:"imagery",json:{read:!1}}},redraw:function(){this.emit("redraw")},
importLayerViewModule:function(a){switch(a.type){case "2d":return e.create(function(a){d(["../views/2d/layers/ImageryLayerView2D"],a)});case "3d":return e.create(function(a){d(["../views/3d/layers/ImageryLayerView3D"],a)})}}})});