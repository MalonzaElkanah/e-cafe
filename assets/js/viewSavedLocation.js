function savedlocation(latitude, longitude){
	
	require([
      	"esri/Map",
      	"esri/views/MapView", 
      	"esri/tasks/Locator",     
      	"esri/Graphic",
      	"esri/geometry/Point"
      	], function(Map, MapView, Locator, Graphic, Point) {

      	var map = new Map({
        	basemap: "streets-navigation-vector"
      	});
      
      	var view = new MapView({
        	container: "map",
        	map: map,
        	center: [longitude,latitude],
        	zoom: 15
      	});
      	var point = {
			type: "point",
			longitude: longitude,
			latitude: latitude
		};
		var point1 = new Point(longitude, latitude);
		var locatorTask = new Locator({
	       url: "https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer"
	    });
		view.graphics.removeAll();
		addGraphic(point);
		
		function addGraphic(point) {
        	var graphic = new Graphic({
          		symbol: {
            		type: "simple-marker",
            		color: "blue",
            		size: "12px"
          		},
          		geometry: point
        	});
        	view.graphics.add(graphic);
        	view.popup.autoOpenEnabled = false;
			view.popup.open({
			 	title: "Reverse geocode: [" + longitude + ", " + latitude + "]",
			   location: point
			});
			locatorTask.locationToAddress(point1).then(function(response) {
				view.popup.content = response.address;
			}).catch(function(error) {
			  view.popup.content = "No address was found for this location";
			});
      	}
    });
}