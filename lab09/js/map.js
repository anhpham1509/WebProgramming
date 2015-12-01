var map;
var marker;
var infoWindows;

var initPos = {lat: 60.222, lng: 24.805};
var carPos = {lat: 60.2215, lng: 24.8078};

var mapOptions = {
    center: initPos,
    zoom: 15
};

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
}

function showMarker() {
    var icon = {
        url: 'img/car-icon.png',
        scaledSize: new google.maps.Size(55, 30)
    };

    marker = new google.maps.Marker({
        position: carPos,
        map: map,
        icon: icon,
        title: 'Sukky Cars Ltd'
    });

    marker.setMap(map);
    map.setCenter(marker.getPosition());
}

function openInfoWindows() {
    var contentString = '<b>Sukky Cars Ltd</b>' +
        '<p>We are selling a lot of old and used cars.<br>' +
        'We make our best effort that you are happy with your car.</p>' +
        '<p>Address: Vanha maantie 6 - 02650 Espoo - Finland</p>' +
        '<p>Tel: Mr. Huttunen 030-12334567</p>';
    infoWindows = new google.maps.InfoWindow({
        content: contentString
    });
    infoWindows.open(map, marker);
}