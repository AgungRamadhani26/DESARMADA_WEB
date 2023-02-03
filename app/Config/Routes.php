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
$routes->get('/', 'Login::index', ['filter' => 'khususTamu']);
$routes->post('/login', 'Login::login');
$routes->get('/logout', 'Login::logout');


//Profile
$routes->get('/profile/lihat_profile', 'Profile::lihat_profile');
$routes->post('/profile/update_profile', 'Profile::update_profile');

//Routes dashboard
$routes->get('/dashboard/mobil', 'Dashboard::daftar_mobil'); //menampilkan dashboard dan daftar mobil
$routes->get('/dashboard/motor', 'Dashboard::daftar_motor');
$routes->get('/dashboard/mobil_keluar', 'Dashboard::mobil_keluar');
$routes->get('/dashboard/motor_keluar', 'Dashboard::motor_keluar');
$routes->get('/dashboard/generateQR/(:any)', 'Dashboard::generateQR/$1');

//Peminjaman
$routes->get('/peminjaman/history_peminjaman', 'Peminjaman::history_peminjaman');
$routes->get('/peminjaman/pinjam_kendaraan/(:num)', 'Peminjaman::pinjam_kendaraan/$1');


//Routes User
//Untuk menampilkan daftar user
$routes->get('/user/daftar_user', 'User::daftar_user');
//Untuk menambah user baru
$routes->post('/user/tambah_user', 'User::tambah_user');
//Untuk mengedit user
$routes->get('/user/edit_user/(:num)', 'User::edit_user/$1');
$routes->post('/user/update_user', 'User::update_user');
//Untuk menghapus user
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
//Untuk menampilkan daftar lokasi
$routes->get('/lokasi/daftar_lokasi', 'Lokasi::daftar_lokasi');
//Untuk menambah lokasi baru
$routes->post('/lokasi/tambah_lokasi', 'Lokasi::tambah_lokasi');
//Untuk mengedit lokasi
$routes->get('/lokasi/edit_lokasi/(:num)', 'Lokasi::edit_lokasi/$1');
$routes->post('/lokasi/update_lokasi', 'Lokasi::update_lokasi');
//Untuk menghapus lokasi
$routes->delete('/lokasi/delete_lokasi/(:num)', 'Lokasi::delete_lokasi/$1');

//Kendaraan
//Untuk menampilkan daftar Kendaraaan
$routes->get('/kendaraan/daftar_kendaraan', 'Kendaraan::daftar_kendaraan');
//Untuk menambah kendaraan baru
$routes->post('/kendaraan/tambah_kendaraan', 'Kendaraan::tambah_kendaraan');
//Untuk mengedit kendaraan
$routes->get('/kendaraan/edit_kendaraan/(:num)', 'Kendaraan::edit_kendaraan/$1');
$routes->post('/kendaraan/update_kendaraan', 'Kendaraan::update_kendaraan');
//Untuk menghapus kendaraan
$routes->delete('/kendaraan/delete_kendaraan/(:num)', 'Kendaraan::delete_kendaraan/$1');

//Laporan
$routes->get('/laporan/laporan_penggunaan', 'Laporan::laporan_penggunaan');

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
