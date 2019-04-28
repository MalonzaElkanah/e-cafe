// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../../../core/tsSupport/extendsHelper ../../../../core/Logger ../../../../core/libs/gl-matrix-2/gl-matrix ../../support/geometryUtils ../../support/buffer/InterleavedLayout ../lib/ComponentUtils ../lib/GLMaterial ../lib/Material ../lib/Util ./internal/bufferWriters ./internal/MaterialUtil ../shaders/NativeLinePrograms".split(" "),function(E,W,z,J,b,c,K,L,F,M,v,N,r,G){var O=J.getLogger("esri.views.3d.webgl-engine.materials.NativeLineMaterial");E=function(l){function a(d,
a){a=l.call(this,a)||this;a.bufferWriter=new P;a.canBeMerged=!0;a.params=r.copyParameters(d,Q);return a}z(a,l);a.prototype.setParameterValues=function(a){var d=this.params,b;for(b in a)d[b]=a[b];this.notifyDirty("matChanged")};a.prototype.getColor=function(){return this.params.color};a.prototype.getParameterValues=function(){return r.copyParameters(this.params)};a.prototype.intersect=function(a,g,n,l,m,e,r,f){if(l.isSelection&&!L.isAllHidden(g.componentVisibilities,a.data.componentOffsets))if(v.isTranslationMatrix(n)){g=
a.data.getVertexAttr().position.data;m=l.camera;e=l.point;b.vec3.set(y[0],e[0]-2,e[1]+2,0);b.vec3.set(y[1],e[0]+2,e[1]+2,0);b.vec3.set(y[2],e[0]+2,e[1]-2,0);b.vec3.set(y[3],e[0]-2,e[1]-2,0);for(f=0;4>f;f++)m.unprojectPoint(y[f],q[f]);c.plane.fromPoints(m.eye,q[0],q[1],A);c.plane.fromPoints(m.eye,q[1],q[2],B);c.plane.fromPoints(m.eye,q[2],q[3],C);c.plane.fromPoints(m.eye,q[3],q[0],D);a=Number.MAX_VALUE;for(f=0;f<g.length-5;f+=3)if(h[0]=g[f]+n[12],h[1]=g[f+1]+n[13],h[2]=g[f+2]+n[14],k[0]=g[f+3]+n[12],
k[1]=g[f+4]+n[13],k[2]=g[f+5]+n[14],!(0>c.plane.signedDistance(A,h)&&0>c.plane.signedDistance(A,k)||0>c.plane.signedDistance(B,h)&&0>c.plane.signedDistance(B,k)||0>c.plane.signedDistance(C,h)&&0>c.plane.signedDistance(C,k)||0>c.plane.signedDistance(D,h)&&0>c.plane.signedDistance(D,k))){m.projectPoint(h,w);m.projectPoint(k,x);if(0>w[2]&&0<x[2]){b.vec3.subtract(p,h,k);var d=m.frustum,t=-c.plane.signedDistance(d.planes[4],h),d=t/b.vec3.dot(p,d.planes[4]);b.vec3.scale(p,p,d);b.vec3.add(h,h,p);m.projectPoint(h,
w)}else if(0<w[2]&&0>x[2])b.vec3.subtract(p,k,h),d=m.frustum,t=-c.plane.signedDistance(d.planes[4],k),d=t/b.vec3.dot(p,d.planes[4]),b.vec3.scale(p,p,d),b.vec3.add(k,k,p),m.projectPoint(k,x);else if(0>w[2]&&0>x[2])continue;d=v.pointLineSegmentDistanceSquared2D(w,x,e);d<a&&(a=d,b.vec3.copy(H,h),b.vec3.copy(I,k))}n=l.p0;l=l.p1;4>a&&(a=Number.MAX_VALUE,c.lineSegment.closestLineSegmentPoint(c.lineSegment.fromPoints(H,I,R),c.lineSegment.fromPoints(n,l,S),u)&&(b.vec3.subtract(u,u,n),a=b.vec3.length(u),b.vec3.scale(u,
u,1/a),a/=b.vec3.distance(n,l)),r(a,u))}else O.error("intersection assumes a translation-only matrix")};a.prototype.getGLMaterials=function(){return{color:T,depthShadowMap:void 0,normal:void 0,depth:void 0,highlight:U}};a.prototype.getAllTextureIds=function(){return[]};return a}(M);var T=function(b){function a(a,g,c){a=b.call(this,a,g)||this;a.updateParameters();return a}z(a,b);a.prototype.updateParameters=function(){this.params=this.material.getParameterValues();this.selectProgram()};a.prototype.selectProgram=
function(){this.program=this.programRep.getProgram(G.colorPass,{slice:this.params.slicePlaneEnabled})};a.prototype.beginSlot=function(a){return 4===a};a.prototype.getProgram=function(){return this.program};a.prototype.bind=function(a,b){b=this.program;var d=this.params;a.bindProgram(b);b.setUniform4fv("color",d.color);a.setBlendingEnabled(1>d.color[3]);a.setBlendFunctionSeparate(770,771,1,771);a.setDepthTestEnabled(!0)};a.prototype.release=function(a){1>this.params.color[3]&&a.setBlendingEnabled(!1)};
a.prototype.bindView=function(a,b){a=this.program;var d=this.params;r.bindView(b.origin,b.view,a);d.slicePlaneEnabled&&r.bindSlicePlane(b.origin,b.slicePlane,a)};a.prototype.bindInstance=function(a,b){this.program.setUniformMatrix4fv("model",b.transformation)};a.prototype.getDrawMode=function(){return 1};return a}(F),U=function(b){function a(a,g,c){a=b.call(this,a,g)||this;a.updateParameters();return a}z(a,b);a.prototype.updateParameters=function(){this.params=this.material.getParameterValues();this.selectProgram()};
a.prototype.beginSlot=function(a){return 4===a};a.prototype.getProgram=function(){return this.program};a.prototype.selectProgram=function(){this.program=this.programRep.getProgram(G.highlightPass,{slice:this.params.slicePlaneEnabled})};a.prototype.bind=function(a,b){a.bindProgram(this.program);a.setDepthTestEnabled(!0)};a.prototype.release=function(a){};a.prototype.bindView=function(a,b){a=this.program;var c=this.params;r.bindView(b.origin,b.view,a);c.slicePlaneEnabled&&r.bindSlicePlane(b.origin,
b.slicePlane,a)};a.prototype.bindInstance=function(a,b){this.program.setUniformMatrix4fv("model",b.transformation)};a.prototype.getDrawMode=function(){return 1};return a}(F),Q={color:[1,1,1,1],slicePlaneEnabled:!1},V=K.newLayout().vec3f(v.VertexAttrConstants.POSITION),t,P=function(){function b(){this.vertexBufferLayout=V}b.prototype.allocate=function(a){return this.vertexBufferLayout.createBuffer(a)};b.prototype.elementCount=function(a){return a.indices[v.VertexAttrConstants.POSITION].length};b.prototype.write=
function(a,b,c,h,k){var d=c=b.vertexAttr[v.VertexAttrConstants.POSITION].data;if(a=a.transformation){if(!t||t.length<c.length)t=new Float32Array(c.length);for(var d=t,e=0;e<c.length;e+=3){var g=c[e],f=c[e+1],l=c[e+2];d[e]=a[0]*g+a[4]*f+a[8]*l+a[12];d[e+1]=a[1]*g+a[5]*f+a[9]*l+a[13];d[e+2]=a[2]*g+a[6]*f+a[10]*l+a[14]}}N.writeBufferVec3(b.indices[v.VertexAttrConstants.POSITION],d,h.position,k)};return b}(),h=b.vec3f64.create(),k=b.vec3f64.create(),p=b.vec3f64.create(),u=b.vec3f64.create(),w=b.vec3f64.create(),
x=b.vec3f64.create(),H=b.vec3f64.create(),I=b.vec3f64.create(),R=c.lineSegment.create(),S=c.lineSegment.create(),y=[b.vec3f64.create(),b.vec3f64.create(),b.vec3f64.create(),b.vec3f64.create()],q=[b.vec3f64.create(),b.vec3f64.create(),b.vec3f64.create(),b.vec3f64.create()],A=c.plane.create(),B=c.plane.create(),C=c.plane.create(),D=c.plane.create();return E});