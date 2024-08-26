<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localidades - Argentina</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        li {
            transition: background-color 0.3s ease;
        }
        li:hover {
            background-color: #d1d5db;
            cursor: pointer;
        }
    </style>


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

        <div class="h-1/5 bg-gray-100 flex items-center justify-center m-auto w-full p-4">
           
        <div class="w-full bg-white p-6 rounded-lg shadow-lg mt-4">
            <div class="flex items-center space-x-2 mb-1">
                <input type="text" id="inputParametro" placeholder="Ingresa búsqueda por Localidad o Código Postal..."
                 class="w-full p-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400">
                <button class="bg-gray-600 w-40 text-white p-1 rounded-md hover:bg-gray-700" id="buscarBtn">Buscar</button>
            </div>

                    <div class="h-20 overflow-y-auto border border-gray-300 rounded-md">
                        <ul id="resultados"></ul>
                </div>
        </div>


        </div>
        <div class="h-4/5 flex items-center justify-center m-auto w-full p-4 m-8">
                <div id="map" class="w-full h-full"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="scripts.js"></script>
   
<script>
</script>

</body>
</html>
