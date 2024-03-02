<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W4ZB7XB');
    </script>
    <!-- End Google Tag Manager -->



    <link rel="icon" type="image/png" href="resources/images/favicon.ico">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;700&amp;display=swap" rel="stylesheet">
    <title>CityTaxi</title>
    <meta name="description" content="You can go anywehere you want at anytime with CityTaXi.COM. Book a TukTuk, Budget Cars, SUVs & Vans.">
    <meta name="author" content="deltadevelops.xyz">
    <meta name="theme-color" content="#FDB940" />

    <link rel="alternate" hreflang="x-default" href="index.html" />
    <!-- <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PLDW6EY6PV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-PLDW6EY6PV');
    </script>

    <!--<link rel="stylesheet" href="" />-->
    <link rel="stylesheet" href="template/css/all-styles.css" />
    <link rel="dns-prefetch" href="http://ajax.googleapis.com/">
    <script>
        const site_url = "index.html";
    </script>
    <script>
        const debug = false;
    </script>
    <script src="includes/js/jquery-3.6.0.min.js"></script>
    <script src="includes/js/ajax.min.js"></script>
    <script src="template/js/scripts.minfa5a.js?version=1706416645"></script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PKML8SHG');
    </script>
    <!-- End Google Tag Manager -->

</head>
<style>
    .miles-buy {
        margin: 1rem 0;
        background: #EF5241;
        border: 0;
        outline: 0;
        border-radius: 3px;
        padding: 5px;
        font-size: 13px;
        text-align: center;
    }

    .miles-buy:hover {
        color: #ffffff;
        background: #aa3b46;
    }
</style>

