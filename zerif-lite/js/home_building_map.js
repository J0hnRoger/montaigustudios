/**
 *  Create a Map with all Buildings and Informations
 *  dependencies : http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/
 */
var MStudioMaps = (function(mapId){
    var map;
    var markers = [];

    function _initialize(mapId, lat, lng) {
        map = new google.maps.Map(document.getElementById(mapId), {
            zoom: 15,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    }

    function _addMarker (lat, long, title){
        var myLatlng = new google.maps.LatLng(lat, long);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: title
        });
        markers.push(marker);
        addBasicsInfosWindow(marker, title);
    }

    function _addMarkerWithLabel (lat, long, title, permalink, thumb, freeAppartment){
        var myLatlng = new google.maps.LatLng(lat, long);
        var marker = new MarkerWithLabel({
            position: myLatlng,
            draggable: false,
            raiseOnDrag: false,
            icon: ' ',
            map: map,
            labelContent: '<i class="fa fa-building fa-2x"></i>'
        });
        addBuildingInfosWindow(marker, title, permalink, thumb, freeAppartment);
    }

    function addBasicsInfosWindow (marker, title){

        var infowindow = new google.maps.InfoWindow({
            content: title
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }

    function addBuildingInfosWindow(marker, title, permalink, thumb, freeAppartment){
        var contentString =
            '<div> ' +
            '<span class="label label-success free-building-badge">' + freeAppartment + '</span>' +
            '<a href="'+ permalink +'">' +
                    '<h6>' + title + '</h6>'+
                    thumb +
                '</a>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }

    return {
        init : _initialize,
        addMarker : _addMarker,
        addMarkerWithLabel : _addMarkerWithLabel
    }
})();

