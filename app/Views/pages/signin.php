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
                    <form action="javascript:void(0)" id="signinForm">
                        <div class="my-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 mt-3" id="btn_signin">Sign Me In</button>
                    </form>
                    <div class="text-center mt-3">
                        <span>Dont have an Account? <a href="<?= base_url('auth/signup'); ?>">Sign Up</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('layouts/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#signinForm').submit(function(e) {
            e.preventDefault();

            $('#btn_signin').prop('disabled', true).html('Signing In... <i class="fas fa-spinner fa-spin"></i>');

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: '<?= base_url(); ?>auth/login',
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Login successful!',
                            showConfirmButton: false, 
                            timer: 1000
                        });
                        setTimeout(function() {
                            window.location.href = '<?php echo base_url(); ?>';
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Login failed. ' + response.message
                        });
                        $('#btn_signin').prop('disabled', false).html('Sign In');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing your request. Please try again later.'
                    });
                    $('#btn_signin').prop('disabled', false).html('Sign In');
                }
            });
        });
    });
</script>