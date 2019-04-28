// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports"],function(f,b){Object.defineProperty(b,"__esModule",{value:!0});var d=new Float32Array(1),e=new Uint32Array(d.buffer);b.nextHighestPowerOfTwo=function(c){var a=c;a--;a|=a>>1;a|=a>>2;a|=a>>4;a|=a>>8;a|=a>>16;a++;var b=a>>1;return a-c>c-b?b:a};b.toUint32=function(c){d[0]=c;return e[0]};b.toFloat32=function(c){e[0]=c;return d[0]};b.i1616to32=function(c,a){return 65535&c|a<<16};b.i8888to32=function(c,a,b,d){return c&255|(a&255)<<8|(b&255)<<16|d<<24};b.i8816to32=function(c,
a,b){return c&255|(a&255)<<8|b<<16};b.numTo32=function(b){return b|0}});