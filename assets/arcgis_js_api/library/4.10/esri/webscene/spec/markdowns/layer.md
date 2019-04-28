# layer

A layer object may allow overrides on popup content and drawing behavior for individual layers of a web service. This object also contains geographic features and their attributes when used in a feature collection.

### Properties

| Property | Details
| --- | ---
| defaultVisibility | Default visibility of the layers in the map service.
| [definitionEditor](definitionEditor.md) | An object that provides interactive filters.
| disablePopup | Indicates whether to allow a client to ignore the popups defined on the layer. The popupInfo object could be saved in the map or item.
| [featureSet](featureSet.md) | A featureSet object containing the geometry and attributes of the features in the layer.
| [field](field.md) | Information about each field in a layer. Used with feature collections.
| id | The layer id, as a numeric value.
| [layerDefinition](layerDefinition.md) | The layerDefinition object defines the attribute schema and drawing information for the layer.
| layerItemId | The associated query layer's itemId. Only available when there is a `layerUrl`.  You will see this if [popups are configured](https://doc.arcgis.com/en/arcgis-online/manage-data/publish-tiles-from-features.htm) on it.
| layerUrl | A URL to a service that should be used for all queries against the layer.
| maxScale | A number representing the maximum scale at which the layer will be visible. The number is the scale's denominator.
| minScale | A number representing the minimum scale at which the layer will be visible. The number is the scale's denominator.
| name | The name of the layer.
| nextObjectId | Iterates within a featureset. Number objectId value is incremented 1 based on last Object ID defined for the feature in a featureset. Used with feature collections.
| parentLayerId | If working with nested layers, this is the numeric value indicating the layer id of the next layer (parent) directly above the current referenced layer.
| [popupInfo](popupInfo.md) | A popupInfo object defining the popup window content for the layer.
| showLabels | A Boolean indicating if the layer should display labels in client applications.
| showLegend | A Boolean indicating if the layer should be shown in the legend in client applications.
| subLayer | Integer value indicating the layer id.
| subLayerIds | If the layer is a parent layer, it will have one or more sub layers included in an array.
| title | A user-friendly string title for the layer that can be used in a table of contents.



