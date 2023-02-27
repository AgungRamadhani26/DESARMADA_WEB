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
//Untuk menampilkan halaman login
$routes->get('/', 'Login::index', ['filter' => 'khususTamu']);
//Untuk melakukan login ke Aplikasi WEB-DESARMADA
$routes->post('/login', 'Login::login');
//Untuk melakukan logout dari Aplikasi WEB-DESARMADA
$routes->get('/logout', 'Login::logout');


//Profile
//Untuk menampilkan halaman profile
$routes->get('/profile/lihat_profile', 'Profile::lihat_profile');
//Untuk melakukan update profile
$routes->post('/profile/update_profile', 'Profile::update_profile');
//Untuk menampilkan halaman lupa password
$routes->get('/lupa_password', 'Profile::lupa_password');
//Untuk melakukan cek email
$routes->post('/lupa_password/cek_email', 'Profile::cek_email');
//Untuk menampilkan halaman reset password
$routes->get('/lupa_password/reset_password/(:any)', 'Profile::reset_password/$1');
//Untuk melakukan reset password
$routes->post('/lupa_password/save_reset_password/(:num)', 'Profile::save_reset_password/$1');

//Routes dashboard
//menampilkan dashboard dan daftar mobil
$routes->get('/dashboard/mobil', 'Dashboard::daftar_mobil');
//menampilkan dashboard dan daftar motor
$routes->get('/dashboard/motor', 'Dashboard::daftar_motor');
//menampilkan dashboard dan daftar mobil dipinjam
$routes->get('/dashboard/mobil_keluar', 'Dashboard::mobil_keluar');
//menampilkan dashboard dan daftar motor dipinjam
$routes->get('/dashboard/motor_keluar', 'Dashboard::motor_keluar');
//menampilkan QR Code
$routes->get('/dashboard/generateQR/(:any)', 'Dashboard::generateQR/$1');
//mencetak QR Code
$routes->get('/dashboard/printQR/(:any)', 'Dashboard::printQR/$1');

//Peminjaman
//Untuk menampilkan semua history peminjaman
$routes->get('/peminjaman/history_peminjaman', 'Peminjaman::history_peminjaman');
//Untuk menampilkan history peminjaman mobil
$routes->get('/peminjaman/history_peminjaman_mobil', 'Peminjaman::history_peminjaman_mobil');
//Untuk menampilkan history peminjaman motor
$routes->get('/peminjaman/history_peminjaman_motor', 'Peminjaman::history_peminjaman_motor');
//Untuk menampilkan form peminjaman kendaraan
$routes->get('/peminjaman/pinjam_kendaraan/(:num)', 'Peminjaman::pinjam_kendaraan/$1');
//Untuk menambahkan data peminjaman kendaraan
$routes->post('/peminjaman/add_pinjam/(:num)', 'Peminjaman::add_pinjam/$1');
//Untuk menampilkan form pengembalian kendaraan
$routes->get('/peminjaman/kembalikan_kendaraan/(:num)', 'Peminjaman::kembalikan_kendaraan/$1');
//Untuk menambahkan data pengembalian kendaraan
$routes->post('/peminjaman/add_pengembalian/(:num)', 'Peminjaman::add_pengembalian/$1');
//Untuk menghapus data peminjaman kendaraan
$routes->delete('/peminjaman/delete_peminjaman/(:num)', 'Peminjaman::delete_peminjaman/$1');
//Untuk menghapus data peminjaman kendaraan
$routes->delete('/peminjaman/delete_peminjamanMobil/(:num)', 'Peminjaman::delete_peminjamanMobil/$1');
//Untuk menghapus data peminjaman kendaraan
$routes->delete('/peminjaman/delete_peminjamanMotor/(:num)', 'Peminjaman::delete_peminjamanMotor/$1');

//Eksport ke Excel dan PDF
//Untuk eksport semua data peminjaman ke Excel
$routes->get('/peminjaman/eksport_all_exc', 'Peminjaman::eksport_all_exc');
//Untuk eksport data peminjaman mobil ke Excel
$routes->get('/peminjaman/eksport_mobil_exc', 'Peminjaman::eksport_mobil_exc');
//Untuk eksport data peminjaman motor ke Excel
$routes->get('/peminjaman/eksport_motor_exc', 'Peminjaman::eksport_motor_exc');
//Untuk eksport semua data peminjaman ke PDF
$routes->get('/peminjaman/eksport_all_pdf', 'Peminjaman::eksport_all_pdf');
//Untuk eksport data peminjaman mobil ke PDF
$routes->get('/peminjaman/eksport_mobil_pdf', 'Peminjaman::eksport_mobil_pdf');
//Untuk eksport data peminjaman motor ke PDF
$routes->get('/peminjaman/eksport_motor_pdf', 'Peminjaman::eksport_motor_pdf');


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
//Untuk menampilkan laporan
$routes->get('/laporan/laporan_penggunaan', 'Laporan::laporan_penggunaan');
//Untuk mencari laporan
$routes->get('/laporan/cari_laporan', 'Laporan::cari_laporan');

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
