<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/product', 'Home::product');
$routes->get('/table', 'Home::table');

$routes->get('/', 'SignupCon::index');
$routes->get('/register', 'SignupCon::index');
$routes->match(['get', 'post'], 'SignupCon/store', 'SignupCon::store');
$routes->match(['get', 'post'], 'SigninCon/loginAuth', 'SigninCon::loginAuth');
$routes->get('/login', 'SigninCon::index');
$routes->get('/logout', 'SigninCon::logout');
$routes->get('/dashboard', 'SigninCon::profile');
$routes->get('/profile', 'SigninCon::table');
$routes->get('/edit-profile', 'Profile::edit');
$routes->post('/update-profile', 'Profile::update');


$routes->get('/login-history', 'LoginHistoryController::index');
$routes->post('/login-history/create', 'LoginHistoryController::create');
$routes->post('/login-history/update/(:num)', 'LoginHistoryController::update/$1');
$routes->get('/login-history/delete/(:num)', 'LoginHistoryController::delete/$1');
$routes->delete('/login-history/delete/(:num)', 'LoginHistoryController::delete/$1');

?>