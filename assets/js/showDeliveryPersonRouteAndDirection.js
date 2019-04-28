function showrouteAndDirection(){
	require([
		"esri/Map",
		"esri/views/MapView",      
		"esri/Graphic",
		"esri/tasks/RouteTask",
		"esri/tasks/support/RouteParameters",
		"esri/tasks/support/FeatureSet",
		"esri/widgets/Directions",
	  	"esri/widgets/Locate",
    	"esri/widgets/Track",
    	"esri/widgets/Compass"
    ], function(Map, MapView, Graphic, RouteTask, RouteParameters, FeatureSet, Directions, Locate, Track, Compass) {

		var map = new Map({
			basemap: "streets-navigation-vector"
		});

		var view = new MapView({
			container: "map",
			map: map
		});

		// To allow access to the route service and prevent the user from signing in, do the Challenge step in the lab to set up a service proxy

		var routeTask = new RouteTask({
			url: "https://utility.arcgis.com/usrsvcs/appservices/MK3m61zErlAUaLkf/rest/services/World/Route/NAServer/Route_World/solve"
		});
		var locate = new Locate({
            view: view,
            useHeadingEnabled: false,
            goToOverride: function(view, options) {
                options.target.scale = 1500;
                return view.goTo(options.target);
            }
        });
        view.ui.add(locate, "top-left");
        
        var track = new Track({
            view: view,
            graphic: new Graphic({
            symbol: {
                type: "simple-marker",
                size: "9px",
                color: "green",
                outline: {
                    color: "#efefef",
                    width: "1.2px"
                }
            }
            }),
            useHeadingEnabled: false,
            goToLocationEnabed: false,
            goToOverride: function(view, options) {
                options.target.scale = null;
                return view.goTo(options);
            }
        });
        view.ui.add(track, "top-left");

        var compass = new Compass({
            view: view
        });

        // adds the compass to the top left corner of the MapView
        view.ui.add(compass, "top-left");

        view.when(function() {
          // track.start();
          // view.zoom = 12;
        });
    
		$("#currentPos").click(function(){
			if ($("#currentPos").is(':checked')) {
				myLocation();
			}else{
				alert("un-checked");
			}
		});
		$("#applyScheduleButton").click(function(event){
			event.preventDefault();
			var	radioChkd =0;
			if ($("input[name='scheduled_del']:checked").length>0) {
				radioChkd=radioChkd+1;
				var loc_id = $("input[name='scheduled_del']:checked").attr("value");
				var c_la_point = $("#c_lati"+loc_id).attr("value");
				var c_lo_point = $("#c_longi"+loc_id).attr("value");
				var r_la_point = $("#r_lati"+loc_id).attr("value");
				var r_lo_point = $("#r_longi"+loc_id).attr("value");
				var r_point = {
					type: "point", // autocasts as new Point()
					longitude: r_lo_point,
					latitude: r_la_point
				};
				var c_point = {
					type: "point",
					longitude: c_lo_point,
					latitude: c_la_point
				};
				view.graphics.removeAll();
				addGraphic("start", r_point);
		        addGraphic("finish", c_point);
		        getRoute();
		        view.center = [r_lo_point, r_la_point];  // Sets the center point of the view at a specified lon/lat
				view.zoom = 13;
				//$("#currentTab").css("display", "none");
	  			$("#scheduleTab").css("display", "none");
			}
			if (radioChkd==0) {alert("No SChedule Delivery Checked!!");}
		});
		$("#applyCurrentButton").click(function(event){
			event.preventDefault();
			var	radioChkd =0;
			if ($("input[name='current_del']:checked").length>0) {
				radioChkd=radioChkd+1;
				var loc_id = $("input[name='current_del']:checked").attr("value");
				var c_la_point = $("#c_lati_cd"+loc_id).attr("value");
				var c_lo_point = $("#c_longi_cd"+loc_id).attr("value");
				var r_la_point = $("#r_lati_cd"+loc_id).attr("value");
				var r_lo_point = $("#r_longi_cd"+loc_id).attr("value");
				var r_point = {
					type: "point", // autocasts as new Point()
					longitude: r_lo_point,
					latitude: r_la_point
				};
				var c_point = {
					type: "point",
					longitude: c_lo_point,
					latitude: c_la_point
				};
				view.graphics.removeAll();
				addGraphic("start", r_point);
		        addGraphic("finish", c_point);
		        getRoute();
		        view.center = [r_lo_point, r_la_point];  // Sets the center point of the view at a specified lon/lat
				view.zoom = 13;
				$("#currentTab").css("display", "none");
	  				//$("#scheduleTab").css("display", "block");
			}
			if (radioChkd==0) {alert("No SChedule Delivery Checked!!");}
		});

		function addGraphic(type, point) {
		var graphic = new Graphic({
		  symbol: {
		    type: "simple-marker",
		    color: (type === "start") ? "white" : "black",
		    size: "8px"
		  },
		  geometry: point
		});
		view.graphics.add(graphic);
		}
    
		function getRoute() {
	        // Setup the route parameters
	        var routeParams = new RouteParameters({
	          stops: new FeatureSet({
	            features: view.graphics
	          }),
	          directionsLengthUnits: "kilometers",
	          returnDirections: true
	        });
	        // Get the route
	        routeTask.solve(routeParams).then(function(data) {
	          data.routeResults.forEach(function(result) {
	            result.route.symbol = {
	              type: "simple-line",
	              color: [5, 150, 255],
	              width: 3
	            };
	            view.graphics.add(result.route); 
	          });
	           //*** ADD ***//

	          // Display the directions
	          var directions = document.createElement("ol");
	          directions.classList = "esri-widget esri-widget--panel esri-directions__scroller";
	          directions.style.marginTop = 0;
	          directions.style.paddingTop = "15px";

	          // Show the directions
	          var features = data.routeResults[0].directions.features;
	          features.forEach(function(result,i){
	            var direction = document.createElement("li");
	            direction.innerHTML = result.attributes.text + " (" + result.attributes.length.toFixed(2) + " kilometers)";
	            directions.appendChild(direction);
	          });
	          // Add directions to the view
	          view.ui.empty("top-right");
	          view.ui.add(directions, "top-right");
        	});
      	}
      	function myLocation(){
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
				view.center = [long, lati];  // Sets the center point of the view at a specified lon/lat
				view.zoom = 13;  // Sets the zoom LOD to 13
			}
			function errorCallback(error) {
				alert("There was a problem getting the location");
			}
		}
    });
}
/*
view.on("click", function(event){
	if (view.graphics.length === 0) {
		addGraphic("start", event.mapPoint);
	} else if (view.graphics.length === 1) {
		addGraphic("finish", event.mapPoint);
		// Call the route service
		getRoute();
	} else {
		view.graphics.removeAll();
		addGraphic("start",event.mapPoint);
	}
});
*/