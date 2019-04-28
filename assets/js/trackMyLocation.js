function mylocation(){

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
        var alti = null;
        var alti_accy = null;
        if (position.coords.altitude) {
            alti = position.coords.altitude;
        }
        if (position.coords.altitudeAccuracy) {
            alti_accy = position.coords.altitudeAccuracy ;
        }

        require([
        "esri/Map",
        "esri/views/MapView",
        "esri/widgets/Locate",
        "esri/widgets/Track",
        "esri/Graphic",
        "esri/widgets/Compass",
        "dojo/domReady!"
        ], function(Map, MapView, Locate, Track, Graphic, Compass) {

            var map = new Map({
                basemap: "satellite" // //streets-navigation-vector
            });

            var view = new MapView({
                container: "viewDiv",
                map: map,
                zoom: 17,  
                center: [long, lati]  
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
        });
    }
    function errorCallback(error) {
        alert("There was a problem getting the location");
    }
}

mylocation();
