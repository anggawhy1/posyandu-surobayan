<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->get('/', 'BerandaController::index');
$routes->get('beranda', 'BerandaController::index');

// // Dokumentasi
$routes->get('/dokumentasi', 'Dokumentasi::index');
$routes->get('/admin/dokumentasi', 'Dokumentasi::admin');
$routes->post('/admin/dokumentasi/store', 'Dokumentasi::store');
$routes->post('/admin/dokumentasi/delete/(:num)', 'Dokumentasi::delete/$1');
$routes->get('/admin/dokumentasi/create', 'Dokumentasi::create');
$routes->get('/admin/dokumentasi/edit/(:num)', 'Dokumentasi::edit/$1');
$routes->post('/admin/dokumentasi/update/(:num)', 'Dokumentasi::update/$1');



// Halaman Umum
// $routes->get('/jadwal', 'Home::jadwal');
$routes->get('/jadwal', 'Jadwal::index'); // Halaman user
$routes->get('/admin/jadwal', 'Jadwal::admin'); // Halaman admin
$routes->get('/admin/jadwal/create', 'Jadwal::create'); // Form tambah jadwal
$routes->post('/admin/jadwal/store', 'Jadwal::store'); // Proses tambah jadwal
$routes->post('/admin/jadwal/delete/(:num)', 'Jadwal::delete/$1'); // Hapus jadwal berdasarkan ID


$routes->get('/input-data', 'InputData::index');
$routes->get('/data-balita', 'DataBalita::index');


$routes->get('/data-remaja', 'DataRemaja::index');
$routes->get('search-remaja-putri', 'RemajaPutriController::search');
$routes->get('get-all-remaja-putri', 'RemajaPutriController::getAllRemajaPutri');


$routes->get('/data-ibu-hamil', 'DataIbuHamil::index');
$routes->post('arsipkan-ibu-hamil', 'IbuHamilController::arsipkanIbuHamil');
$routes->post('hapus-ibu-hamil', 'IbuHamilController::hapus');
$routes->get('tambah-ibu-hamil', 'IbuHamilController::tambah');
$routes->post('simpan-ibu-hamil', 'IbuHamilController::simpan');
$routes->post('update-ibu-hamil', 'IbuHamilController::updateData');
// $routes->post('update-ibu-hamil', 'IbuHamilController::updateIbuHamil');
// $routes->get('search-ibu-hamil', 'IbuHamilController::searchIbuHamil');






$routes->get('/data-usia-produktif', 'Home::dataUsiaProduktif');
$routes->get('/kontak', 'Home::kontak');
// $routes->get('/login', 'Home::login');
// $routes->post('/login', 'AuthController::login'); // Menangani form login
$routes->get('/login', 'AuthController::login'); // Halaman login
$routes->post('/login', 'AuthController::doLogin'); // Proses login
$routes->get('/logout', 'AuthController::logout'); // Halaman logout




// Admin Dashboard
// $routes->get('/admin/dashboard', 'AdminController::index');
$routes->get('/admin/dashboard', 'Dashboard::index');

$routes->get('/admin/statistik', 'AdminController::statistik');
$routes->get('/admin/dokumentasi', 'AdminController::dokumentasi');
$routes->get('/admin/keluar', 'AuthController::logout'); // Logout

// Kelola Data Admin
$routes->get('/admin/data-balita', 'BalitaController::index');
$routes->post('admin/databalita/update', 'BalitaController::update');
$routes->post('admin/databalita/hapus', 'BalitaController::hapus');
$routes->post('admin/databalita/arsipkan', 'BalitaController::arsipkan');
$routes->get('admin/databalita/search', 'BalitaController::search');
$routes->get('admin/databalita/tambah', 'BalitaController::tambah');
$routes->post('admin/databalita/simpan', 'BalitaController::simpan');



$routes->get('/admin/data-lansia', 'LansiaController::index');
$routes->get('search-lansia', 'LansiaController::search');
$routes->post('/admin/lansia/update', 'LansiaController::update');
$routes->post('/admin/lansia/arsipkan', 'Lansia::arsipkan');
$routes->post('admin/lansia/arsipkan/(:num)', 'LansiaController::arsipkan/$1');
$routes->delete('/admin/lansia/hapus/(:num)', 'LansiaController::hapus/$1');
$routes->get('/admin/tambah-lansia', 'LansiaController::tambah');
$routes->post('/admin/lansia/simpan', 'LansiaController::simpan');


$routes->get('/admin/data-ibu-hamil', 'IbuHamilController::index');


