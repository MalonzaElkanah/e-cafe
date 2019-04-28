# Building Scene Layer (BuildingSceneLayer)

The BuildingSceneLayer is a layer type designed for on-demand streaming and displaying building data.

### Properties

| Property | Details
| --- | ---
| disablePopup | disablePopups allows a client to ignore popups defined by the service item.
| id | A unique identifying string for the layer.
| itemId | Optional string containing the item ID of the service if it's registered on ArcGIS Online or your organization's portal.
| layerDefinition | Additional properties that can define an elevation offset for the layer.<br>See [layerDefinition properties](#layerdefinition-properties) table.
| layerType | String indicating the layer type.<br>Value of this property must be `BuildingSceneLayer`
| listMode | To show or hide layers in the layer list<br>If property is present, must be one of the following values: <ul><li>`show`</li><li>`hide`</li></ul>
| opacity | The degree of transparency applied to the layer on the client side, where 0 is full transparency and 1 is no transparency.
| [sublayers](buildingSceneLayer_sublayer.md) | An array of objects specifying overrides for building scene layer sublayers
| title | A user-friendly string title for the layer that can be used in a table of contents.
| url | The URL to the service.
| visibility | Boolean property determining whether the layer is initially visible in the web scene


### layerDefinition properties

| Property | Details
| --- | ---
| [elevationInfo](elevationInfo.md) | Elevation info defines how features are aligned to ground or other layers.


### Example

Sample web scene showing the Building Scene Layer as an operationalLayer

```json
{
  "operationalLayers": [
    {
      "id": "14c4ab705ea-layer24",
      "opacity": 1,
      "title": "Building",
      "url": "https://peach.esri.com/server/rest/services/Hosted/NashvilleAirport_ESMerged/SceneServer/layers/0",
      "visibility": true,
      "layerType": "BuildingSceneLayer",
      "layerDefinition": {
        "elevationInfo": {
          "mode": "absoluteHeight",
          "offset": 100
        }
      },
      "sublayers": [
        {
          "id": 1,
          "title": "Overview",
          "visibility": true,
          "layerDefinition": {
            "drawingInfo": {
              "renderer": {
                "type": "simple",
                "symbol": {
                  "type": "MeshSymbol3D",
                  "symbolLayers": [
                    {
                      "material": {
                        "color": [
                          192,
                          192,
                          255
                        ]
                      },
                      "type": "Fill"
                    }
                  ]
                }
              }
            }
          }
        },
        {
          "id": 3,
          "title": "Walls",
          "visibility": false
        }
      ]
    }
  ]
}
```

