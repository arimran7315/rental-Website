<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
{{-- trumbowyg Text Editor --}}
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" >

    {{-- Custom Css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- MapLibre GL JS Styles -->
    <link href="https://unpkg.com/maplibre-gl/dist/maplibre-gl.css" rel="stylesheet" />
    <!-- MapLibre GL JS Script -->
    <script src="https://unpkg.com/maplibre-gl/dist/maplibre-gl.js"></script>
    <title>Rental Website</title>
</head>

<body>
    <header class="bg-light">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ route('home') }}">Rental <span>Website</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('landPage') }}">Lands</a>
                        </li>
                       @can('isBuyer')
                       <li>
                        <a  href="{{ route('applied-land') }}" class="btn btn-secondary small">Applied Lands</a>
                    </li>
                       @endcan
                        @if (Auth::check())
                        <li class="nav-item">
                            <a class="btn btn-primary small  ms-2" aria-current="page" href="{{ route('logout.function') }}">Logout</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="btn btn-primary small  ms-2" aria-current="page" href="{{ route('loginPage') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary small ms-2" aria-current="page" href="{{ route('registerPage') }}">Register</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    @hasSection('hero')
        @yield('hero')
    @endif
    <div class="main py-5">
        @hasSection('content')
            @yield('content')
        @else
            Add Content Here
        @endif
    </div>
    <footer class="bg-dark py-3 bg-2">
        <div class="container">
            <p class="text-center text-white pt-3 fw-bold fs-6">© 2023 LogicBlaze, all right reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- trumbowyg Text Editor --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>


    <script>
        $('.textarea').trumbowyg();
    </script>
     <script>
          const geoapifyApiKey = "32f802c7659e4a698e3ecad6f69785c2";
        $(document).ready(function() {
            const address = $('#address').text();
            // Geocode the address
            fetch(
                    `https://api.geoapify.com/v1/geocode/search?text=${encodeURIComponent(address)}&apiKey=${geoapifyApiKey}`)
                .then(response => response.json())
                .then(result => {
                    if (result.features.length > 0) {
                        // Get the first result's coordinates
                        const {
                            lat,
                            lon
                        } = result.features[0].properties;

                        // Initialize the map
                        const map = new maplibregl.Map({
                            container: "map",
                            style: `https://maps.geoapify.com/v1/styles/osm-carto/style.json?apiKey=${geoapifyApiKey}`,
                            center: [lon, lat], // Longitude, Latitude
                            zoom: 12,
                        });

                        // Add a marker at the geocoded location
                        new maplibregl.Marker().setLngLat([lon, lat]).addTo(map);
                    } 
                })
                .catch(error => {
                    console.error("Error fetching geocoding data:", error);
                });
        });
    </script>
</body>

</html>
