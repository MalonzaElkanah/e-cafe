# Diagram Library for JavaScript and TypeScript

A diagram library that enables you to build any type of graph, flowchart, tree, org chart, diagram, process chart, database schema and much more. Includes a huge variety of prdefined node and link shapes, automatic layout algorithms, many import and export options.

### Installing

For the latest stable version:

```
npm install -g diagram-library
```

### New Features in JS Diagram 3.2.1

* Path finding
   The [PathFinder](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?T_MindFusion_Diagramming_PathFinder_0.htm) class provides methods that help you find paths and cycles in a graph:
   - [findShortestPath](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?M_MindFusion_Diagramming_PathFinder_findShortestPath_4_DiagramNode_DiagramNode_Boolean_Boolean_0.htm) finds the shortest path between two DiagramNode objects.
   - [findLongestPath](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?M_MindFusion_Diagramming_PathFinder_findLongestPath_2_DiagramNode_DiagramNode_0.htm) finds the longest path between the specified DiagramNode objects.
   - [findCycle](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?M_MindFusion_Diagramming_PathFinder_findCycle_1_DiagramNode_0.htm) detects whether the specified DiagramNode participates in a cycle.
   - [findAllPaths](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?M_MindFusion_Diagramming_PathFinder_findAllPaths_3_DiagramNode_DiagramNode_Number.htm) finds all paths that exist between two DiagramNode objects.
   - [findAllCycles](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?M_MindFusion_Diagramming_PathFinder_findAllCycles_0_0.htm) finds all cycles in the underlying diagram.
   [Path](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?T_MindFusion_Diagramming_Path_0.htm) objects returned by these methods contain [nodes](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?F_MindFusion_Diagramming_Path_nodes.htm), [links](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?F_MindFusion_Diagramming_Path_links.htm) and [items](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?F_MindFusion_Diagramming_Path_items.htm) arrays containing sequences of elements in the path. The new PathFinder sample page included in distribution demonstrates path finding and animations over the found paths.
   
* Embedded hyperlinks
   Nodes and [Text](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?T_MindFusion_Drawing_Text.htm) components with style text enabled can now contain <a> tags to create hyperlinks. When a link is clicked, the control raises [hyperlinkClicked](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?F_MindFusion_Diagramming_Events_hyperlinkClicked.htm) event to let you implement navigation:  
   
```
// node is a ShapeNode instance
node.setText("test <a='http://mindfusion.eu'>link</a> test");
node.setEnableStyledText(true);

// attach an event listener to the hyperlinkClicked event
diagram.addEventListener(Events.hyperlinkClicked, onHyperlinkClicked);

function onHyperlinkClicked(sender, args)
{
    window.open(args.getHyperlink());
}

```

* Miscellaneous
  - The [serializeTag](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?F_MindFusion_Diagramming_Events_serializeTag.htm) event lets you save complex Tag and [Id](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?M_MindFusion_Diagramming_DiagramItem_getId_0.htm) objects in XML format.
  - Various arrowhead rendering fixes.
 

### Documentation

1. [Detailed API Reference](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm)
2. [Tutorials and Step-by-step Guides](https://www.mindfusion.eu/onlinehelp/jsdiagram/index.htm?CC_Tutorial_1__Loading_Graph_Data_1.htm)


### Samples

A variety of online samples are uploaded at the [MindFusion Js Diagram website.](https://mindfusion.eu/javascript-diagram-demo.html) You can also visit the [online demo for Js Diagram.](https://mindfusion.co/demos/?sample=102) You can download an archive with all samples and all files for the library [from here.](http://mindfusion.eu/JsDiagramTrial.zip)


### Additional Information

Learn more about JS Diagram [from the official product page.](https://mindfusion.eu/javascript-diagram.html) Stay in touch with MindFusion about our latest product announcements, tutorials and programming guidelines via  [Twitter](https://twitter.com/MindFusion_News) or [our company blog.](https://mindfusion.eu/blog/)



## Technical Support

* [Forum](https://mindfusion.eu/Forum/YaBB.pl?board=jsdiag_disc)
* [E-mail](support@mindfusion.eu)
* [Help desk](https://www.mindfusion.eu/HelpDesk/index.php)

### Licensing

The end-user license agreement for JS Diagram is [here.](https://mindfusion.eu/eula.html)


