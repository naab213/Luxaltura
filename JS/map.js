document.addEventListener('DOMContentLoaded', function (){
    var mapElement = document.getElementById('map');
    if (!mapElement) return;

    var map = L.map('map').setView([51.505, -0.09], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markers = [
        { lat: 28.0339, lon: 3.06, popup: "Algeria" },
        { lat: -14.235, lon: -51.9253, popup: "Brasil" },
        { lat: 56.1304, lon: -106.3468, popup: "Canada" },
        { lat: 35.6762, lon: 139.6503, popup: "Japan" },
        { lat: 31.634, lon: -7.999, popup: "Morocco" },
        { lat: 21.4735, lon: 55.9232, popup: "Oman" },
        { lat: 60.472, lon: 8.4689, popup: "Norway" },
        { lat: 31.9454, lon: 35.2345, popup: "Palestine" },
        { lat: 48.8566, lon: 2.3522, popup: "Paris" },
        { lat: -9.19, lon: -75.0152, popup: "Peru" },
        { lat: 40.4168, lon: -3.7038, popup: "Spain" }
    ];

    markers.forEach(function(marker){
        var leafletMarker = L.marker([marker.lat, marker.lon])
            .addTo(map)
            .bindPopup(marker.popup);
            
        leafletMarker.bindTooltip(marker.popup, { permanent: false, sticky: true });
    });
});
