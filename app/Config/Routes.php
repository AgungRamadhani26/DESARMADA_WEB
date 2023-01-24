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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Root
$routes->get('/', 'Home::index');

//User
$routes->get('/user/daftar_user', 'User::daftar_user');
$routes->post('/user/tambah_user', 'User::tambah_user');
$routes->get('/user/edit_user/(:num)', 'User::edit_user/$1');
$routes->post('/user/update_user', 'User::update_user');
$routes->delete('/user/delete_user/(:num)', 'User::delete_user/$1');

//Routes Driver
//Untuk menampilkan daftar driver
$routes->get('/driver/daftar_driver', 'Driver::daftar_driver');
//Untuk menambah driver baru
$routes->post('/driver/tambah_driver', 'Driver::tambah_driver');
//Untuk mengedit driver
$routes->get('/driver/edit_driver/(:num)', 'Driver::edit_driver/$1');
$routes->post('/driver/update_driver', 'Driver::update_driver');
//Untuk menghapus driver
$routes->delete('/driver/delete_driver/(:num)', 'Driver::delete_driver/$1');

//Routes Lokasi
$routes->get('/lokasi/daftar_lokasi', 'Lokasi::daftar_lokasi');
$routes->post('/lokasi/tambah_lokasi', 'Lokasi::tambah_lokasi');
$routes->get('/lokasi/edit_lokasi/(:num)', 'Lokasi::edit_lokasi/$1');
$routes->post('/lokasi/update_lokasi', 'Lokasi::update_lokasi');
$routes->delete('/lokasi/delete_lokasi/(:num)', 'Lokasi::delete_lokasi/$1');

//Kendaraan
$routes->get('/kendaraan/daftar_kendaraan', 'Kendaraan::daftar_kendaraan');
$routes->post('/kendaraan/tambah_kendaraan/', 'Kendaraan::tambah_kendaraan');


//Peminjaman
$routes->get('/peminjaman/history_peminjaman', 'Peminjaman::history_peminjaman');

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
