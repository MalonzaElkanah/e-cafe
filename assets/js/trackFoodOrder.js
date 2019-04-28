function showrouteAndDirection(){
	require([
		"esri/Map",
		"esri/views/MapView",      
		"esri/Graphic",
		"esri/tasks/RouteTask",
		"esri/tasks/support/RouteParameters",
		"esri/tasks/support/FeatureSet",
	  	"esri/widgets/Locate",
    	"esri/widgets/Track",
    	"esri/widgets/Compass"
    ], function(Map, MapView, Graphic, RouteTask, RouteParameters, FeatureSet, Locate, Track, Compass) {

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
		        getFoodLocation();
				$("#currentTab").css("display", "none");
			}
			if (radioChkd==0) {alert("No SChedule Delivery Checked!!");}
		});
		$(function(){
			setInterval(function(){
				if ($("#trackCurrentPos").is(':checked')) {
					getFoodLocation();
				}	
			}, 30000);
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
        	});
      	}
      	
		function getFoodLocation(){
			var loc_id = $("input[name='current_del']:checked").attr("value");
			var d_pos_id = $("#d_pos_cd"+loc_id).attr("value");
			var d_la_point;
			var d_lo_point;
      		$.post("index.php",
		    {
		        del_lati_pos: d_pos_id
		    },
		    function(data, status){
		    	d_la_point = data;
		    	$.post("index.php",
			    {
			        del_longi_pos: d_pos_id
			    },
			    function(data, status){
			    	view.graphics.remove(graphic1);
			    	d_lo_point = data;
			    	var d_point = {
						type: "point",
						longitude: d_lo_point,
						latitude: d_la_point
					};
					var graphic1 = new Graphic({
					  	symbol: {
						    type: "simple-marker",
						    color: "blue",
						    size: "10px"
						},
					  	geometry: d_point
					});
					view.graphics.add(graphic1);
			        view.center = [d_lo_point, d_la_point]; 
					view.zoom = 13;
			    });
		    });
		}
    });
}
