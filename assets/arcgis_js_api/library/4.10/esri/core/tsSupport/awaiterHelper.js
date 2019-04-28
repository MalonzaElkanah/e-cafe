// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define(["../promiseUtils"],function(d){function k(a){return a&&"function"===typeof a.then?a:d.resolve(a)}return function(a,l,p,e){var c=null;return d.create(function(m,f){function d(b){try{g(e.next(b))}catch(h){f(h)}}function n(b){try{g(e["throw"](b))}catch(h){f(h)}}function g(b){b.done?(c=k(b.value),c.then(m,f)):(c=k(b.value),c.then(d,n))}g((e=e.apply(a,l||[])).next())},function(a){c&&c.cancel(a)})}});