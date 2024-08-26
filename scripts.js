
/// MAPS
let map, geocoder, AdvancedMarkerElement, Polygon;
let markers = [];
let polygons = [];

async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");
    const { Geocoder } = await google.maps.importLibrary("geocoding");
    const { AdvancedMarkerElement: MarkerElement } = await google.maps.importLibrary("marker");
    const { Polygon: GPolygon } = await google.maps.importLibrary("maps");
    geocoder = new Geocoder();
    AdvancedMarkerElement = MarkerElement;
    Polygon = GPolygon;

    map = new Map(document.getElementById("map"), {
        zoom: 10,
        center: { lat: -34.6037, lng: -58.3816 }, 
        mapId: '2bec6f32c4741acc'
    });

    buscarLocalidad("Palermo, Cuidad Autonoma de Buenos Aires");
}

function limpiarMapa() {
    markers.forEach(marker => marker.map = null);
    markers = []; 

    polygons.forEach(polygon => polygon.setMap(null));
    polygons = []; 
}


function buscarLocalidad(address) {
    limpiarMapa();

    geocoder.geocode({ 'address': address, 'region': 'AR' }, function(results, status) {
        if (status === 'OK') {
            map.setZoom(14);
            map.setCenter(results[0].geometry.location);

            const marker = new AdvancedMarkerElement({
                map: map,
                position: results[0].geometry.location,
                title: results[0].formatted_address
            });
            markers.push(marker);

            const bounds = results[0].geometry.bounds || results[0].geometry.viewport;

            if (bounds) {
                const polygonCoords = [
                    { lat: bounds.getNorthEast().lat(), lng: bounds.getNorthEast().lng() },  
                    { lat: bounds.getSouthWest().lat(), lng: bounds.getNorthEast().lng() }, 
                    { lat: bounds.getSouthWest().lat(), lng: bounds.getSouthWest().lng() }, 
                    { lat: bounds.getNorthEast().lat(), lng: bounds.getSouthWest().lng() } 
                ];

                const polygon = new Polygon({
                    paths: polygonCoords,
                    map: map,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.1
                });
                polygons.push(polygon); 
            } else {
                console.log('Bounds no disponibles para esta ubicación.');
            }

        } else if (status === 'ZERO_RESULTS') {
            console.error('Geocoding fallido: No se encontraron resultados para ' + address);
        } else {
            console.error('Geocoding fallido: ' + status);
        }
    });
}


// LOCALIDADES
let localidades = [
    { cp: "1425", localidad: "Palermo", provincia: "Buenos Aires" },
    { cp: "1406", localidad: "Caballito", provincia: "Buenos Aires" },
    { cp: "1602", localidad: "Florida", provincia: "Buenos Aires" },
    { cp: "1642", localidad: "San Isidro", provincia: "Buenos Aires" },
    { cp: "1708", localidad: "Morón", provincia: "Buenos Aires" },
    { cp: "1870", localidad: "Avellaneda", provincia: "Buenos Aires" }
];


function agregarLocalidades(){
   const ul = document.getElementById('resultados');
   ul.innerHTML = '';

   localidades.forEach((localidad, index) => {

    const li = document.createElement('li');
    li.textContent = `${localidad.localidad} (CP: ${localidad.cp}) - ${localidad.provincia}`;
    li.className = `bg-gray-${index % 2 === 0 ? '200' : '100'} p-1`;
    li.addEventListener('click', () => buscarLocalidad(`${localidad.localidad}, ${localidad.provincia} ${localidad.cp}`));

    ul.appendChild(li);
  });
}

function consultarParametro(){
var parametro = document.getElementById('inputParametro').value;

    if (parametro === '') {
        showModal('El campo de búsqueda está vacío. Intente de nuevo');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'localidades.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

                localidades  = [];
                var response = JSON.parse(xhr.responseText);


                if (response.length > 0 && response[0].hasOwnProperty('localidad')) {
                    localidades = response; 
                    agregarLocalidades();
                }else{
                let mensajeError = response.error??'No se encontró el campo localidad en la respuesta.';
                showModal(mensajeError);
            }


            }
        };
xhr.send('search_param=' + encodeURIComponent(parametro));
}


function showModal(message) {
    const modalOverlay = document.createElement('div');
    modalOverlay.className = 'fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50';

    const modalContent = document.createElement('div');
    modalContent.className = 'bg-white p-6 rounded-lg shadow-lg z-60 focus:outline-none';
    modalContent.setAttribute('tabindex', '-1'); 
    modalContent.innerHTML = `
        <h2 class="text-lg font-semibold mb-4">Error</h2>
        <p>${message}</p>
        <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
    `;

    modalOverlay.appendChild(modalContent);
    document.body.appendChild(modalOverlay);
    document.body.style.overflow = 'hidden';
    modalContent.focus();

    document.getElementById('closeModal').addEventListener('click', function() {
        document.body.removeChild(modalOverlay);
        document.body.style.overflow = ''; 
    });
}



document.getElementById("buscarBtn").addEventListener("click", function() {
    consultarParametro();
});

document.getElementById('inputParametro').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        consultarParametro();
    }
});

initMap();
agregarLocalidades();