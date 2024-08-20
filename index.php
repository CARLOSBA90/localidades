<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Códigos Postales - Argentina</title>


    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


<script>
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "AIzaSyAp9N0ussHMpomEZTECdwpx0j38RKXIoK0",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });
</script>
 
</head>
<body class="bg-gray-100">
    <div class="h-screen flex flex-col">

        <div class="h-2/5 bg-gray-100 flex items-center justify-center m-auto w-full p-4">
           
        <div class="w-full bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center space-x-2 mb-4">
                <input type="text" placeholder="Ingresa búsqueda por Código Postal o Localidad..."
                 class="w-full p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-gray-400">
                <button class="bg-gray-600 text-white p-2 rounded-r-md hover:bg-gray-700">Buscar</button>
            </div>


                    <div class="h-52 overflow-y-auto border border-gray-300 p-4 rounded-md">
                        <ul id="resultados" class="space-y-2">
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 1</li>
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 2</li>
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 3</li>
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 4</li>
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 5</li>
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 3</li>
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 4</li>
                            <li class="p-1 bg-gray-100 rounded-md">Resultado 5</li>
                        </ul>
                </div>
        </div>


        </div>
        <div class="h-3/5 flex items-center justify-center m-auto w-full p-4 m-8">
                <div id="map" class="w-full h-full"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>

    <script>
    let map;

    async function initMap() {
        const { Map, Geocoder, Polygon, LatLngBounds, Rectangle  } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");


            // Inicializar el mapa centrado en un punto por defecto
            map = new Map(document.getElementById("map"), {
                zoom: 10,
                center: { lat: -41.1334722, lng: -71.3102778 },  // Centro aproximado de San Carlos de Bariloche
                mapId: '2bec6f32c4741acc'
            });

            // Buscar San Carlos de Bariloche
            const localidad = "San Carlos de Bariloche, Argentina";
            await buscarLocalidad(localidad,AdvancedMarkerElement, Rectangle) 
    }

    async function buscarLocalidad(localidad, AdvancedMarkerElement, Rectangle) {
            const geocoder = new google.maps.Geocoder();

            geocoder.geocode({ 'address': localidad }, function(results, status) {
                if (status === 'OK') {
                    // Obtener las coordenadas de los extremos de la vista (viewport)
                    const bounds = results[0].geometry.viewport;

                    //console.log(bounds);

                    // Ajustar el mapa para que muestre la localidad dentro del borde
                    map.fitBounds(bounds);

                          // Crear un rectángulo que represente el viewport
                          const cityRectangle = new Rectangle({
                        bounds: bounds,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.2,
                    });

                    cityRectangle.setMap(map);

                    console.log('Localidad encontrada:', results[0].formatted_address);
                    console.log('Noreste:', bounds.getNorthEast().toString());
                    console.log('Suroeste:', bounds.getSouthWest().toString());

                    /*
                    // Añadir un marcador en el centro de la localidad
                    new AdvancedMarkerElement({
                        map: map,
                        position: results[0].geometry.location,
                        title: results[0].formatted_address
                    });

                    console.log('Localidad encontrada:', results[0].formatted_address);
                    console.log('Noreste:', bounds.getNorthEast().toString());
                    console.log('Suroeste:', bounds.getSouthWest().toString());*/

                } else {
                    console.error('Geocoding fallido: ' + status);
                }
            });
        }

        initMap();
    

    </script>


   
<script>
</script>

</body>
</html>
