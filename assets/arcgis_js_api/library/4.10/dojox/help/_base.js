//>>built
define(["dojo","dijit","dojox","dojo/require!dojox/rpc/Service,dojo/io/script"],function(d,q,a){d.provide("dojox.help._base");d.require("dojox.rpc.Service");d.require("dojo.io.script");d.experimental("dojox.help");console.warn("Script causes side effects (on numbers, strings, and booleans). Call dojox.help.noConflict() if you plan on executing code.");a.help={locate:function(c,b,l){l=l||20;var f=[],h={},g;if(b){d.isArray(b)||(b=[b]);for(var e=0,k;k=b[e];e++){g=k;if(d.isString(k)){if(k=d.getObject(k),
!k)continue}else if(d.isObject(k))g=k.__name__;else continue;f.push(k);g&&(g=g.split(".")[0],h[g]||-1!=d.indexOf(a.help._namespaces,g)||a.help.refresh(g),h[g]=!0)}}f.length||(f.push({__name__:"window"}),d.forEach(a.help._namespaces,function(a){h[a]=!0}));c=c.toLowerCase();b=[];e=0;a:for(;k=f[e];e++){var n=k.__name__||"";g=d.some(f,function(a){a=a.__name__||"";return 0==n.indexOf(a+".")});if(n&&!g){g=n.split(".")[0];k=[];if("window"==n)for(g in a.help._names)d.isArray(a.help._names[g])&&(k=k.concat(a.help._names[g]));
else k=a.help._names[g];g=0;for(var m;m=k[g];g++)if(("window"==n||0==m.indexOf(n+"."))&&-1!=m.toLowerCase().indexOf(c)&&".prototype"!=m.slice(-10)){var p=d.getObject(m);if(p&&(b.push([m,p]),b.length==l))break a}}}a.help._displayLocated(b);if(!d.isMoz)return""},refresh:function(c,b){2>arguments.length&&(b=!0);a.help._recurse(c,b)},noConflict:function(c){if(arguments.length)return a.help._noConflict(c);for(;a.help._overrides.length;){var b=a.help._overrides.pop(),d=b[0],b=b[1];d[b]=a.help._noConflict(d[b])}},
init:function(c,b){c&&a.help._namespaces.concat(c);d.addOnLoad(function(){d.require=function(c){return function(){a.help.noConflict();c.apply(d,arguments);a.help._timer&&clearTimeout(a.help._timer);a.help._timer=setTimeout(function(){d.addOnLoad(function(){a.help.refresh();a.help._timer=!1})},500)}}(d.require);a.help._recurse()})},_noConflict:function(a){if(a instanceof String)return a.toString();if(a instanceof Number)return+a;if(a instanceof Boolean)return 1==a;d.isObject(a)&&(delete a.__name__,
delete a.help);return a},_namespaces:["dojo","dojox","dijit","djConfig"],_rpc:new a.rpc.Service(d.moduleUrl("dojox.rpc.SMDLibrary","dojo-api.smd")),_attributes:["summary","type","returns","parameters"],_clean:function(c){for(var b={},d=0,f;f=a.help._attributes[d];d++){var h=c["__"+f+"__"];h&&(b[f]=h)}return b},_displayLocated:function(a){throw Error("_displayLocated should be overridden in one of the dojox.help packages");},_displayHelp:function(a,b){throw Error("_displayHelp should be overridden in one of the dojox.help packages");
},_addVersion:function(a){if(a.name){a.version=[d.version.major,d.version.minor,d.version.patch].join(".");var b=a.name.split(".");if("dojo"==b[0]||"dijit"==b[0]||"dojox"==b[0])a.project=b[0]}return a},_stripPrototype:function(a){var b=a.replace(/\.prototype(\.|$)/g,"."),c=b;"."==b.slice(-1)?c=b=b.slice(0,-1):b=a;return[c,b]},_help:function(){for(var c=a.help._stripPrototype(this.__name__)[0],b=[],l=0,f;f=a.help._attributes[l];l++)this["__"+f+"__"]||b.push(f);a.help._displayHelp(!0,{name:this.__name__});
!b.length||this.__searched__?a.help._displayHelp(!1,a.help._clean(this)):(this.__searched__=!0,a.help._rpc.get(a.help._addVersion({name:c,exact:!0,attributes:b})).addCallback(this,function(b){this.toString===a.help._toString&&this.toString(b);if(b&&b.length){b=b[0];for(var c=0,e;e=a.help._attributes[c];c++)b[e]&&(this["__"+e+"__"]=b[e]);a.help._displayHelp(!1,a.help._clean(this))}else a.help._displayHelp(!1,!1)}));if(!d.isMoz)return""},_parse:function(c){delete this.__searching__;if(c&&c.length){if(c=
c[0].parameters){var b=["function ",this.__name__,"("];this.__parameters__=c;for(var d=0,f;f=c[d];d++){d&&b.push(", ");b.push(f.name);if(f.types){for(var h=[],g=0,e;e=f.types[g];g++)h.push(e.title);h.length&&(b.push(": "),b.push(h.join("|")))}f.repeating&&b.push("...");f.optional&&b.push("?")}b.push(")");this.__source__=this.__source__.replace(/function[^\(]*\([^\)]*\)/,b.join(""))}this.__output__&&(delete this.__output__,console.log(this))}else a.help._displayHelp(!1,!1)},_toStrings:{},_toString:function(c){if(!this.__source__)return this.__name__;
var b=!this.__parameters__;this.__parameters__=[];c?a.help._parse.call(this,c):b&&(this.__searching__=!0,a.help._toStrings[a.help._stripPrototype(this.__name__)[0]]=this,a.help._toStringTimer&&clearTimeout(a.help._toStringTimer),a.help._toStringTimer=setTimeout(function(){a.help.__toString()},50));if(!b||!this.__searching__)return this.__source__;var l="function Loading info for "+this.__name__+"... (watch console for result) {}";return d.isMoz?{toString:d.hitch(this,function(){this.__output__=!0;
return l})}:(this.__output__=!0,l)},__toString:function(){a.help._toStringTimer&&clearTimeout(a.help._toStringTimer);var c=[];a.help.noConflict(a.help._toStrings);for(var b in a.help._toStrings)c.push(b);for(;c.length;)a.help._rpc.batch(a.help._addVersion({names:c.splice(-50,50),exact:!0,attributes:["parameters"]})).addCallback(this,function(b){for(var c=0,d;d=b[c];c++){var g=a.help._toStrings[d.name];g&&(a.help._parse.call(g,[d]),delete a.help._toStrings[d.name])}})},_overrides:[],_recursions:[],
_names:{},_recurse:function(c,b){2>arguments.length&&(b=!0);var l=[];if(c&&d.isString(c))a.help.__recurse(d.getObject(c),c,c,l,b);else for(var f=0,h;h=a.help._namespaces[f];f++)window[h]&&(a.help._recursions.push([window[h],h,h]),window[h].__name__=h,window[h].help||(window[h].help=a.help._help));for(;a.help._recursions.length;)f=a.help._recursions.shift(),a.help.__recurse(f[0],f[1],f[2],l,b);for(f=0;h=l[f];f++)delete h.__seen__},__recurse:function(c,b,l,f,h){for(var g in c)if(!g.match(/([^\w_.$]|__[\w_.$]+__)/)){var e=
c[g];if(!("undefined"==typeof e||e===document||e===window||e===a.help._toString||e===a.help._help||null===e||+d.isIE&&e.tagName||e.__seen__)){var k=d.isFunction(e),n=d.isObject(e)&&!d.isArray(e)&&!e.nodeType,m=l?l+"."+g:g;if("dojo._blockAsync"!=m){if(!e.__name__){var p=null;d.isString(e)?p=String:"number"==typeof e?p=Number:"boolean"==typeof e&&(p=Boolean);p&&(e=c[g]=new p(e))}e.__seen__=!0;e.__name__=m;(a.help._names[b]=a.help._names[b]||[]).push(m);f.push(e);k||a.help._overrides.push([c,g]);(k||
n)&&h&&a.help._recursions.push([e,b,m]);k&&(e.__source__||(e.__source__=e.toString().replace(/^function\b ?/,"function "+m)),e.toString===Function.prototype.toString&&(e.toString=a.help._toString));e.help||(e.help=a.help._help)}}}}}});