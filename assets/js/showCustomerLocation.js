function mylocation(){
		$(document).ready(function(){

			var options = {
				enableHighAccuracy: true,
				maximumAge: 1000,
				timeout: 45000
			};
			if (window.navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(successCallback,
				errorCallback, options);
			} else {
				alert('Your browser does not natively support geolocation.');
			}
			function successCallback(position) {
				var lati = position.coords.latitude;
				var long = position.coords.longitude;
				var accuracy = position.coords.accuracy;
				var	alti = null;
				var alti_accy = null;
				if (position.coords.altitude) {
					alti = position.coords.altitude;
				}
				if (position.coords.altitudeAccuracy) {
					alti_accy = position.coords.altitudeAccuracy ;
				}

				require([
					"esri/tasks/Locator",
				  	"esri/Map",
				  	"esri/views/MapView",
				  	"esri/geometry/Point",
				  	"esri/layers/TileLayer",
				  	"esri/symbols/SimpleMarkerSymbol",
				  	"esri/Graphic"
				], 
				function(Locator, Map, MapView, Point, TileLayer, SimpleMarkerSymbol, Graphic) {
					var point = {
					  type: "point",  // autocasts as new Point()
					  longitude: long,
					  latitude: lati
					};
					var point1 = new Point(long, lati);

					var locatorTask = new Locator({
				       url: "https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer"
				    });
					
					var transportationLayer = new TileLayer({
				    	url: "https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Transportation/MapServer",
				    	id: "streets",
		  				opacity: 0.7
				    });

					var map = new Map({
						basemap: "streets",
						layers: [transportationLayer]  // layers can be added as an array to the map's constructor
					});

					var view = new MapView({
						container: "map",  // Reference to the DOM node that will contain the view
						map: map,               // References the map object created in step 3
						zoom: 15,  // Sets zoom level based on level of detail (LOD)
						center: [long, lati]  // Sets center point of view using longitude,latitude
					});	
					
					var graphic1 = new Graphic({
						    geometry: point,
						    symbol: {
						    type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
						    color: "blue",
						    size: 8,
						    outline: { // autocasts as new SimpleLineSymbol()
						    width: 0.5,
					        color: "darkblue"
					      }
					    }
					});
					view.graphics.add(graphic1);
					view.popup.autoOpenEnabled = false;
					view.popup.open({
					 	title: "Reverse geocode: [" + long + ", " + lati + "]",
					   location: point // Set the location of the popup to the clicked location
					});
					locatorTask.locationToAddress(point1).then(function(response) {
					  // If an address is successfully found, show it in the popup's content
					  view.popup.content = response.address;
					  $("#pos_name").val(response.address);
					  $("#lati").val(lati);
					  $("#longi").val(long);
					  $("#accuracy").val(accuracy);
					  $("#alti").val(alti);
					  $("#alti_accy").val(alti_accy);
					  //$("#newLocRow").css("display", "block");
					  $("#posCount").text(" 1 ");
					  $("#posName").text(response.address);
					  $("#latiName").text(lati);
					  $("#longiName").text(long);
					  $("#accyName").text(accuracy);
					}).catch(function(error) {
					  // If the promise fails and no result is found, show a generic message
					  view.popup.content = "No address was found for this location";
					});

					view.popup.autoOpenEnabled = false;
					view.on("click", function(event) {
						// Get the coordinates of the click on the view
						// around the decimals to 3 decimals
						var lat = Math.round(event.mapPoint.latitude * 1000) / 1000;
						var lon = Math.round(event.mapPoint.longitude * 1000) / 1000;

						view.popup.open({
						    // Set the popup's title to the coordinates of the clicked location
						    title: "Reverse geocode: [" + lon + ", " + lat + "]",
						    location: event.mapPoint // Set the location of the popup to the clicked location
						});
						// Execute a reverse geocode using the clicked location
						locatorTask.locationToAddress(event.mapPoint).then(function(response) {
							view.graphics.removeAll();
							view.popup.content = response.address;
							var graphic3 = new Graphic({
							    geometry: event.mapPoint,
							    symbol: {
							    type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
							    color: "blue",
							    size: 8,
							    outline: { // autocasts as new SimpleLineSymbol()
							    width: 0.5,
							        color: "darkblue"
							      }
							    }
							});
							view.graphics.add(graphic3);


							$("#pos_name").val(response.address);
							$("#lati").val(event.mapPoint.latitude);
							$("#longi").val(event.mapPoint.longitude);
							
							//$("#newLocRow").css("display", "block");
							$("#posCount").text(" 1 ");
							$("#posName").text(response.address);
							$("#latiName").text(event.mapPoint.latitude);
							$("#longiName").text(event.mapPoint.longitude);
						}).catch(function(error) {
							// If the promise fails and no result is found, show a generic message
							view.popup.content = "No address was found for this location";
						});
					});
				
				});
			}
			function errorCallback(error) {
				alert("There was a problem getting the location");
			}

		});	
	}