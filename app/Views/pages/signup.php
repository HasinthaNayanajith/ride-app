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
        <div class="col-md-6 offset-md-3">
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="text-center py-2">
                        <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 30px;">Signup for free</h5>
                    </div>
                    <hr>
                    <div class="my-3">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                            <label for="exampleFormControlInput2" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="">
                            </div>
                            <div class="col-md-6">
                            <label for="exampleFormControlInput2" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="">
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">NIC</label>
                            <input type="text" class="form-control" id="nic" name="nic">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Signup as a driver
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 mt-3">Signup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('layouts/footer'); ?>