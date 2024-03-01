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
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 40px;">
                    Confirm Payment
                </h5>
                <p class="card-text mt-3"></p>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card mt-3">
                    <div class="card-body p-4">
                        <div class="my-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Ride ID</label>
                                <input type="text" class="form-control" name="ride_id" id="ride_id" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Total KM</label>
                                <input type="number" class="form-control" name="km" id="km" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Total Amount</label>
                                <input type="number" class="form-control" name="amount" id="amount" readonly>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3 w-100">Confirm Payment</button>
                    </div>
                </div>
            </div>
            <div class=" col-md-8 col-sm-12 d-flex justify-content-center">
                <img src="/images/pay.png" alt="Payment Img" width="40%" class="ms-5 ps-5">
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>
</body>

</html>