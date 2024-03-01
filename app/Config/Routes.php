<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'HomeController::index');

$routes->group('auth', static function ($routes) {
    // route = base_url/auth
    $routes->get('signin', 'AuthController::signIn');
    $routes->get('signup', 'AuthController::signUp');
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('review', static function ($routes) {
    // route = base_url/review
    $routes->get('/', 'ReviewController::index');
    // route = base_url/review/create
    $routes->get('create', 'ReviewController::create');
});

$routes->group('ride', static function ($routes) {
    // route = base_url/ride
    $routes->get('/', 'RideController::index');
    $routes->get('available', 'RideController::available');
});

$routes->group('payment', static function ($routes) {
    // route = base_url/payment
    $routes->get('/', 'PaymentController::index');
    // route = base_url/review/create
    // $routes->get('create', 'ReviewController::create');
});
