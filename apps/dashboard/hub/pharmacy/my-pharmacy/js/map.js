var divMaps = "<? php echo json_encode($arrayMapDiv); ?>";

var arrayLat = "<? php echo json_encode($arrayLat); ?>";
var arrayLng = "<? php echo json_encode($arrayLng); ?>";

var arrayPharmacyName = "<? php echo json_encode($arrayPharmacyName); ?>";
var arrayPharmacyType = "<? php echo json_encode($arrayPharmacyType); ?>";

function myMap() {

    for (var i = 0; i < divMaps.length; i++) {

        var mapProp = {
            center: new google.maps.LatLng(arrayLat[i], arrayLng[i]),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        };
        var map = new google.maps.Map(document.getElementById(divMaps[i]), mapProp);

        new google.maps.Marker({
            position: new google.maps.LatLng(arrayLat[i], arrayLng[i]),
            map: map,
            title: arrayPharmacyName[i] + ' ' + arrayPharmacyType[i],
        });

    }

}