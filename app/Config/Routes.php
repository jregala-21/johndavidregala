<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/product', 'Home::product');
// $routes->get('/table', 'Home::table');




//register
$routes->get('/', 'SignupCon::index');
$routes->post('/register', 'SignupCon::store');

//login & logout
$routes->get('/login', 'SigninCon::index');
$routes->post('/login', 'SigninCon::loginAuth');
$routes->get('/logout', 'SigninCon::logout');

//forgot pass
$routes->get('/password_reset_request', 'SigninCon::requestPasswordReset'); // Show password reset request form
$routes->post('/password_reset_request', 'SigninCon::sendPasswordResetLink'); // Send reset link
$routes->get('/reset_password/(:any)', 'SigninCon::resetPasswordForm/$1'); // Show the reset password form (with token)
$routes->post('/reset_password', 'SigninCon::resetPassword'); // Handle the password reset




//edit profile
$routes->get('/dashboard', 'SigninCon::profile');
$routes->get('/profile', 'SigninCon::table');
$routes->get('/edit-profile', 'Profile::edit');
$routes->post('/update-profile', 'Profile::update');



//login history
$routes->get('/login-history', 'LoginHistoryController::index');
$routes->post('/login-history/create', 'LoginHistoryController::create');
$routes->post('/login-history/update/(:num)', 'LoginHistoryController::update/$1');
$routes->get('/login-history/delete/(:num)', 'LoginHistoryController::delete/$1');
$routes->delete('/login-history/delete/(:num)', 'LoginHistoryController::delete/$1');

?>