
function deliveryPeoplelocation(c_la, c_lo){	

	var r_latitude = $("#r_lati1").text();
	var r_longitude = $("#r_longi1").text();
	/*var c_loc_id;
	var ifChkd = 0;
	 
	if ($("input[name='deliveryLocation']:checked").length>0) {
		ifChkd=ifChkd+1;
		c_loc_id = $("input[name='deliveryLocation']:checked").attr("value");
	}
	
	var c_latitude = $("#c_lati"+c_loc_id).attr("value");
	var c_longitude = $("#c_longi"+c_loc_id).attr("value");*/
	//alert(" "+c_la+" "+c_lo);
	var init = $("#d_loc_Count").text();
	var d_p_latitude =[];
	var d_p_longitude =[];
	var d_p_id = [];
	var j = [];
	//qnty[i]= Number($(qnty1).text()); 
	for (var i = 1; i <= init; i++) {
		j[i] = i;
		d_p_latitude[i] = $("#d_lati"+i).text(); 
		d_p_longitude[i] = $("#d_longi"+i).text();
		d_p_id[i] = $("#d_p_id"+i).text();
	}

	require([
      	"esri/Map",
      	"esri/views/MapView",      
      	"esri/Graphic",
      	"esri/tasks/RouteTask",
      	"esri/tasks/support/RouteParameters",
      	"esri/tasks/support/FeatureSet"
    	], function(Map, MapView, Graphic, RouteTask, RouteParameters, FeatureSet) {

      	var map = new Map({
        	basemap: "streets-navigation-vector"
      	});
      
      	var view = new MapView({
        	container: "viewDiv",
        	map: map,
        	center: [r_longitude,r_latitude],
        	zoom: 15
      	});
      	var r_point = {
			type: "point", // autocasts as new Point()
			longitude: r_longitude,
			latitude: r_latitude
		};

		var c_point = {
			type: "point",
			longitude: c_lo,
			latitude: c_la
		};
      
      	// To allow access to the route service and prevent the user from signing in, do the Challenge step in the lab to set up a service proxy
      
      	var routeTask = new RouteTask({
        	url: "https://utility.arcgis.com/usrsvcs/appservices/MK3m61zErlAUaLkf/rest/services/World/Route/NAServer/Route_World/solve"
      	});
      	var d_p_point = [];

		for (var i = 1; i <= init; i++) {
			d_p_point[i] = {
				type: "point",
				longitude: d_p_longitude[i],
				latitude: d_p_latitude[i]
			};
		}

		var deliveryDistance = 0;
		var deliveryTime = 0;

		//Delivery Route
		view.graphics.removeAll();
		addGraphic("start", r_point);
        addGraphic("finish", c_point);
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
              	color: [5, 150, 5],
              	width: 3
            };
            view.graphics.add(result.route); 
            deliveryDistance = result.directions.totalLength;
			deliveryTime = result.directions.totalTime;
			//alert("delivery_Distance:- "+deliveryDistance+"...delivery_time:- "+deliveryTime);
			/* delivery people distance calcu**/
			//Delivery People Time Price and Delivery Time
			var funcs = [];
			var d_id; 
			for (var i = 1; i <= init; i++) {
			    funcs[i] = getRoute.bind(this, i);
			}

			for (var j = 1; j <= init; j++) {
			    funcs[j]();                    
			}
          });
        });

        
        deliveryRoute();
		
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
    
	    function getRoute(idd) {
	    	view.graphics.removeAll();
			addGraphic("start", d_p_point[idd]);
			addGraphic("finish", r_point);
	    	var d_id = idd.toString();
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
	            //view.graphics.add(result.route); 
	            var totalDeliveryPrice;
	            var totalDeliveryTime = deliveryTime+result.directions.totalTime;
	            
	            $("#distance"+d_id).text(result.directions.totalLength+" kms");
	            $("#distance"+d_id).attr("value", ""+deliveryDistance);
	            $("#time"+d_id).text(totalDeliveryTime+" min");
	            $("#time"+d_id).attr("value", ""+totalDeliveryTime);
	            var price = $("#km_price"+d_id).attr("value");
	            //price = price*result.directions.totalLength;
	            totalDeliveryPrice = deliveryDistance*price;
	            //alert("dist del"+deliveryDistance+"did"+deliveryTime);
	            $("#t_price"+d_id).text("Ksh "+totalDeliveryPrice);
	            $("#t_price"+d_id).attr("value", ""+totalDeliveryPrice);
	          });
	        });   
		}
		function deliveryRoute(){
			view.graphics.removeAll();
			addGraphic("start", r_point);
	        addGraphic("finish", c_point);
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
	              	color: [5, 150, 5],
	              	width: 3
	            };
	            view.graphics.add(result.route); 
	            deliveryDistance = result.directions.totalLength;
				deliveryTime = result.directions.totalTime;
				//alert("delivery_Distance:- "+deliveryDistance+"...delivery_time:- "+deliveryTime);
	          });
	        });
		} 
		deliveryRoute();
    });
}