$routes->get('/admin/data-remaja-putri', 'RemajaPutriController::index');
$routes->get('/admin/remajaputri/search', 'RemajaPutriController::search');
$routes->get('/admin/remajaputri/tambah', 'RemajaPutriController::tambah');
$routes->post('/admin/remajaputri/simpan', 'RemajaPutriController::simpan');
$routes->post('/admin/remajaputri/update', 'RemajaPutriController::update');
$routes->post('/admin/remajaputri/arsipkan', 'RemajaPutriController::arsipkan');
$routes->post('/admin/remajaputri/delete/(:num)', 'RemajaPutriController::delete/$1');
$routes->post('/admin/remajaputri/hapus', 'RemajaPutriController::hapus');





$routes->get('/admin/data-usia-produktif', 'UsiaProduktifController::index');
$routes->get('search-usia-produktif', 'UsiaProduktifController::searchUsiaProduktif');
$routes->post('arsipkan-usia-produktif', 'UsiaProduktifController::arsipkan');
$routes->delete('hapus-usia-produktif/(:num)', 'UsiaProduktifController::hapus/$1');
$routes->post('update-usia-produktif', 'UsiaProduktifController::update');
$routes->get('/admin/tambah-usia-produktif', 'UsiaProduktifController::tambah');
$routes->post('/admin/usia-produktif/simpan', 'UsiaProduktifController::simpan');




// $routes->get('/admin/pemantauan-balita', 'AdminController::pemantauanBalita');
// $routes->get('/admin/data-ibu-hamil', 'AdminController::dataIbuHamil');
// $routes->get('/admin/data-remaja', 'AdminController::dataRemajaPutri');
// $routes->get('/admin/data-produktif', 'AdminController::dataUsiaProduktif');
// $routes->get('/admin/data-baru', 'AdminController::dataBaru');
// $routes->get('/admin/riwayat-data', 'AdminController::riwayatData');
// $routes->get('/admin/jadwal', 'AdminController::jadwal');

// Store Data
$routes->post('/data-remaja/store', 'DataRemaja::store');
$routes->post('/data-balita/store', 'DataBalita::store');
$routes->post('/data-ibu-hamil/store', 'DataIbuHamil::store');

// Pengujian Database
$routes->get('home/testDB', 'Home::testDB');

// // Data Lansia & Ibu Hamil (Controller Khusus)

$routes->get('/admin/data_ibu_hamil', 'IbuHamilController::index');











// $routes->get('admin/pemantauan-balita', 'PemantauanController::index');  // Untuk menampilkan data pemantauan balita
// $routes->get('admin/pemantauan-balita/tambahBulan/(:num)', 'PemantauanController::tambahBulan/$1');  // Untuk menambah bulan baru
// $routes->post('admin/pemantauan-balita/updateData/(:num)', 'PemantauanController::updateData/$1');  // Untuk update data pemantauan balita
// $routes->get('admin/pemantauan-balita/hapusData/(:num)', 'PemantauanController::hapusData/$1');  // Untuk hapus data pemantauan balita

// $routes->get('admin/pemantauan-balita', 'PemantauanController::index');
// $routes->post('admin/pemantauan-balita/tambah-bulan/(:num)', 'PemantauanController::tambahBulan/$1');
// $routes->post('admin/pemantauan-balita/update/(:num)', 'PemantauanController::updateData/$1');
// $routes->post('admin/pemantauan-balita/hapus/(:num)', 'PemantauanController::hapusData/$1');

$routes->get('admin/pemantauan-balita', 'PemantauanController::index');
$routes->get('admin/pemantauan-balita/tambah-bulan', 'PemantauanController::tambahBulan');
$routes->post('admin/pemantauan-balita/update', 'PemantauanController::update');
$routes->get('admin/pemantauan-balita/hapus-bulan/(:segment)', 'PemantauanController::hapusBulan/$1');



// DATA BARU BALITA
$routes->get('/admin/data-baru', 'DataBaruController::index');
$routes->get('/admin/data-baru-balita', 'DataBaruBalitaController::balita');
$routes->post('data-baru/balita/konfirmasi', 'DataBaruBalitaController::konfirmasiBalita');
$routes->post('admin/data-baru-balita/update', 'DataBaruBalitaController::update'); 
$routes->post('admin/data-baru-balita/konfirmasi/(:num)', 'DataBaruBalitaController::konfirmasi/$1');
$routes->delete('admin/data-baru-balita/hapus/(:num)', 'DataBaruBalitaController::hapus/$1');

