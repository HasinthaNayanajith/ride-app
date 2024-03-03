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
    $routes->get('profile', 'AuthController::profile');
    $routes->post('update_profile', 'AuthController::update_profile');
    $routes->post('register_vehicle', 'AuthController::register_vehicle');
    $routes->post('update_vehicle', 'AuthController::update_vehicle');
});

$routes->group('review', static function ($routes) {
    // route = base_url/review
    $routes->get('/', 'ReviewController::index');
    // route = base_url/review/create
    $routes->post('create', 'ReviewController::create');
});

$routes->group('ride', static function ($routes) {
    // route = base_url/ride
    $routes->get('/', 'RideController::index');
    $routes->get('available', 'RideController::available');
    $routes->post('book', 'RideController::bookRide');
    $routes->get('view', 'RideController::viewRide');
});

$routes->group('payment', static function ($routes) {
    // route = base_url/payment
    $routes->get('/', 'PaymentController::index');
    $routes->post('create', 'PaymentController::create');
});

$routes->group('call_center', static function ($routes) {
    // route = base_url/call_center
    $routes->get('/', 'CallCenterController::index');
});
