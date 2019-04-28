//>>built
define(["dojo/_base/kernel","dojo/_base/lang","dojo/_base/declare","../xml/DomParser"],function(e){e.getObject("sketch",!0,dojox);var f=dojox.sketch;f.CommandTypes={Create:"Create",Move:"Move",Modify:"Modify",Delete:"Delete",Convert:"Convert"};e.declare("dojox.sketch.UndoStack",null,{constructor:function(a){this.figure=a;this._steps=[];this._undoedSteps=[]},apply:function(a,b,c){if(b||c||!a.fullText){var d=b.shapeText;a=c.shapeText;if(0!=d.length||0!=a.length)0==d.length?(b=dojox.xml.DomParser.parse(a).documentElement,
(b=this.figure._loadAnnotation(b))&&this.figure._add(b)):0==a.length?(b=this.figure.getAnnotator(b.shapeId),this.figure._delete([b],!0)):(b=this.figure.getAnnotator(c.shapeId),c=dojox.xml.DomParser.parse(a).documentElement,b.draw(c),this.figure.select(b))}else this.figure.setValue(a.fullText)},add:function(a,b,c){var d=b?b.id:"";b=b?b.serialize():"";a==f.CommandTypes.Delete&&(b="");this._steps.push({cmdname:a,before:{shapeId:d,shapeText:c||""},after:{shapeId:d,shapeText:b}});this._undoedSteps=[]},
destroy:function(){},undo:function(){var a=this._steps.pop();a&&(this._undoedSteps.push(a),this.apply(a,a.after,a.before))},redo:function(){var a=this._undoedSteps.pop();a&&(this._steps.push(a),this.apply(a,a.before,a.after))}});return dojox.sketch.UndoStack});