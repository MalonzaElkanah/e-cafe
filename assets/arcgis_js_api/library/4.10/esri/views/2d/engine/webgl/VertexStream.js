// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","../../../../core/tsSupport/declareExtendsHelper","../../../webgl/BufferObject","../../../webgl/VertexArrayObject"],function(f,g,h,b,c){return function(){function a(a,d,e){this.rctx=a;this.texcoordScale=this.positionScale=1;this._vertexBuffer=b.createVertex(a,35044,(new Int16Array(d)).buffer);this._indexBuffer=b.createIndex(a,35044,new Uint16Array(e));this._vao=new c(a,{a_position:0,a_texcoord:1},{geometry:[{name:"a_position",count:2,type:5122,offset:0,stride:8,normalized:!0},
{name:"a_texcoord",count:2,type:5122,offset:4,stride:8,normalized:!0}]},{geometry:this._vertexBuffer},this._indexBuffer)}a.prototype.bind=function(){this._vao.bind()};a.prototype.unbind=function(){this._vao.unbind()};a.prototype.dispose=function(){this._vao.dispose(!1);this._vertexBuffer.dispose();this._indexBuffer.dispose()};a.prototype.draw=function(){this.rctx.drawElements(4,this._indexBuffer.size,5123,0)};return a}()});