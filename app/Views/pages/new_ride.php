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
                        <div class="my-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pick Up Location</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Drop Off Location</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="">
                            </div>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary mt-3">See Available Drivers & Prices</button>
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
</body>

</html>