<body data-spy="scroll" data-target="#home-page-menu" data-offset="68">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W4ZB7XB" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKML8SHG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    <nav class="navbar navbar-light fixed-top bg-white navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="images/logo.svg" width="120" alt="CityTaXi.COM Logo">
            </a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-flex justify-content-between text-center text-md-left" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" id="home-page-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="#fleet">Our Fleet</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>auth/profile">Profile</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>ride">Book Now</a>
                    </li>
                </ul>
                <div>
                    <?php if (session()->get('user_id')) : ?>
                        <a href="<?php echo base_url(); ?>auth/profile"><span class="email mt-1">Hi!&nbsp;<?php echo session()->get('name'); ?></span></a>
                        <button type="button" class="btn" id="btn_logout" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout"><i class="fa-solid fa-right-from-bracket fs-5"></i></button>
                    <?php else : ?>
                        <a href="<?php echo base_url('auth/signin'); ?>" class="btn">Sign In</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </nav>
    <div class="nav-push"></div>
    <div id="height-const">
        <div id="content">

            <section class="home-section" id="home-banner" style="margin-top: -80px ;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-7 mb-5 text-md-left text-center">
                            <!-- <img src="/images/logo.svg" width="300" alt="CityTaXi.COM Logo"> -->
                            <h1 class="home-title text-tight"><span class="SF-thin">Discover </span><br /><strong>CityTaxi</strong></h1>
                            <h2 class="h3 text-tight">Call Us at 011-9998881</h2>
                            <h3 class="h5 text-tight">Your Reliable Transportation Solution</h3>
                            <a href="<?php echo base_url(); ?>ride" type="button" class="btn btn-danger px-4 mt-2 rounded rounded-pill">Book Now&nbsp;<i class="fa-solid fa-arrow-right"></i></a>
                        </div>


                        <!-- ===== BOOKING PANEL =============================================================================== -->
                        <img src="/images/back.png" width="460">

                    </div> <!-- .row ENDs here -->
                </div> <!-- .container ENDs here -->
            </section>

            <section id="airport_tr" class="bg-xlight home-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <img class="img-fluid lazyload" id="home-airport-tr-image" data-src="https://kangaroocabs.com/resources/images/airport_img_1.png" alt="Image Airport Transfer" title="The best Airport Transfer in the city">
                        </div>
                        <div class="col-md-6 text-md-left text-center">
                            <h2 class="h1 text-bold" id="home-airport-tr-heading">CityTaXi<br /><span class="text-yellow">Passenger</span> Transfers</h2>
                            <p class="mt-md-auto mt-4">CityTaXi offer the lowest rates in <span class="text-bold">Passenger Transfers</span> Sri Lanka. From Kurunegala to any destination in the island.</p>
                            <a href="#" class="btn btn-outline-secondary py-1 text-small mt-4 text-md-left text-center"><span class="text-uppercase">Passenger Transfers</span> <i class="la la-arrow-right"></i> </a>
                        </div>
                    </div>
                </div>
            </section>

            <section id="fleet" class="home-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mt-md-5 bg-dark p-5 rounded text-md-left text-center" style="z-index: 1029">
                            <div class="swiper-container slider2 text-white ">
                                <h4>CityTaXi</h4>
                                <h2 class="text-bold">OUR FLEET</h2>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide mt-5">
                                        <h4 class="text-bold">Expo</h4>
                                        <h5 class="h6">Tata Nano</h5>
                                        <p>A small hatchback, air conditioned with capacity of 3 passengers ideal for short distance trips.</p>
                                    </div>
                                    <div class="swiper-slide mt-5">
                                        <h4 class="text-bold">Budget</h4>
                                        <h5 class="h6">Suzuki Alto</h5>
                                        <p>A small hatchback, air conditioned with capacity of 3 passengers ideal for short distance trips.</p>
                                    </div>
                                    <div class="swiper-slide mt-5">
                                        <h4 class="text-bold">City</h4>
                                        <h5 class="h6">Suzuki WagonR</h5>
                                        <p>A hatchback, air conditioned with capacity of 4 passengers ideal for short distance trips with adequate luggage space.</p>
                                    </div>
                                    <div class="swiper-slide mt-5">
                                        <h4 class="text-bold">Semi</h4>
                                        <h5 class="h6">Toyota Aqua / Toyota Vitz / Honda Fit</h5>
                                        <p>A full size , air conditioned sedan with capacity of 4 passengers ideal for long distance trips with plenty of luggage space.</p>
                                    </div>
                                    <div class="swiper-slide mt-5">
                                        <h4 class="text-bold">Car</h4>
                                        <h5 class="h6">Toyota Prius/Axio</h5>
                                        <p>A full size , air conditioned sedan with capacity of 4 passengers ideal for long distance trips with plenty of luggage space.</p>
                                    </div>
                                    <div class="swiper-slide mt-5">
                                        <h4 class="text-bold">9Seater</h4>
                                        <h5 class="h6">Toyota KDH</h5>
                                        <p>A mini van, air conditioned with capacity of 9 passengers ideal for long distance trips.</p>
                                    </div>
                                    <div class="swiper-slide mt-5">
                                        <h4 class="text-bold">14Seater</h4>
                                        <h5 class="h6">Toyota KDH</h5>
                                        <p>A full sized commuter van, air conditioned with capacity of 14 passengers ideal for long distance trips.</p>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-outline-light py-1 text-small mt-4"><span>READ MORE ABOUT THE FLEET</span> <i class="la la-arrow-right"></i> </a>
                        </div>
                        <div class="col-md-8 mt-md-5 mt-2"> <!--mt-md-n1-->
                            <img data-src="https://kangaroocabs.com/resources//images/kangaroo-fleet.jpg" class="img-fluid lazyload" alt="Our Fleet" title="Our Fleet" id="our-fleet">
                            <div class="row fleet-pagination" id="fleet-vtypes"><!--ml-md-5-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="manage-booking" class="home-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <img class="img-fluid lazyload" id="home-manage-booking-image" data-src="https://kangaroocabs.com/resources//images/booking_img_1.jpg" alt="Manage Booking" title="Manage your booking made simple">
                        </div>
                        <div class="col-md-6">
                            <h2 class="h1 text-bold text-md-left text-center" id="home-manage-booking-heading">Check your <span class="text-yellow">Booking</span></h2>
                            <form class="roo-form api" data-targetele="targetele" action="#" name="manage-booking" method="post">
                                <div class="row mt-md-auto mt-4">
                                    <div class="col-md-8">
                                        <div class="">
                                            <label for="booking_id" class="text-bold">Your reference number</label>
                                            <div class="input-group">
                                                <input type="text" name="booking_id" id="booking_id" placeholder="Eg: AAA1234" class="form-control border-right-0" autocomplete="off" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-white border-left-0" style="border:1px solid #dfdfdf" id="basic-addon2"><i class="la la-paste text-success"></i></span>
                                                </div>
                                            </div>
                                            <label for="manage-tel" class="text-bold">Your telephone number</label>
                                            <input type="tel" name="manage_tel" id="manage-tel" class="telephone" required>
                                            <input type="hidden" value="" id="countrycode" name="countryCodeManage">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="reset" value="CLEAR" class="form-control">
                                            </div>
                                            <div class="col-6">
                                                <input type="submit" value="CHECK NOW" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="message"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modal -->
            <div class="modal fade modal-app-ad" id="appInstallModal" tabindex="-1" role="dialog" aria-labelledby="appInstallModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body android-ad">
                            <div class="row no-gutters">
                                <div class="col-1 text-center px-1 align-items-center d-flex">
                                    <span id="modal-close-ad" data-dismiss="modal" aria-label="Close" class="font-big bg-light rounded-circle text-body m-0 text-center">&times;</span>
                                </div>
                                <div class="col-2">
                                    <img data-src="https://kangaroocabs.com/resources/images/app-logo.png" class="img-fluid pt-1 lazyload" alt="App Image" title="Download your favourite taxi app here">
                                </div>
                                <div class="col-6 px-2">
                                    <p class="text-bold pt-1 m-0">CityTaXi</p>
                                    <p class="text-xsmall m-0 p-0">CityTaXi</p>
                                    <p class="text-xsmall m-0 p-0" id="app-ad-desc3">FREE - in Google Play</p>
                                </div>
                                <div class="col-2">
                                    <a href="#" id="app-ad-link"><button class="mt-3 btn btn-info text-small">VIEW</button> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    bookingform();
                })
            </script>



        </div>
        <section class="home-section" id="contact">
            <div class="container-fluid">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8 offset-md-1 text-md-left text-center">
                                <h4>CityTaXi</h4>
                                <h2 class="text-bold">HEADQUARTERS</h2>
                                <p class="">CityTaXi, Kurunegala, Sri Lanka</p>
                            </div>
                        </div>
                        <iframe title="CityTaXi on Google maps" class="mx-md-n3" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=350&amp;hl=en&amp;q=City%20Taxi,%20Kurunegala+(City%20Taxi)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Population calculator map</a></iframe>
                    </div>
                    <div class="col-md-4 mx-md-n3 p-4 pt-5 bg-yellow">
                        <h4 class="text-md-left text-center">Get in touch</h4>
                        <p class="text-md-left text-center">We would love to hear from you</p>
                        <form class="roo-form o1" action="#" method="post" name="contacts_mails" data-reset="yes">
                            <div class="row">
                                <div class="col-12">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="border-white" placeholder="Enter your name" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="contact-email">Email</label>
                                    <input type="contact-email" name="contact-email" id="contact-email" class="border-white" placeholder="Enter your email" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" class="border-white" placeholder="Enter your message" required></textarea>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-6">
                                    <input class="text-white" type="reset" value="CANCEL">
                                </div>
                                <div class="col-6">
                                    <input type="hidden" name="url" value="index.html" />
                                    <input class="bg-dark-yellow" type="submit" value="SEND">
                                </div>
                            </div>
                            <div class="message"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-5 bg-light text-center">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-2 col-12">
                        <img class="home-banner-logo img-fluid d-block mx-auto py-5 lazyload" data-src="resources/images/logoTR.svg" title="The CityTaXi Logo" alt="kangaroo logo">
                    </div>

                    <div class="col-md-6 col-8 d-md-flex d-none">
                        <div id="footer-social-media" class="mt-auto mb-4">
                            <a href="https://www.facebook.com/kangaroocabs/" rel="noreferrer" title="Facebook - CityTaXi" target="_blank"><i class="fab fa-facebook-f fa-2x fa-fw"></i></a>
                            <a href="https://twitter.com/2588588Cabs" rel="noreferrer" title="Twitter - CityTaXi" target="_blank"><i class="fab fa-twitter fa-2x fa-fw"></i></a>
                            <a href="https://www.instagram.com/kangaroocabs/" rel="noreferrer" title="Instagram - CityTaXi" target="_blank"><i class="fab fa-instagram fa-2x fa-fw"></i></a>
                            <a href="https://www.linkedin.com/company/kangaroo-cabs" rel="noreferrer" title="LinkedIn - CityTaXi" target="_blank"><i class="fab fa-linkedin-in fa-2x fa-fw"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mt-3 mt-md-0 text-md-left">
                        <h6 class="text-bold small">CityTaXi</h6>
                        <nav class="footer_menu">
                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="careers.html">Careers</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                            </ul>
                        </nav>

                    </div>
                    <div class="col-md-9 text-md-right letter-spacing-normal">
                        <h6 class="text-bold small">Hotlines</h6>
                        <div class="row" id="hotlines">


                            <div class="col-md">
                                <h6>WhatsApp/Viber</h6>
                                <p class="small text-bold letter-spacing-normal"><a href="https://wa.me/94729588588/" rel="noreferrer">+94 710 810 914</a></p>
                            </div>
                        </div>

                        <h6 class="text-bold small mt-4">General Inquiries</h6>
                        <div class="row" id="hotlines">
                            <div class="col-md-8">
                                <h6 class=" small">For custom packages</h6>
                                <p class="small text-bold letter-spacing-normal">tours@citytaxi.com</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-small">Telephone</h6>
                                <ul class="text-bold letter-spacing-normal">
                                    <li>+94 710 810 914</li>
                                    <li>+94 706 256 108</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 flex-column-reverse flex-md-row">
                    <div class="col-md-12 text-md-left">
                        <p class="small text-muted">Copyright &copy; 2024 | CityTaXi |
                        <div class="col-md-12 text-md-right text-muted mb-4 mb-md-auto">
                            <p class="small text-muted">Web by | <a href="https://deltadevelops.xyz/"> | Delta Develops |</a></p>
                        </div>
                    </div>
                </div>
        </footer>

        <!-- Error Modal -->
        <div class="modal fade error-modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning d-block">
                        <div class="text-center">
                            <i class="fas fa-exclamation-triangle "></i> <span class="text-bold">Warning</span>
                        </div>
                    </div>
                    <div class="modal-body text-center">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-small" data-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Modal -->
        <div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <i class="la la-times la-2x text-dark position-absolute p-3 text-right" style="right: 0" data-dismiss="modal"></i>
                    <div class="modal-header d-block">
                        <div class="text-center">
                            <h1 class="page-title text-center pt-4">Login</h1>
                            <h4 class="text-center h5">CityTaXi Miles</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p id="login-info" class="text-small text-center m-0 pt-3">Don't have an account? <a class="text-bold" href="miles-register/index.html">Register</a></p>
                        <form id="miles-login" class="roo-form ajax px-md-5 pt-3 pb-5" name="miles-login" data-popup="yes" data-scroll="no" data-function="miles-login" method="post" data-aftersuccess="" data-reset="yes" data-validation="yes">
                            <label>Username</label>
                            <input name="username" id="login-tel" type="text" autocomplete="off" required>
                            <input type="hidden" id="login-tel-countrycode" name="countrycode" value="" />
                            <label class="mt-2">Password</label>
                            <input name="password" placeholder="Password" type="password" required>
                            <a href="forgot-password/index.html" class="text-small d-block text-muted mt-3">Forgot your password?</a>
                            <div class="row mt-4">
                                <div class="offset-md-6 col-md-6">
                                    <button class="btn btn-sm w-100 btn-warning" type="submit" value="Login">Login <i class="la la-arrow-right"></i></button>
                                    <div class="spinner text-center mt-2"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- <a href="https://wa.me/94729588588" title="whatsapp chat" rel="noreferrer" target="_blank"><img src="resources/images/whatsapp.webp" title="whatapp chat link" alt="whatsapp chat link" class="whatsapp-chat" /></a> -->

        <script src="includes/js/bootstrap.bundle.min.js"></script>
        <!--<script src="js/datetimepicker.min.js"></script>-->

        <script src="template/js/intlTelInput-jquery.min.js" defer></script>
        <script src="template/js/jquery.lazy.min.js"></script>
        <script src="template/js/datepicker.min.js" defer></script>
        <script src="template/js/wickedpicker.min.js" defer></script>
        <script src="template/js/swiper.min.js"></script>


        <script>
            $(function() {
                $('.lazyload').Lazy();
            });
        </script>

        <script src="includes/js/footerfa5a.js?version=1706416645"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADpmZ0MmjHFJBrRGCicsA-TbYsJ3QaR2s&amp;channel=6&amp;libraries=places&amp;language=en-GB&amp;region=GB&amp;callback=kangaroo"></script>
        <script>
            var mySwiper = new Swiper('.slider1', {
                // Optional parameters
                slidesPerView: '4',
                direction: 'horizontal',
                loop: true,

                // If we need pagination
                pagination: {
                    el: '.vtype-pagination',
                    clickable: true,
                    /*renderBullet: function (index, className) {
                        //return '<span class="' + className + '">' + (menu[index]) + '</span>';
                        return '<img id="thumb-van" class="d-block mx-auto img-fluid ' + className + '" src="'+site_url+'resources/images/vtypes/' + (menu[index]) + '.png" />'
                    },*/
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-custom-next',
                    prevEl: '.swiper-custom-prev',
                },

                slidesPerView: 'auto',
                centeredSlides: true,
            });

            // var menu = ['budget', 'city','semi', 'car', 'minivan', 'van'];
            // var vtypenames = ['budget', 'city','semi', 'car', '9 Seater', '14 Seater'];

            var menu = ['expo', 'budget', 'city', 'semi', 'car', 'minivan', 'van'];
            var vtypenames = ['expo', 'budget', 'city', 'semi', 'car', '9 Seater', '14 Seater'];
            var fleetSlider = new Swiper('.slider2', {
                slidesPerView: 'auto',
                direction: 'horizontal',
                loop: true,
                centeredSlides: true,
                pagination: {
                    el: '.fleet-pagination',
                    clickable: true,
                    renderBullet: function(index, className) {
                        return '<div class="col px-1 d-block ' + className + '"><img id="fleet-thumb" style="width: 80%;" class="img-fluid mx-auto d-block lazyload" data-src="' + site_url + 'resources/images/vtypes/' + (menu[index]) + '.svg" alt="' + (menu[index]) + '" title="' + (menu[index]) + '" /><div class="text-center mt-1 mb-2">' + (vtypenames[index]).toUpperCase() + '</div></div>'
                    },
                },
            });
        </script>
        <script>
            if (debug) {
                console.log('v1.7.0.017');
            }
        </script>
        <script>
            $("#btn_logout").click(function() {
                $.ajax({
                    url: '<?php echo base_url(); ?>auth/logout',
                    type: 'GET',
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                text: 'Logout successful!',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout(function() {
                                window.location.href = '<?php echo base_url(); ?>auth/signin';
                            }, 1000);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        </script>
</body>

</html>