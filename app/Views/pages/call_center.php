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
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 48px;">Call Center
                </h5>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="">
                            <h5 class="card-title fw-bolder">Customer Registration</h5>
                        </div>
                        <div id="signupForm" class="mb-4">
                            <div class="my-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nic" class="form-label">NIC</label>
                                    <input type="text" class="form-control" id="nic" name="nic" required>
                                </div>
                                <div class="form-check d-none">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Signup as a driver
                                    </label>
                                </div>
                            </div>
                            <!-- <button type="submit" class="btn w-100 mt-3 text-white" id="btn_signup" style="background-color: #EF5241;">Register</button> -->
                        </div>
                        <div class="">
                            <h5 class="card-title fw-bolder">Ride Details</h5>
                        </div>
                        <div id="loading_div" class="d-flex justify-content-center">
                            <div id="loading_spin" class="spinner-grow p-4 text-danger" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div id="map_div" style="display: none;">
                            <div class="my-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Pick Up Location</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control text-dark fw-bold" id="pick_location" name="pick_location" placeholder="Search">
                                        <button class="btn btn-dark" type="button" id="locate-me"><i class="bi bi-geo-alt-fill"></i></button>
                                    </div>
                                    <input type="text" name="pl_hidden" id="pl_hidden" hidden>
                                    <input type="hidden" id="pick_lat">
                                    <input type="hidden" id="pick_long">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Drop Off Location</label>
                                    <input id="drop_location" name="drop_location" type="text" class="form-control text-dark fw-bold" placeholder="Search">
                                    <input type="text" name="dl_hidden" id="dl_hidden" hidden>
                                    <input type="hidden" id="drop_lat">
                                    <input type="hidden" id="drop_long">
                                </div>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-dark">Distance</span>
                                    <span id="distance">---</span>
                                    <span class="fw-bold text-dark mt-3">Average Price</span>
                                    <span id="price">---</span>
                                </div>
                            </div>
                            <div id="map" class="rounded" style="height: 400px; width: 100%;"></div>
                            <div class="d-flex flex-row mt-3">
                                <div class="me-auto">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Select a Taxi
                                    </button>
                                </div>
                                <div>
                                    <button class="btn text-white" data-driver-id="" data-vehicle-id="" style="background-color: #EF5241;" id="findTaxi">Book Ride</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <h5 class="card-title fw-bolder">Booked Rides</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Time</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Driver</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rides as $ride) { ?>
                                        <tr>
                                            <td><?php echo date('Y-m-d H:i:s', strtotime($ride['started_at'])); ?></td>
                                            <td><?php echo $ride['passenger']['name']; ?></td>
                                            <td><?php echo $ride['pickup_location']; ?></td>
                                            <td><?php echo $ride['dropoff_location']; ?></td>
                                            <td><?php echo $ride['driver']['name']; ?></td>
                                            <td><?php echo $ride['status'] == 1 ? '<span class="badge text-bg-success">Completed</span>' : '<div class="d-flex flex-column"><span class="badge text-bg-info">On Going</span><a href="/payment?bookingId='. $ride['booking_id'] .'" class="btn btn-dark fs-6 mt-1">Make Payment</a></div>'; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-white fw-bolder fs-5" id="exampleModalLabel">Available Taxies</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <?php $x = 0;
                        foreach ($drivers as $driver) {
                            $x++; ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="row">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <img src="/images/taxi.png" alt="Rating Img" width="100%" class="">
                                            </div>
                                            <div class="col-9">
                                                <h5 class="card-title text-dark fw-bold"><?php echo $driver['name']; ?></h5>
                                                <div class="d-flex flex-column w-100">
                                                    <span>Mobile Number : <strong><?php echo $driver['phone']; ?></strong></span>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <span>Vehicle Model : <strong><?php echo $driver['vehicle_model']; ?></strong></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span>Vehicle Color : <strong><?php echo $driver['vehicle_color']; ?></strong></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="col-md-6">
                                                            <span>Vehicle Plate No : <strong><?php echo $driver['license_plate']; ?></strong></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span>Insured By : <strong><?php echo $driver['insurance_company']; ?></strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-dark book_btn mt-3" data-vehicle-id="<?php echo $driver['vehicle_id']; ?>" data-driver-id="<?php echo $driver['id']; ?>">Book Taxi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($x == 0) { ?>
                            <div class="alert alert-danger my-3" role="alert">
                                No taxis found for the given locations. Please try again later.
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>
    <script>
        var pl = null;
        var dl = null;
        var plt = 0;
        var dlt = 0;
        var plg = 0;
        var dlg = 0;
        var dist = 0;
        var prc = 0;

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
                        pl = address;
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
                        document.getElementById('price').innerText = 'LKR ' + price.toFixed(2);

                        dist = distance;
                        prc = price;
                        plt = pickupLat;
                        dlt = dropoffLat;
                        plg = pickupLng;
                        dlg = dropoffLng;
                        // set the pickup and dropoff locations
                        pl = document.getElementById('pl_hidden').value;
                        dl = document.getElementById('dl_hidden').value;
                        // enable the find taxi button
                        document.getElementById('findTaxi').disabled = false;
                    } else {
                        document.getElementById('distance').innerText = '---';
                        document.getElementById('price').innerText = '---';

                        dist = 0;
                        prc = 0;
                        plt = 0;
                        dlt = 0;
                        plg = 0;
                        dlg = 0;
                        pl = '';
                        dl = '';
                        // disable the find taxi button
                        document.getElementById('findTaxi').disabled = true;
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

                // set pl_hidden and dl_hidden
                document.getElementById('pl_hidden').value = document.getElementById('pick_location').value;
                document.getElementById('dl_hidden').value = place.formatted_address;
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

        // find taxi button click event
        $('#findTaxi').click(function() {
            if (plt == 0 || dlt == 0 || plg == 0 || dlg == 0 || dist == 0 || prc == 0 || pl == '' || dl == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please select pickup and dropoff locations!',
                });
            } else {
                // submit the form
                signUp();
                // window.location.href = '<?= base_url(); ?>ride/available?pl=' + pl + '&dl=' + dl + '&plt=' + plt + '&dlt=' + dlt + '&plg=' + plg + '&dlg=' + dlg + '&dist=' + dist + '&prc=' + prc;
            }
        });

        // #login button click event
        $('#login').click(function() {
            window.location.href = '<?= base_url(); ?>auth/signin';
        });

        function bookRide(user_id) {
            if (user_id == null) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Unabled to register the customer details!',
                });
                return;
            }
            var driver_id = $('#findTaxi').data('driver-id');
            var vehicle_id = $('#findTaxi').data('vehicle-id');
            if (!driver_id || !vehicle_id) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please select a taxi!',
                });
                return;
            }
            var pickup_location = pl;
            var drop_location = dl;
            var pickup_latitude = plt;
            var pickup_longitude = plg;
            var drop_latitude = dlt;
            var drop_longitude = dlg;
            var distance = dist;
            var price = prc;
            $.ajax({
                url: '/ride/book',
                type: 'post',
                data: {
                    passenger_id: user_id,
                    driver_id: driver_id,
                    vehicle_id: vehicle_id,
                    pickup_location: pickup_location,
                    drop_location: drop_location,
                    pickup_latitude: pickup_latitude,
                    pickup_longitude: pickup_longitude,
                    drop_latitude: drop_latitude,
                    drop_longitude: drop_longitude,
                    distance: distance,
                    price: price,
                    is_call_center: 1
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ride Booked',
                            text: 'Your ride has been booked. The driver will contact you shortly.',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // window.location.href = '/ride/view?bookingId=' + data.booking_id;
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message ? data.message : 'An error occurred while processing your request. Please try again later.',
                        });
                    }
                }
            });
        }

        function signUp() {
            $("#findTaxi").prop('disabled', true);
            $('#findTaxi').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Booking...');

            var name = $('#name').val();
            var address = $('#address').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var nic = $('#nic').val();
            var isDriver = 0;

            if (name == '' || address == '' || email == '' || phone == '' || nic == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill all the fields!',
                });
                $("#findTaxi").prop('disabled', false);
                $("#findTaxi").text('Book Taxi');
                return;
            }

            var driver_id = $('#findTaxi').data('driver-id');
            var vehicle_id = $('#findTaxi').data('vehicle-id');
            if (!driver_id || !vehicle_id) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a taxi 22!',
                });
                $("#findTaxi").prop('disabled', false);
                $("#findTaxi").text('Book Taxi');
                return;
            }

            $.ajax({
                url: '<?= base_url(); ?>auth/register',
                method: 'POST',
                data: {
                    name: name,
                    address: address,
                    email: email,
                    phone: phone,
                    nic: nic,
                    is_driver: isDriver
                },
                success: function(response) {
                    $("#findTaxi").prop('disabled', false);
                    $("#findTaxi").text('Book Taxi');
                    if (response.success) {
                        bookRide(response.userId);
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Registration successful!',
                        //     text: 'Customer Details Registered Successfully!',
                        //     confirmButtonText: 'OK'
                        // }).then(function() {
                        //     location.reload();
                        // });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: "Ooops...",
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $("#findTaxi").prop('disabled', false);
                    $("#findTaxi").text('Book Taxi');
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing your request. Please try again later.'
                    });
                }
            });
        };

        // book taxi button click event
        $('.book_btn').click(function() {
            // get the driver id and vehicle id
            var driver_id = $(this).data('driver-id');
            var vehicle_id = $(this).data('vehicle-id');

            // set the driver id and vehicle id to the find taxi button
            $('#findTaxi').attr('data-driver-id', driver_id);
            $('#findTaxi').attr('data-vehicle-id', vehicle_id);

            // alert('driver id: ' + driver_id + ', vehicle id: ' + vehicle_id);

            // close the modal  
            $('.btn-close').trigger('click');
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF6DmICYAwskmjHJVMC_2LzCSnsgnogwg&loading=async&libraries=places&callback=myMap"></script>
</body>

</html>