// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ../../core/tsSupport/extendsHelper ../3d/support/mathUtils ./FilteredFiniteDifference ./Momentum".split(" "),function(e,f,l,h,g,k){Object.defineProperty(f,"__esModule",{value:!0});e=function(){function a(b,d,c,a){void 0===b&&(b=2.5);void 0===d&&(d=.01);void 0===c&&(c=.95);void 0===a&&(a=12);this.minimumInitialVelocity=b;this.stopVelocity=d;this.friction=c;this.maxVelocity=a;this.value=new g.FilteredFiniteDifference(.8);this.time=new g.FilteredFiniteDifference(.3)}a.prototype.add=
function(b,a){if(this.time.hasLastValue){if(.01>this.time.computeDelta(a))return;if(this.value.hasFilteredDelta){var c=this.value.computeDelta(b);0>this.value.filteredDelta*c&&this.value.reset()}}this.time.update(a);this.value.update(b)};a.prototype.reset=function(){this.value.reset();this.time.reset()};a.prototype.evaluateMomentum=function(){if(!this.value.hasFilteredDelta)return null;var b=this.value.filteredDelta/this.time.filteredDelta,b=h.clamp(b,-this.maxVelocity,this.maxVelocity);return Math.abs(b)<
this.minimumInitialVelocity?null:this.createMomentum(b,this.stopVelocity,this.friction)};a.prototype.createMomentum=function(b,a,c){return new k.Momentum(b,a,c)};return a}();f.MomentumEstimator=e});