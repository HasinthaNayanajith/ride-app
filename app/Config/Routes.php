<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('auth', static function ($routes) {
    // route = base_url/auth
    $routes->get('/', 'AuthController::signIn');
});
$routes->group('review', static function ($routes) {
    // route = base_url/review
    $routes->get('/', 'ReviewController::index');
    // route = base_url/review/create
    $routes->get('create', 'ReviewController::create');
});
