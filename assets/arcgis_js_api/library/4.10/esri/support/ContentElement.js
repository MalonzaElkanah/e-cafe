// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See https://js.arcgis.com/4.10/esri/copyright.txt for details.
//>>built
define("require exports ./ContentElement/Attachments ./ContentElement/ContentElement ./ContentElement/Fields ./ContentElement/Media ./ContentElement/Text".split(" "),function(g,a,b,c,d,e,f){Object.defineProperty(a,"__esModule",{value:!0});a.AttachmentsContentElement=b;a.BaseContentElement=c;a.FieldsContentElement=d;a.MediaContentElement=e;a.TextContentElement=f;a.isContentElement=function(b){return b instanceof a.BaseContentElement};a.types={base:null,key:"type",typeMap:{attachment:a.AttachmentsContentElement,
fields:a.FieldsContentElement,media:a.MediaContentElement,text:a.TextContentElement}}});