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
    <div class="px-5 py-2">
        <div class="row">
            <div class="mt-3">
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 35px;">
                    Confirm Payment
                </h5>
                <p class="card-text mt-3"></p>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="card mt-3">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h4 class="fw-bold mb-4">
                                <?php if (session()->get('user_id')) : ?>
                                    Welcome back, <?php echo (session()->get('name'));  ?>!
                                <?php else : ?>
                                    Hello, Passenger!
                                <?php endif; ?>
                            </h4>
                            <p class="fs-5 mb-4">Thank you for choosing our ride service. You have arrived at your destination.</p>
                            <p class="fs-6">Please confirm your payment to complete your journey.</p>
                            <h4 class="mt-4">Total Distance</h4>
                            <h5>3.7Km</h5>
                            <h2 class="mt-4">Total Amount</h2>
                            <h4>LKR 617.98</h4>
                            
                        </div>
                        <form action="javascript:void(0)" id="payment_form">
                            <input type="text" class="form-control" name="ride_id" id="ride_id" placeholder="ride id" value="5" hidden>
                            <input type="text" class="form-control" name="driver_id" id="driver_id" placeholder="driver id" value="3" hidden>
                            <input type="number" class="form-control" name="distance" id="distance" placeholder="passenger id" value="3" hidden>
                            <input type="number" class="form-control fs-3" name="amount" id="amount" placeholder="amount" value="467" hidden>
                            <button type="submit" id="btn_payment" class="btn btn-primary mt-4 w-100 py-2">Confirm Payment</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class=" col-md-7 col-sm-12 d-flex justify-content-center">
                <img src="/images/pay.png" alt="Payment Img" width="50%" class="ms-5 ps-5">
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#payment_form').submit(function(e) {
                $('#btn_payment').prop('disabled', true).html('Processing...');
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '<?php echo base_url('payment/create'); ?>',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#btn_payment').prop('disabled', false).html('Confirm Payment');
                            Swal.fire({
                                icon: 'success',
                                title: 'Paid!',
                                text: response.message
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    window.location.href = '<?php echo base_url(); ?>review?ride=' + response.ride_id;
                                }
                            });
                        } else {
                            $('#btn_payment').prop('disabled', false).html('Confirm Payment');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        $('#btn_payment').prop('disabled', false).html('Confirm Payment');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred. Please try again later.'
                        });
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>