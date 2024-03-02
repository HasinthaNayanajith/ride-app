<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityTaxi</title>

    <!-- css -->
    <link rel="stylesheet" href="<?= base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/bootstrap-icons.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="<?= base_url(); ?>css/tabs.css">
    <link rel="stylesheet" href="<?= base_url(); ?>css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- <script type="module" src="<?= base_url() ?>js/map.js"></script> -->
    <!-- js -->
    <script defer src="<?= base_url(); ?>js/bootstrap.bundle.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;700&amp;display=swap" rel="stylesheet">
    <title>CityTaXi</title>
    <meta name="description" content="You can go anywehere you want at anytime with CityTaXi.COM. Book a TukTuk, Budget Cars, SUVs & Vans.">
    <meta name="author" content="deltadevelops.xyz">
    <meta name="theme-color" content="#FDB940" />

    <link rel="alternate" hreflang="x-default" href="index.html" />

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

</head>

<body class="margin-top: 20px;">

    <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CityTaxi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>auth/profile">Profile</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php if (session()->get('user_id')) : ?>
                        <span class="email mt-1">Hi!&nbsp;<?php echo session()->get('name'); ?></span>
                        <button type="button" class="btn" id="btn_logout" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout"><i class="fa-solid fa-right-from-bracket fs-5"></i></button>
                    <?php else : ?>
                        <a href="<?php echo base_url('auth/signin'); ?>" class="btn">Sign In</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav> -->

    <nav class="navbar navbar-light fixed-top bg-white navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="/images/logo.svg" width="120" alt="CityTaXi.COM Logo">
            </a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-flex justify-content-between text-center text-md-left" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" id="home-page-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="#app">CityTaXi <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fleet">Our Fleet</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>auth/profile">Profile</a>
                    </li>
                </ul>
                <div>
                    <?php if (session()->get('user_id')) : ?>
                        <span class="email mt-1">Hi!&nbsp;<?php echo session()->get('name'); ?></span>
                        <button type="button" class="btn" id="btn_logout" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout"><i class="fa-solid fa-right-from-bracket fs-5"></i></button>
                    <?php else : ?>
                        <a href="<?php echo base_url('auth/signin'); ?>" class="btn">Sign In</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </nav>