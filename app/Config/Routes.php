<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// HOME
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/daftar', 'Home::daftar');
$routes->post('/auth/valid_daftar', 'Auth::valid_daftar');
$routes->post('/auth/valid_login', 'Auth::valid_login');
$routes->get('/lupapw', 'Home::lupaPw');
$routes->post('/auth/valid_lupapw', 'Auth::valid_lupaPw');
$routes->get('/auth/reset/(:any)', 'Auth::valid_resetPw/$1/$2');
$routes->post('/auth/valid_newpw', 'Auth::valid_newpw');
$routes->get('/logout', 'Auth::logout');

// USER
$routes->get('/home', 'User::home');
$routes->get('/create', 'User::create');
$routes->post('/create/save', 'User::savecreate');
$routes->get('/post/(:num)', 'User::post/$1');
$routes->post('/post/like/(:num)', 'User::like/$1');
$routes->post('/post/unlike/(:num)', 'User::unlike/$1');
$routes->post('/post/download/(:num)', 'User::downloadpost/$1');
$routes->post('/post/edit/(:num)', 'User::edit/$1');
$routes->post('/post/update/(:num)', 'User::updatepost/$1');
$routes->post('/post/delete/(:num)', 'User::delete/$1');
$routes->post('/komen/save/(:num)', 'User::komensave/$1');
$routes->post('/komen/delete/(:num)', 'User::komendelete/$1');
$routes->post('/album/create', 'User::createalbum');
$routes->get('/profile/(:num)', 'User::profile/$1');
$routes->get('/profilelike/(:num)', 'User::profilelike/$1');
$routes->get('/profilepost/(:num)', 'User::profilepost/$1');
$routes->get('/editprofile/(:num)', 'User::editprofile/$1');
$routes->post('/profile/update/(:num)', 'User::updateprofile/$1');
$routes->post('/album/saveto/(:num)', 'User::savetoalbum/$1');
$routes->post('/album/delfrom/(:num)', 'User::deletefromalbum/$1');
$routes->get('/album/(:num)', 'User::album/$1');
$routes->post('/album/update/(:num)', 'User::updatealbum/$1');
$routes->post('/album/delete/(:num)', 'User::deletealbum/$1');
$routes->post('/search', 'User::search');