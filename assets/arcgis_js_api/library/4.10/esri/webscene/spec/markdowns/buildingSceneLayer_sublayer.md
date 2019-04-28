# Building Scene Sublayer

The BuildingSceneLayer sublayer is a part of a building scene layer.

### Properties

| Property | Details
| --- | ---
| disablePopup | disablePopups allows a client to ignore popups defined by the service item.
| id | Identifies the sublayer inside the building scene layer.
| layerDefinition | Additional properties that can define drawing information and a definition expression for the sublayer.<br>See [layerDefinition properties](#layerdefinition-properties) table.
| opacity | The degree of transparency applied to the sublayer on the client side, where 0 is full transparency and 1 is no transparency. This is multiplied with the opacity of the containing layers.
| [popupInfo](popupInfo.md) | A popupInfo object defining the content of pop-up windows when you click or query a feature.
| title | A user-friendly string title for the sublayer that can be used in a table of contents.
| visibility | Boolean property determining whether the sublayer is initially visible in the web scene


### layerDefinition properties

| Property | Details
| --- | ---
| definitionExpression | SQL-based definition expression string that narrows the data to be displayed in the layer.
| [drawingInfo](drawingInfo.md) | Contains the drawing and labeling information.