// DATA BARU REMAJA PUTRI
$routes->get('/admin/data-baru-remaja', 'DataBaruRemajaController::remaja');
$routes->post('data-baru/remaja/konfirmasi', 'DataBaruRemajaController::konfirmasiRemaja');
$routes->post('admin/data-baru-remaja/update', 'DataBaruRemajaController::update'); 
$routes->post('admin/data-baru-remaja/konfirmasi/(:num)', 'DataBaruRemajaController::konfirmasi/$1');
$routes->delete('admin/data-baru-remaja/hapus/(:num)', 'DataBaruRemajaController::hapus/$1');

// Routes untuk Data Baru Ibu Hamil
$routes->get('/admin/data-baru-ibu-hamil', 'DataBaruIbuHamilController::ibuHamil');
$routes->post('data-baru/ibu-hamil/konfirmasi', 'DataBaruIbuHamilController::konfirmasiIbuHamil');
$routes->post('admin/data-baru-ibu-hamil/update', 'DataBaruIbuHamilController::update'); 
$routes->post('admin/data-baru-ibu-hamil/konfirmasi/(:num)', 'DataBaruIbuHamilController::konfirmasi/$1');
$routes->delete('admin/data-baru-ibu-hamil/hapus/(:num)', 'DataBaruIbuHamilController::hapus/$1');



// DATA BARU BALITA
$routes->get('/admin/riwayat-data', 'DataArsipController::index');
$routes->get('admin/data-arsip-balita', 'DataArsipBalitaController::arsip'); 
$routes->post('admin/data-arsip-balita/konfirmasi/(:num)', 'DataArsipBalitaController::konfirmasi/$1');
$routes->delete('admin/data-arsip-balita/hapus/(:num)', 'DataArsipBalitaController::hapus/$1');

$routes->get('admin/data-arsip-ibu-hamil', 'DataArsipIbuHamilController::arsip'); 
$routes->post('admin/data-arsip-ibu-hamil/konfirmasi/(:num)', 'DataArsipIbuHamilController::konfirmasi/$1');
$routes->delete('admin/data-arsip-ibu-hamil/hapus/(:num)', 'DataArsipIbuHamilController::hapus/$1');

$routes->get('admin/data-arsip-remaja', 'DataArsipRemajaController::arsip'); 
$routes->post('admin/data-arsip-remaja/konfirmasi/(:num)', 'DataArsipRemajaController::konfirmasi/$1');
$routes->delete('admin/data-arsip-remaja/hapus/(:num)', 'DataArsipRemajaController::hapus/$1');

$routes->get('admin/data-arsip-lansia', 'DataArsipLansiaController::arsip'); 
$routes->post('admin/data-arsip-lansia/konfirmasi/(:num)', 'DataArsipLansiaController::konfirmasi/$1');
$routes->delete('admin/data-arsip-lansia/hapus/(:num)', 'DataArsipLansiaController::hapus/$1');

$routes->get('admin/data-arsip-usia-produktif', 'DataArsipUsiaProduktifController::arsip'); 
$routes->post('admin/data-arsip-usia-produktif/konfirmasi/(:num)', 'DataArsipUsiaProduktifController::konfirmasi/$1');
$routes->delete('admin/data-arsip-usia-produktif/hapus/(:num)', 'DataArsipUsiaProduktifController::hapus/$1');

// $routes->get('admin/riwayat-data', 'Admin\DataArsipController::riwayatData');
// $routes->get('admin/data-arsip-balita', 'Admin\DataArsipController::balita');
// $routes->get('admin/data-arsip-remaja', 'Admin\DataArsipController::remaja');
// $routes->get('admin/data-arsip-ibu-hamil', 'Admin\DataArsipController::ibuHamil');
// $routes->get('admin/data-arsip-usia-produktif', 'Admin\DataArsipController::usiaProduktif');
// $routes->get('admin/data-arsip-lansia', 'Admin\DataArsipController::lansia');

$routes->get('/', 'BerandaController::index');

$routes->get('/admin/data-jumlah-hadir', 'DataHadirController::index');
$routes->get('/admin/jumlah-balita-per-bulan', 'JumlahBalitaPerBulanController::index');
$routes->post('/admin/jumlah-balita-per-bulan/save', 'JumlahBalitaPerBulanController::save');
$routes->get('/admin/data-jumlah-hadir', 'DataHadirController::index');
$routes->get('/admin/jumlah-lansia-per-bulan', 'JumlahLansiaPerBulanController::index');
$routes->post('/admin/jumlah-lansia-per-bulan/save', 'JumlahLansiaPerBulanController::save');
$routes->get('/admin/data-jumlah-hadir', 'DataHadirController::index');
$routes->get('/admin/jumlah-remaja-per-bulan', 'JumlahRemajaPerBulanController::index');
$routes->post('/admin/jumlah-remaja-per-bulan/save', 'JumlahRemajaPerBulanController::save');