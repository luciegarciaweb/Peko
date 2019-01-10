var mapPeko = L.map('map-peko').setView([43.704848, 3.327476], 15);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: mapbox_api
}).addTo(mapPeko);
var marker = L.marker([43.704848, 3.327476]).addTo(mapPeko);
marker.bindPopup("<b>A la source de Peko</b>").openPopup();