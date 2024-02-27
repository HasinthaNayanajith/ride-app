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
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 64px;">Choose a ride
                </h5>
                <p class="card-text mt-3">Currently available drivers.</p>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="my-3">
                    <div class="mb-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="row">
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <img src="/images/taxi.png" alt="Rating Img" width="100%" class="">
                                        </div>
                                        <div class="col-9">
                                            <h5 class="card-title text-dark fw-bold">LKR 1200.00</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-dark">Select</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="row">
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <img src="/images/taxi.png" alt="Rating Img" width="100%" class="">
                                        </div>
                                        <div class="col-9">
                                            <h5 class="card-title text-dark fw-bold">LKR 1200.00</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-dark">Select</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="row">
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <img src="/images/taxi.png" alt="Rating Img" width="100%" class="">
                                        </div>
                                        <div class="col-9">
                                            <h5 class="card-title text-dark fw-bold">LKR 1200.00</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-dark">Select</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 d-flex justify-content-center">
                <img src="/images/ride.webp" alt="Rating Img" width="500px" class="">
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>
</body>

</html>