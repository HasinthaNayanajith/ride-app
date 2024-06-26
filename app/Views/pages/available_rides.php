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
    <style>
        .md-stepper-horizontal {
            display: table;
            width: 100%;
            margin: 0 auto;
            background-color: #FFFFFF;
            box-shadow: 0 3px 8px -6px rgba(0, 0, 0, .50);
        }

        .md-stepper-horizontal .md-step {
            display: table-cell;
            position: relative;
            padding: 24px;
        }

        .md-stepper-horizontal .md-step:hover,
        .md-stepper-horizontal .md-step:active {
            background-color: rgba(0, 0, 0, 0.04);
        }

        .md-stepper-horizontal .md-step:active {
            border-radius: 15% / 75%;
        }

        .md-stepper-horizontal .md-step:first-child:active {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .md-stepper-horizontal .md-step:last-child:active {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .md-stepper-horizontal .md-step:hover .md-step-circle {
            background-color: #757575;
        }

        .md-stepper-horizontal .md-step:first-child .md-step-bar-left,
        .md-stepper-horizontal .md-step:last-child .md-step-bar-right {
            display: none;
        }

        .md-stepper-horizontal .md-step .md-step-circle {
            width: 30px;
            height: 30px;
            margin: 0 auto;
            background-color: #999999;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-size: 16px;
            font-weight: 600;
            color: #FFFFFF;
        }

        .md-stepper-horizontal.green .md-step.active .md-step-circle {
            background-color: #00AE4D;
        }

        .md-stepper-horizontal.orange .md-step.active .md-step-circle {
            background-color: #F96302;
        }

        .md-stepper-horizontal .md-step.active .md-step-circle {
            background-color: rgb(33, 150, 243);
        }

        .md-stepper-horizontal .md-step.done .md-step-circle:before {
            font-family: 'FontAwesome';
            font-weight: 100;
            content: "\f041";
        }

        .md-stepper-horizontal .md-step.done .md-step-circle *,
        .md-stepper-horizontal .md-step.editable .md-step-circle * {
            display: none;
        }

        .md-stepper-horizontal .md-step.editable .md-step-circle {
            -moz-transform: scaleX(-1);
            -o-transform: scaleX(-1);
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
        }

        .md-stepper-horizontal .md-step.editable .md-step-circle:before {
            font-family: 'FontAwesome';
            font-weight: 100;
            /* location icon*/
            content: "\f041";
        }

        .md-stepper-horizontal .md-step .md-step-title {
            margin-top: 16px;
            font-size: 16px;
            font-weight: 600;
        }

        .md-stepper-horizontal .md-step .md-step-title,
        .md-stepper-horizontal .md-step .md-step-optional {
            text-align: center;
            color: rgba(0, 0, 0, .26);
        }

        .md-stepper-horizontal .md-step.active .md-step-title {
            font-weight: 600;
            color: rgba(0, 0, 0, .87);
        }

        .md-stepper-horizontal .md-step.active.done .md-step-title,
        .md-stepper-horizontal .md-step.active.editable .md-step-title {
            font-weight: 600;
        }

        .md-stepper-horizontal .md-step .md-step-optional {
            font-size: 12px;
        }

        .md-stepper-horizontal .md-step.active .md-step-optional {
            color: rgba(0, 0, 0, .54);
        }

        .md-stepper-horizontal .md-step .md-step-bar-left,
        .md-stepper-horizontal .md-step .md-step-bar-right {
            position: absolute;
            top: 36px;
            height: 1px;
            border-top: 1px solid #DDDDDD;
        }

        .md-stepper-horizontal .md-step .md-step-bar-right {
            right: 0;
            left: 50%;
            margin-left: 20px;
        }

        .md-stepper-horizontal .md-step .md-step-bar-left {
            left: 0;
            right: 50%;
            margin-right: 20px;
        }
    </style>
    <div class="p-5">
        <div class="row">
            <div class="text-center my-4">
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 64px;">Choose a Driver
                </h5>
                <p class="card-text mt-3">Currently available drivers.</p>
            </div>
            <div class="col-md-10 offset-md-1 col-sm-12">
                <div class="my-3">

                    <div class="mb-3 bg-dark rounded">
                        <div class="md-stepper-horizontal orange rounded bg-dark">
                            <div class="md-step active done">
                                <div class="md-step-circle"><span>From</span></div>
                                <div class="md-step-title text-light">
                                    <p>
                                        <?php echo $pickup_location; ?>
                                    </p>
                                </div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active done">
                                <div class="md-step-circle"><span>To</span></div>
                                <div class="md-step-title text-light">
                                    <p>
                                        <?php echo $drop_location; ?>
                                    </p>
                                </div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                        </div>
                        <div class="mt-3 py-4 d-flex flex-column text-center">
                            <h1 class="fw-bolder text-light" style="font-size: 72px; font-weight: 900;"><?php echo $distance; ?></h1>
                            <h4 style="color: orange;"><?php echo 'LKR ' . $price . '.00'; ?></h4>
                        </div>
                    </div>
                    <div class="mb-3">
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
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>
    <script>
        $(document).ready(function() {
            $('.book_btn').click(function() {
                var driver_id = $(this).data('driver-id');
                var vehicle_id = $(this).data('vehicle-id');
                var pickup_location = "<?php echo $pickup_location; ?>";
                var drop_location = "<?php echo $drop_location; ?>";
                var pickup_latitude = "<?php echo $pickup_latitude; ?>";
                var pickup_longitude = "<?php echo $pickup_longitude; ?>";
                var drop_latitude = "<?php echo $drop_latitude; ?>";
                var drop_longitude = "<?php echo $drop_longitude; ?>";
                var distance = "<?php echo $distance; ?>";
                var price = "<?php echo $price; ?>";
                $.ajax({
                    url: '/ride/book',
                    type: 'post',
                    data: {
                        driver_id: driver_id,
                        vehicle_id: vehicle_id,
                        pickup_location: pickup_location,
                        drop_location: drop_location,
                        pickup_latitude: pickup_latitude,
                        pickup_longitude: pickup_longitude,
                        drop_latitude: drop_latitude,
                        drop_longitude: drop_longitude,
                        distance: distance,
                        price: price
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Ride Booked',
                                text: 'Your ride has been booked. The driver will contact you shortly.',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/ride/view?bookingId=' + data.booking_id;
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
            });
        });
    </script>
</body>

</html>