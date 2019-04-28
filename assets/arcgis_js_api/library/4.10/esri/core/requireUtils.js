// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["require","exports","./promiseUtils"],function(g,c,e){function d(a,b){return Array.isArray(b)?e.create(function(f){a(b,function(){for(var b=[],a=0;a<arguments.length;a++)b[a]=arguments[a];f(b)})}):d(a,[b]).then(function(a){return a[0]})}Object.defineProperty(c,"__esModule",{value:!0});c.when=d;c.getAbsMid=function(a,b,c){return b.toAbsMid?b.toAbsMid(a):c.id.replace(/\/[^\/]*$/gi,"/")+a}});