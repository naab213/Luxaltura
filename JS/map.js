document.addEventListener('DOMContentLoaded', function (){
    var mapElement = document.getElementById('map');
    if (!mapElement) return;

    var map = L.map('map').setView([51.505, -0.09], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    

    markers.forEach(function(marker){
        var leafletMarker = L.marker([marker.lat, marker.lon])
            .addTo(map)
            .bindPopup(marker.popup);
            
        leafletMarker.bindTooltip(marker.popup, { permanent: false, sticky: true });
    });
});
