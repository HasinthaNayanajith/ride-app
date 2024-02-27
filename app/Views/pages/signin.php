<?php echo view('layouts/header'); ?>
<div class="p-3">
    <!-- <div class="alert alert-white" role="alert">
            <h4 class="alert-heading fw-bolder text-dark">Well done!</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            <button class="btn btn-dark mt-3">Learn More</button>
        </div> -->
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 48px;">Sign In</h5>
                        <p class="card-text">First thing is first. Please log into continue.</p>
                    </div>
                    <hr>
                    <div class="my-3">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address / Phone Number</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 mt-3">Sign Me In</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('layouts/footer'); ?>