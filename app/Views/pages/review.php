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
                <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 64px;">How was your ride ?
                </h5>
                <p class="card-text mt-3">Help others by leaving a review.</p>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="card mt-3">
                    <div class="card-body p-4">
                        <form action="javascript:void(0)" id="review_form">
                            <div class="my-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Your Rating</label>
                                    <div class="d-flex stars">
                                        <style>
                                            .stars i {
                                                font-size: 20px;
                                                color: #000;
                                                text-decoration: none;
                                                transition: all 0.5s;
                                                margin-right: 10px;
                                                cursor: pointer;
                                            }

                                            .stars i.active {
                                                color: gold;
                                            }
                                        </style>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Any comments ?</label>
                                    <textarea name="" id="" class="form-control" cols="3" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="float-end">
                                <button class="btn btn-light mt-3">Cancel</button>
                                <button class="btn btn-primary mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <img src="/images/rating.png" alt="Rating Img" width="60%" class="ms-5 ps-5">
            </div>
        </div>
    </div>
    <?php echo view('layouts/footer'); ?>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize star rating
        $('.stars i').removeClass('active');

        // Toggle 'active' class on click
        $('.stars i').click(function() {
            $(this).toggleClass('active');
            $(this).prevAll().addClass('active');
            $(this).nextAll().removeClass('active');

            // Calculate count of active stars
            var count = $('.stars i.active').length;

            // Display count in console or wherever needed
            console.log('Star count: ' + count);
        });
    });
</script>

</html>