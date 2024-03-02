<?php echo view('layouts/header'); ?>

<body>
    <style>
        .star-wrapper {
            transform: translate(-50%, -50%);
            position: absolute;
            direction: rtl;
        }

        .star-wrapper a {
            font-size: 4em;
            color: #fff;
            text-decoration: none;
            transition: all 0.5s;
            margin: 4px;
        }

        .star-wrapper a:hover {
            color: gold;
            transform: scale(1.3);
        }

        .s1:hover~a {
            color: gold;
        }

        .s2:hover~a {
            color: gold;
        }

        .s3:hover~a {
            color: gold;
        }

        .s4:hover~a {
            color: gold;
        }

        .s5:hover~a {
            color: gold;
        }

        .wraper {
            position: absolute;
            bottom: 30px;
            right: 50px;
        }
    </style>
    <div class="p-5">
        <div class="row">
            <div class="my-4">
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 64px;">Always the ride you want
                </h5>
                <p class="card-text mt-3">Reserve a ride, hop in, and go.</p>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="card mt-3">
                    <div class="card-body p-4">
                        <div id="loading_div" class="d-flex justify-content-center">
                            <div id="loading_spin" class="spinner-grow p-4 text-info" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div id="map_div" style="display: none;">
                            <div class="my-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Pick Up Location</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control text-dark fw-bold" id="pick_location" name="pick_location" placeholder="Search">
                                        <button class="btn btn-outline-secondary" type="button" id="locate-me"><i class="bi bi-geo-alt-fill"></i></button>
                                    </div>
                                    <input type="hidden" id="pick_lat">
                                    <input type="hidden" id="pick_long">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Drop Off Location</label>
                                    <input id="drop_location" name="drop_location" type="text" class="form-control text-dark fw-bold" placeholder="Search">
                                    <input type="hidden" id="drop_lat">
                                    <input type="hidden" id="drop_long">
                                </div>
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">Distance</span>
                                    <span id="distance">---</span>
                                    <span class="fw-bold text-dark mt-3">Average Price</span>
                                    <span id="price">---</span>
                                </div>
                            </div>
                            <div id="map" class="rounded" style="height: 400px; width: 100%;"></div>
                            <div class="float-end">
                                <button class="btn btn-primary mt-3 srch">See Available Drivers & Prices</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 d-flex justify-content-center">
                <img src="/images/ride.webp" alt="Rating Img" width="50%" class="">
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>
    <script type="module">
        // // Initialize and add the map
        // let map;


        // async function initMap() {
        //     // Request needed libraries.
        //     //@ts-ignore
        //     const {
        //         Map
        //     } = await google.maps.importLibrary("maps");
        //     const {
        //         AdvancedMarkerElement
        //     } = await google.maps.importLibrary("marker");

        //     // Try to get the user's current location
        //     navigator.geolocation.getCurrentPosition(
        //         (position) => {
        //             // The location of the user
        //             const userPosition = {
        //                 lat: position.coords.latitude,
        //                 lng: position.coords.longitude,
        //             };

        //             getAddressFromLatLng(userPosition.lat, userPosition.lng);
        //             console.log("User's location: ", userPosition);

        //             // The map, centered at the user's location
        //             map = new Map(document.getElementById("map"), {
        //                 zoom: 14,
        //                 center: userPosition,
        //                 mapId: "DEMO_MAP_ID",
        //             });

        //             // The marker, positioned at the user's location
        //             const marker = new AdvancedMarkerElement({
        //                 map: map,
        //                 position: userPosition,
        //                 title: "Your Location",
        //             });
        //         },
        //         () => {
        //             // Handle errors or default to a specific location
        //             console.error(
        //                 "Error getting user location. Defaulting to Kurunegala, Sri Lanka."
        //             );

        //             // The location of Kurunegala, Sri Lanka
        //             const defaultPosition = {
        //                 lat: 7.4712,
        //                 lng: 80.3548
        //             };

        //             // The map, centered at Kurunegala, Sri Lanka
        //             map = new Map(document.getElementById("map"), {
        //                 zoom: 14,
        //                 center: defaultPosition,
        //                 mapId: "DEMO_MAP_ID",
        //             });

        //             // The marker, positioned at Kurunegala, Sri Lanka
        //             const marker = new AdvancedMarkerElement({
        //                 map: map,
        //                 position: defaultPosition,
        //                 title: "Kurunegala, Sri Lanka",
        //             });
        //         }
        //     );
        // }



        // Set up Places Autocomplete for the locationInput field
        // const locationInput = document.getElementById("locationInput");
        // const autocomplete = new google.maps.places.Autocomplete(locationInput);
        // autocomplete.bindTo("bounds", map);

        // // Optionally, you can add an event listener to handle the Enter key
        // locationInput.addEventListener("keydown", (event) => {
        //     if (event.key === "Enter") {
        //         event.preventDefault();
        //         searchLocation();
        //     }
        // });

        // initMap();

        // function getAddressFromLatLng(lat, lng) {
        //     const geocoder = new google.maps.Geocoder();

        //     const latlng = {
        //         lat: parseFloat(lat),
        //         lng: parseFloat(lng)
        //     };

        //     geocoder.geocode({
        //         location: latlng
        //     }, (results, status) => {
        //         if (status === "OK") {
        //             if (results) {
        //                 const address = results[0].formatted_address;
        //                 console.log("Address:", address);

        //                 // You can use the obtained address in your application as needed
        //             } else {
        //                 console.error("No results found");
        //             }
        //         } else {
        //             console.error("Geocoder failed due to:", status);
        //         }
        //     });
        // }

        // // Function to search for a location using Places Autocomplete
        // function searchLocation() {
        //     console.log("Searching for location...");
        //     const locationInput = document.getElementById("locationInput");
        //     const locationName = locationInput.value;

        //     if (locationName.trim() === "") {
        //         alert("Please enter a location name");
        //         return;
        //     }

        //     const geocoder = new google.maps.Geocoder();

        //     // Use Places Autocomplete to get location details
        //     const placesService = new google.maps.places.PlacesService(map);

        //     placesService.findPlaceFromQuery({
        //             query: locationName,
        //             fields: ["geometry"]
        //         },
        //         (results, status) => {
        //             if (status === "OK" && results && results.length > 0) {
        //                 const location = results[0].geometry.location;
        //                 map.setCenter(location);

        //                 // Optionally, you can add a marker for the searched location
        //                 const marker = new google.maps.Marker({
        //                     map: map,
        //                     position: location,
        //                     title: locationName,
        //                 });
        //             } else {
        //                 alert("Location not found. Please enter a valid location name.");
        //             }
        //         }
        //     );
        // }
    </script>
    <script>
        function getAddressFromLatLng(lat, lng, elementId) {
            const geocoder = new google.maps.Geocoder();

            const latlng = {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            };

            geocoder.geocode({
                location: latlng
            }, (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        const address = results[0].formatted_address;
                        console.log("Address:", address);

                        document.getElementById(elementId).value = address;
                        // You can use the obtained address in your application as needed
                    } else {
                        console.error("No results found");
                    }
                } else {
                    console.error("Geocoder failed due to:", status);
                }
            });
        }

        function calculateDistanceAndRoute(pickupLat, pickupLng, dropoffLat, dropoffLng) {
            const origin = new google.maps.LatLng(pickupLat, pickupLng);
            const destination = new google.maps.LatLng(dropoffLat, dropoffLng);
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();

            const mapProp = {
                center: origin,
                zoom: 14,
            };
            const map = new google.maps.Map(document.getElementById("map"), mapProp);
            directionsRenderer.setMap(map);

            const request = {
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, (response, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);

                    // Display the distance
                    const distance = response.routes[0].legs[0].distance.text;
                    console.log('Distance:', distance);
                    // distance is like 36.5 KM
                    // check if distance greater than 0
                    if (parseFloat(distance.split(' ')[0]) > 0) {
                        // calculate the price
                        document.getElementById('distance').innerText = distance;
                        // calculate price;
                        // LKR 100 for each in first 5 KMs
                        // LKR 80 for each in next 5 KMs
                        // LKR 60 for each KM after that
                        let price = 0;
                        const distanceInKMs = parseFloat(distance.split(' ')[0]);
                        if (distanceInKMs <= 5) {
                            price = distanceInKMs * 100;
                        } else if (distanceInKMs <= 10) {
                            price = (5 * 100) + ((distanceInKMs - 5) * 80);
                        } else {
                            price = (5 * 100) + (5 * 80) + ((distanceInKMs - 10) * 60);
                        }
                        document.getElementById('price').innerText = 'LKR ' + price.toFixed(2) + ' + Service Charge';
                    }
                    else{
                        document.getElementById('distance').innerText = '---';
                        document.getElementById('price').innerText = '---';
                    }

                    // Display the route on the map
                    const route = response.routes[0].overview_path;
                    const polyline = new google.maps.Polyline({
                        path: route,
                        geodesic: true,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });
                    polyline.setMap(map);

                    // Display the distance on your page as needed
                    // document.getElementById('distance').innerText = distance;
                } else {
                    console.error('Error:', status);
                }
            });
        }

        async function myMap() {
            document.getElementById('loading_spin').style.display = 'block';
            document.getElementById('map_div').style.display = 'none';

            // Try to get the user's current location
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // The location of the user
                    const userPosition = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    getAddressFromLatLng(userPosition.lat, userPosition.lng, 'pick_location');
                    console.log("User's location: ", userPosition);

                    var mapProp = {
                        center: new google.maps.LatLng(userPosition.lat, userPosition.lng),
                        zoom: 14,
                    };
                    var map = new google.maps.Map(document.getElementById("map"), mapProp);
                    var marker = new google.maps.Marker({
                        position: userPosition
                    });
                    marker.setMap(map);

                    document.getElementById('loading_spin').style.display = 'none';
                    document.getElementById('map_div').style.display = 'block';
                },
                () => {
                    document.getElementById('loading_spin').style.display = 'none';
                    document.getElementById('map_div').style.display = 'block';
                    // Handle errors or default to a specific location
                    console.error("Error getting user location. Defaulting to Kurunegala, Sri Lanka.");
                    // The location of Kurunegala, Sri Lanka
                    const defaultPosition = {
                        lat: 7.4712,
                        lng: 80.3548
                    };

                    var mapProp = {
                        center: new google.maps.LatLng(defaultPosition.lat, defaultPosition.lng),
                        zoom: 5,
                    };
                    var map = new google.maps.Map(document.getElementById("map"), mapProp);
                    var marker = new google.maps.Marker({
                        position: defaultPosition
                    });
                    marker.setMap(map);
                }
            );

            var input = document.getElementById('drop_location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                document.getElementById('drop_lat').value = place.geometry.location.lat();
                document.getElementById('drop_long').value = place.geometry.location.lng();

                const pickupLat = parseFloat(document.getElementById('pick_lat').value);
                const pickupLng = parseFloat(document.getElementById('pick_long').value);
                const dropoffLat = parseFloat(place.geometry.location.lat());
                const dropoffLng = parseFloat(place.geometry.location.lng());

                calculateDistanceAndRoute(pickupLat, pickupLng, dropoffLat, dropoffLng);
            });

            var input2 = document.getElementById('pick_location');
            var autocomplete2 = new google.maps.places.Autocomplete(input2);
            autocomplete2.addListener('place_changed', function() {
                var place2 = autocomplete2.getPlace();
                document.getElementById('pick_lat').value = place2.geometry.location.lat();
                document.getElementById('pick_long').value = place2.geometry.location.lng();
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF6DmICYAwskmjHJVMC_2LzCSnsgnogwg&loading=async&libraries=places&callback=myMap"></script>
</body>

</html>