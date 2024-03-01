<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// login dan logout
$routes->get('/', 'User::login');
$routes->post('/login', 'User::prosesLogin');
$routes->get('/logout', 'User::logout');
$routes->get('/data-user', 'User::dataUser');

// dashboard
$routes->get('/dashboard-admin', 'User::index');

$routes->get('/dashboard-admin', 'User::dashboard-admin');





//kategori

$routes->get('/data-kategori', 'Kategori::dataKategori');
$routes->post('/simpanKategori', 'Kategori::simpanKategori');
$routes->get('/tambahkategori', 'Kategori::tambahKategori');
$routes->post('/hapus-kategori/(:num)', 'Kategori::hapusKategori/$1');
$routes->get('/edit-kategori/(:num)', 'Kategori::editKategori/$1');
$routes->post('/updatekategori', 'Kategori::Updatekategori');
$routes->get('/cek-kategori-digunakan/(:segment)', 'Kategori::cek_keterkaitan_data/$1');

// satuan
$routes->get('/data-produk', 'Produk::dataProduk');
$routes->post('/simpan-satuan', 'Satuan::simpanSatuan');
$routes->get('/tambahsatuan', 'Satuan::tambahSatuan');
$routes->get('/data-satuan', 'Satuan::dataSatuan');
$routes->post('/hapus-satuan/(:num)', 'Satuan::hapusSatuan/$1');
$routes->get('/edit-satuan/(:num)', 'Satuan::editSatuan/$1');
$routes->post('/updatesatuan', 'Satuan::Updatesatuan');
$routes->get('/cek-satuan-digunakan/(:segment)', 'Satuan::cek_keterkaitan_data/$1');

// produk
$routes->get('/data-satuan', 'Satuan::dataSatuan');
$routes->post('/simpan-produk', 'Produk::simpanProduk');
$routes->get('/tambah-produk', 'Produk::tambahProduk');
$routes->get('/hapus-produk/(:num)', 'Produk::hapusProduk/$1');
$routes->get('/edit-produk/(:num)', 'Produk::editProduk/$1');
$routes->post('/updateproduk', 'Produk::UpdateProduk');
$routes->delete('/produk/(:num)', 'Produk::delete/$1');

// user
$routes->post('/simpan-user', 'User::simpanUser');
$routes->get('/tambah-user', 'User::tambahUser');
$routes->post('/hapus-user/(:num)', 'User::hapusUser/$1');
$routes->get('/edit-user/(:num)', 'User::editUser/$1');
$routes->post('/update-user', 'User::updateuser');

// penjualan
$routes->get('/transaksi-penjualan','Penjualan::index');
$routes->post('/transaksi-penjualan','Penjualan::simpanPenjualan');
$routes->get('/pembayaran','Penjualan::simpanPembayaran');






//laporan
$routes->get('/laporan', 'Laporan::dataLaporan');
$routes->get('/laporan', 'Laporan::dataLaporanPenjualan');


//cetak
$routes->get('/pdf', 'PdfController::index');
$routes->get('/pdf/generate', 'PdfController::generate');

$routes->get('/pdf', 'PdfController::index');
$routes->get('/pdf/generate-penjualan', 'PdfController::generatePenjualan');


