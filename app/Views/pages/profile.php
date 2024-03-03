<?php echo view('layouts/header'); ?>

<div class="container px-5 py-3">
    <main id="main" class="main">

        <div class="pagetitle my-4">
            <h1>Profile Settings</h1>
            <!-- <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav> -->
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="/images/user.jpg" alt="Profile" class="rounded-circle" height="100px" width="100px">
                            <h2 class="mt-3"><?php echo $user['name']; ?></h2>
                            <h5 class="fst-italic"><?php echo $user['is_driver'] == 1 ? 'Driver' : 'Passenger'; ?></h5>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter" style="color: #EF5241;"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook" style="color: #EF5241;"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram" style="color: #EF5241;"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin" style="color: #EF5241;"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" style="color: #EF5241;">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" style="color: #EF5241;">Edit Profile</button>
                                </li>
                                <?php if ($user['is_driver'] == 1) : ?>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" style="color: #EF5241;">Vehicle Settings</button>
                                    </li>
                                <?php endif; ?>
                                <?php if ($user['is_driver'] == 0) : ?>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rides" style="color: #EF5241;">Your Rides</button>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <!-- <h5 class="card-title my-3">Profile Details</h5> -->
                                    <table class="table mt-3">
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 col-md-4 label">Full Name</td>
                                                <td class="col-lg-9 col-md-8 fw-light"><?php echo $user['name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3 col-md-4 label">Role</td>
                                                <td class="col-lg-9 col-md-8 fw-light"><?php echo $user['is_driver'] == 1 ? 'Driver' : 'Passenger'; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3 col-md-4 label">Country</td>
                                                <td class="col-lg-9 col-md-8 fw-light">Sri Lanka</td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3 col-md-4 label">Address</td>
                                                <td class="col-lg-9 col-md-8 fw-light"><?php echo $user['address']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3 col-md-4 label">Phone</td>
                                                <td class="col-lg-9 col-md-8 fw-light"><?php echo $user['phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3 col-md-4 label">NIC</td>
                                                <td class="col-lg-9 col-md-8 fw-light"><?php echo $user['nic']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3 col-md-4 label">Email</td>
                                                <td class="col-lg-9 col-md-8 fw-light"><?php echo $user['email']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form id="profile_form" action="javascript:void(0)">
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name" value="<?php echo $user['name']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="address" value="<?php echo $user['address']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $user['phone']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" value="<?php echo $user['email']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">NIC</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nic" type="text" class="form-control" id="nic" value="<?php echo $user['nic']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="uname" type="text" class="form-control" id="uname" value="<?php echo $user['username']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="text" class="form-control" id="password" value="" placeholder="***********">
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn text-white" style="background-color: #EF5241;">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">
                                    <?php if (empty($vehicle)) { ?>
                                        <form id="vehicle_registration_form" action="javascript:void(0)">
                                            <div class="mb-3">
                                                <label for="vehicle_model" class="form-label">Vehicle Model</label>
                                                <input type="text" class="form-control" id="vehicle_model" name="vehicle_model">
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle_year" class="form-label">Vehicle Year</label>
                                                <input type="text" class="form-control" id="vehicle_year" name="vehicle_year">
                                            </div>
                                            <div class="mb-3">
                                                <label for="license_plate" class="form-label">License Plate Number</label>
                                                <input type="text" class="form-control" id="license_plate" name="license_plate">
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle_color" class="form-label">Vehicle Color</label>
                                                <input type="text" class="form-control" id="vehicle_color" name="vehicle_color">
                                            </div>
                                            <div class="mb-3">
                                                <label for="insurance_company" class="form-label">Insurance Company</label>
                                                <input type="text" class="form-control" id="insurance_company" name="insurance_company">
                                            </div>
                                            <div class="mb-3">
                                                <label for="policy_number" class="form-label">Policy Number</label>
                                                <input type="text" class="form-control" id="policy_number" name="policy_number">
                                            </div>
                                            <div class="mb-3">
                                                <label for="expiration_date" class="form-label">Insurance Expiration Date</label>
                                                <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    <?php } else { ?>
                                        <form id="vehicle_update_form" action="javascript:void(0)">
                                            <div class="mb-3">
                                                <label for="vehicle_model" class="form-label">Vehicle Model</label>
                                                <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" value="<?php echo $vehicle['vehicle_model']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle_year" class="form-label">Vehicle Year</label>
                                                <input type="text" class="form-control" id="vehicle_year" name="vehicle_year" value="<?php echo $vehicle['vehicle_year']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="license_plate" class="form-label">License Plate Number</label>
                                                <input type="text" class="form-control" id="license_plate" name="license_plate" value="<?php echo $vehicle['license_plate']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle_color" class="form-label">Vehicle Color</label>
                                                <input type="text" class="form-control" id="vehicle_color" name="vehicle_color" value="<?php echo $vehicle['vehicle_color']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="insurance_company" class="form-label">Insurance Company</label>
                                                <input type="text" class="form-control" id="insurance_company" name="insurance_company" value="<?php echo $vehicle['insurance_company']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="policy_number" class="form-label">Policy Number</label>
                                                <input type="text" class="form-control" id="policy_number" name="policy_number" value="<?php echo $vehicle['policy_number']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="expiration_date" class="form-label">Insurance Expiration Date</label>
                                                <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="<?php echo $vehicle['expiration_date']; ?>">
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn text-white" style="background-color: #EF5241;">Update Details</button>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane fade rides pt-3" id="rides">
                                    <div class="ride-container" style="height: 400px; overflow-y: auto;">
                                        <?php foreach ($rideHistory as $ride) : ?>
                                            <div class="card text-center mb-5 border">
                                                <div class="card-header fw-bold">
                                                    <?= isset($ride['payment']['payment_date']) ? 'Completed' : 'Ongoing' ?>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="text-start">
                                                            <p class="card-text fw-bold  fs-6"><img src="/images/location.svg" height="20px" width="20px" alt="">From: <span class="fw-light font-italic"><?= $ride['ride']['pickup_location']; ?></span></p>
                                                            <p class="card-text fw-bold fs-6"><img src="/images/location1.svg" height="20px" width="20px" alt="">To: <span class="fw-light font-italic"><?= $ride['ride']['dropoff_location']; ?></span></p>

                                                        </div>
                                                        <p class="card-text fw-bold fs-6 text-end">Distance: <span class="fw-light font-italic"><?= $ride['ride']['distance']; ?></span></p>
                                                        <p><?= isset($ride['payment']['payment_date']) ? $ride['payment']['payment_date'] : 'Not yet paid' ?></p>
                                                    </div>

                                                    <hr>
                                                    <?php if (isset($ride['payment']['payment_date'])) { ?>
                                                        <?php if (isset($ride['payment']['amount'])) : ?>
                                                            <p class="card-text fs-4 fw-bold">LKR <?= $ride['payment']['amount']; ?></p>
                                                        <?php endif; ?>
                                                        <?php if (isset($ride['review']['stars'])) : ?>
                                                            <p class="card-text fs-6 fw-light fst-italic">Ratings:
                                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                                    <?php if ($i <= $ride['review']['stars']) : ?>
                                                                        <span class="filled-star" style="color: orange;">&#9733;</span>
                                                                    <?php else : ?>
                                                                        <span>&#9734;</span>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    <?php } else { ?>
                                                        <a href="<?= base_url() ?>payment?bookingId=<?= $ride['booking_id'] ?>" type="button" class="btn btn-outline-success px-3">Finish Ride</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<?php echo view('layouts/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#profile_form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '<?php echo base_url('auth/update_profile'); ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile Updated',
                        text: 'Your profile has been updated successfully!'
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again later.'
                    });
                    console.error(error);
                }
            });
        });

        $('#vehicle_registration_form').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '<?php echo base_url('auth/register_vehicle'); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Vehicle Registration Successful',
                            text: 'Your vehicle has been registered successfully!'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again later.'
                    });
                }
            });
        });

        $('#vehicle_update_form').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '<?php echo base_url('auth/update_vehicle'); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Your vehicle details has been updated successfully!'
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again later.'
                    });
                }
            });
        });

    });
</script>