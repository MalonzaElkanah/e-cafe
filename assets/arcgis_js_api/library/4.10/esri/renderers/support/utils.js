// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("dojo/date/locale ../../Color ../../core/lang ../../core/numberUtils ../../core/unitUtils dojo/i18n!dojo/cldr/nls/gregorian".split(" "),function(q,y,n,k,c,t){function r(a,b,d){var e="";0===b?e=m.lt+" ":b===d&&(e=m.gt+" ");return e+a}var l={},m={lte:"\x3c\x3d",gte:"\x3e\x3d",lt:"\x3c",gt:"\x3e",pct:"%",ld:"\u2013"},u={millisecond:0,second:1,minute:2,hour:3,day:4,month:5,year:6},v={millisecond:{dateOptions:{formatLength:"long"},timeOptions:{formatLength:"medium"}},second:{dateOptions:{formatLength:"long"},
timeOptions:{formatLength:"medium"}},minute:{dateOptions:{formatLength:"long"},timeOptions:{formatLength:"short"}},hour:{dateOptions:{formatLength:"long"},timeOptions:{formatLength:"short"}},day:{selector:"date",dateOptions:{formatLength:"long"}},month:{selector:"date",dateOptions:{formatLength:"long"}},year:{selector:"date",dateOptions:{selector:"year"}}},w={formatLength:"short",fullYear:!0},x={formatLength:"short"};n.mixin(l,{meterIn:{inches:c.convertUnit(1,"meters","inches"),feet:c.convertUnit(1,
"meters","feet"),"us-feet":c.convertUnit(1,"meters","us-feet"),yards:c.convertUnit(1,"meters","yards"),miles:c.convertUnit(1,"meters","miles"),"nautical-miles":c.convertUnit(1,"meters","nautical-miles"),millimeters:c.convertUnit(1,"meters","millimeters"),centimeters:c.convertUnit(1,"meters","centimeters"),decimeters:c.convertUnit(1,"meters","decimeters"),meters:c.convertUnit(1,"meters","meters"),kilometers:c.convertUnit(1,"meters","kilometers"),"decimal-degrees":1/c.lengthToDegrees(1,"meters")},timelineDateFormatOptions:{selector:"date",
dateOptions:{formatLength:"short",fullYear:!0}},formatDate:function(a,b){var d=[];null==a||a instanceof Date||(a=new Date(a));b=b||{};b=n.mixin({},b);var e=b.selector?b.selector.toLowerCase():null,f=!e||-1<e.indexOf("time"),e=!e||-1<e.indexOf("date");f&&(b.timeOptions=b.timeOptions||x,b.timeOptions&&(b.timeOptions=n.mixin({},b.timeOptions),b.timeOptions.selector=b.timeOptions.selector||"time",d.push(b.timeOptions)));e&&(b.dateOptions=b.dateOptions||w,b.dateOptions&&(b.dateOptions=n.mixin({},b.dateOptions),
b.dateOptions.selector=b.dateOptions.selector||"date",d.push(b.dateOptions)));d&&d.length?(d=d.map(function(b){return q.format(a,b)}),b=1==d.length?d[0]:t["dateTimeFormat-medium"].replace(/\'/g,"").replace(/\{(\d+)\}/g,function(b,a){return d[a]})):b=q.format(a);return b},createColorStops:function(a){var b=a.values,d=a.colors,e=a.labelIndexes,f=a.isDate,g=a.dateFormatOptions;a=[];return a=b.map(function(a,h){var p=null;if(!e||-1<e.indexOf(h)){var c;(c=f?l.formatDate(a,g):k.format(a))&&(p=r(c,h,b.length-
1))}return{value:a,color:d[h],label:p}})},updateColorStops:function(a){var b=a.stops,d=a.changes,e=a.isDate,f=a.dateFormatOptions,g=[],p,c=b.map(function(a){return a.value});d.forEach(function(a){g.push(a.index);c[a.index]=a.value});p=k.round(c,{indexes:g});b.forEach(function(a,d){a.value=c[d];if(null!=a.label){var g,h=null;(g=e?l.formatDate(p[d],f):k.format(p[d]))&&(h=r(g,d,b.length-1));a.label=h}})},createClassBreakLabel:function(a){var b=a.minValue,d=a.maxValue,e=a.isFirstBreak?"":m.gt+" ";a="percent-of-total"===
a.normalizationType?m.pct:"";b=null==b?"":k.format(b);d=null==d?"":k.format(d);return e+b+a+" "+m.ld+" "+d+a},setLabelsForClassBreaks:function(a){var b=a.classBreakInfos,d=a.classificationMethod,e=a.normalizationType,f=[];b&&b.length&&("standard-deviation"===d?console.log("setLabelsForClassBreaks: cannot set labels for class breaks generated using 'standard-deviation' method."):a.round?(f.push(b[0].minValue),b.forEach(function(a){f.push(a.maxValue)}),f=k.round(f),b.forEach(function(a,b){a.label=l.createClassBreakLabel({minValue:0===
b?f[0]:f[b],maxValue:f[b+1],isFirstBreak:0===b,normalizationType:e})})):b.forEach(function(a,b){a.label=l.createClassBreakLabel({minValue:a.minValue,maxValue:a.maxValue,isFirstBreak:0===b,normalizationType:e})}))},updateClassBreak:function(a){var b=a.classBreaks,d=a.normalizationType,e=a.change,f=e.index,e=e.value,g=-1,c=-1,h=b.length;"standard-deviation"===a.classificationMethod?console.log("updateClassBreak: cannot update labels for class breaks generated using 'standard-deviation' method."):(0===
f?g=f:f===h?c=f-1:(c=f-1,g=f),-1<g&&g<h&&(a=b[g],a.minValue=e,a.label=l.createClassBreakLabel({minValue:a.minValue,maxValue:a.maxValue,isFirstBreak:0===g,normalizationType:d})),-1<c&&c<h&&(a=b[c],a.maxValue=e,a.label=l.createClassBreakLabel({minValue:a.minValue,maxValue:a.maxValue,isFirstBreak:0===c,normalizationType:d})))},calculateDateFormatInterval:function(a){var b,d,e=a.length,f,c,l,h,k,m,n=Infinity,q;a=a.map(function(a){return new Date(a)});for(b=0;b<e-1;b++){f=a[b];l=[];k=Infinity;m="";for(d=
b+1;d<e;d++)c=a[d],c=f.getFullYear()!==c.getFullYear()&&"year"||f.getMonth()!==c.getMonth()&&"month"||f.getDate()!==c.getDate()&&"day"||f.getHours()!==c.getHours()&&"hour"||f.getMinutes()!==c.getMinutes()&&"minute"||f.getSeconds()!==c.getSeconds()&&"second"||"millisecond",h=u[c],h<k&&(k=h,m=c),l.push(c);k<n&&(n=k,q=m)}return q},createUniqueValueLabel:function(a){var b=a.value,c=a.fieldInfo,e=a.domain;a=a.dateFormatInterval;var f=String(b);(e=e&&e.codedValues?e.getName(b):null)?f=e:"number"===typeof b&&
(f=c&&"date"===c.type?l.formatDate(b,a&&v[a]):k.format(b));return f}});return l});