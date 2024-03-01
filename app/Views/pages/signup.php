<?php echo view('layouts/header'); ?>

<div class="p-3">
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="text-center py-2">
                        <h5 class="card-title fw-bolder font-playfair text-dark" style="font-size: 30px;">Sign Up for free</h5>
                    </div>
                    <hr>
                    <form id="signupForm">
                        <div class="my-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nic" class="form-label">NIC</label>
                                <input type="text" class="form-control" id="nic" name="nic">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Signup as a driver
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3" id="btn_signup">Signup</button>
                    </form>
                    <div class="text-center mt-3">
                        <span>Have an Account? <a href="<?= base_url('auth/signin'); ?>">Sign In</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#signupForm').submit(function(e) {
            $("#btn_signup").prop('disabled', true);
            $("#btn_signup").text('Signing Up...');

            e.preventDefault();

            var name = $('#name').val();
            var address = $('#address').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var nic = $('#nic').val();
            var isDriver = $('#flexCheckDefault').is(':checked');

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
                    $("#btn_signup").prop('disabled', false);
                    $("#btn_signup").text('Signup');
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration successful!',
                            text: 'We have sent your username and password to your email.',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '<?= base_url(); ?>auth/signin';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration failed',
                            text: 'Please try again.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $("#btn_signup").prop('disabled', false);
                    $("#btn_signup").text('Signup');
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing your request. Please try again later.'
                    });
                }
            });
        });
    });
</script>


<?php echo view('layouts/footer'); ?>