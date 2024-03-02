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
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 64px;">Your Ride
                </h5>
                <p class="card-text mt-3">View your ride details.</p>
            </div>
            <div class="col-md-10 offset-md-1 col-sm-12">
                <div class="my-3">

                    <div class="mb-3 bg-dark rounded">
                        <div class="md-stepper-horizontal orange rounded bg-dark">
                            <div class="md-step active done">
                                <div class="md-step-circle"><span>From</span></div>
                                <div class="md-step-title text-light">
                                    <p>
                                        <?php echo $ride['pickup_location']; ?>
                                    </p>
                                </div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step active done">
                                <div class="md-step-circle"><span>To</span></div>
                                <div class="md-step-title text-light">
                                    <p>
                                        <?php echo $ride['dropoff_location']; ?>
                                    </p>
                                </div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                        </div>
                        <div class="mt-3 py-4 d-flex flex-column text-center">
                            <h1 class="fw-bolder text-light" style="font-size: 72px; font-weight: 900;"><?php echo $ride['distance']; ?></h1>
                            <h4 style="color: orange;"><?php echo 'LKR ' . $ride['price'] . '.00'; ?></h4>
                            <span class="my-4">Driver & Vehicle Details</span>
                            <h5 class="fw-bolder text-light"><?php echo 'Name : ' . $driver['name']; ?></h5>
                            <h5 class="fw-bolder text-light"><?php echo 'Mobile : ' . $driver['phone']; ?></h5>
                            <h5 class="fw-bolder text-light"><?php echo 'Vehicle : ' . $vehicle['vehicle_model']; ?></h5>
                            <div class="w-100 d-flex justify-content-center">
                                <a href="/payment?bookingId=<?php echo $booking['id']; ?>" class="btn btn-success my-5 p-4" style="width: fit-content;">Make Payment & Complete Ride</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>
    <script>
        $(document).ready(function() {});
    </script>
</body>

</html>