<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
 use App\Controllers\ApiController;
$routes->group('api', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->post('insert', 'ApiController::insertData');
});

$routes->get('/', 'Home::index');
use App\Controllers\Blog_controller;

$routes->get('/home', [Blog_controller::class, 'index']);
$routes->get('/aboutus', [Blog_controller::class, 'about']);
$routes->get('/users', [Blog_controller::class, 'user_table']);
$routes->get('/users_list', [Blog_controller::class, 'users_list']);
$routes->get('/customdata', [Blog_controller::class, 'customdata']);
$routes->get('/testemail', [Blog_controller::class, 'testemail']);
$routes->get('/testhelper', [Blog_controller::class, 'testhelper']);
$routes->get('/formsubmit', [Blog_controller::class, 'formsubmit']);

use App\Controllers\About;
$routes->get('/about-us', [About::class, 'index']);


use App\Controllers\Register;
$routes->match(['get', 'post'], 'register', 'Register::register');
$routes->add('activate', 'Register::activate');
$routes->add('activate/(:any)', 'Register::activate/$1');


use App\Controllers\Login;
$routes->add('/login', 'Login::login');
$routes->add('/forgot-password', 'Login::forgot_password');
$routes->get('reset-password', 'Login::reset_password');
//$routes->get('reset-password/(:any)', 'Login::reset_password/$1');
$routes->match(['get', 'post'], 'reset-password/(:any)', 'Login::reset_password/$1');
use App\Controllers\Dashboard;
$routes->add('/dashboard', 'Dashboard::index');
$routes->add('/logout', 'Dashboard::logout');
$routes->add('/login-activity', 'Dashboard::login_activity');
$routes->add('/change-avatar', 'Dashboard::change_avatar');
$routes->add('/change-password', 'Dashboard::change_password');

use App\Controllers\Chat;
//$routes->add('/chatview', 'Chat::index');
$routes->add('/chat-login', 'Chat::chat_login');
$routes->add('/chat-space', 'Chat::index');
$routes->add('/logout-chat', 'Chat::logout_chat');
$routes->match(['get', 'post'], '/savechat', 'Chat::savechat');
$routes->match(['get', 'post'], '/fetchchat', 'Chat::fetchchat');

use App\Controllers\ChatWebSocket;
$routes->get('websocket', 'ChatWebSocket::index');


use App\Controllers\CustomerController;
$routes->get('/customer', 'CustomerController::index');
//$routes->get('/', 'Home::index');
//$routes->get('/customer', 'CustomerController::index');
//$routes->get('/customer/index', 'CustomerController::index');
//$routes->get('/customer/form', 'CustomerController::index');
//$routes->get('/customer/edit/(:num)', 'CustomerController::index');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
