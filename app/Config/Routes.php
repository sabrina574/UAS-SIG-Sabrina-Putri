<?php
namespace Config;
$routes = Services::routes();
$routes->setDefaultNamespace('App\Controllers');

// controller default yang dipanggil 
// pertama kali saat aplikasi dijalankan
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// routing URL Controller Dashboard
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('getdata', 'Dashboard::getdata');

// routing URL Controller Kecamatan
$routes->get('kecamatan','Kecamatan::index');
$routes->get('tambahkecamatan','Kecamatan::tambah');
$routes->get('editkecamatan/(:num)','Kecamatan::edit/$1');
$routes->get('hapuskecamatan/(:num)','Kecamatan::hapus/$1');
$routes->post('simpankecamatan','Kecamatan::simpan');
$routes->post('updatekecamatan','Kecamatan::update');

// routing URL Controller apotik
$routes->get('apotik','Apotik::index');
$routes->get('tambahapotik','Apotik::tambah');
$routes->get('editapotik/(:num)','Apotik::edit/$1');
$routes->get('hapusapotik/(:num)','Apotik::hapus/$1');
$routes->post('simpanapotik','Apotik::simpan');
$routes->post('updateapotik','Apotik::update');
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
 require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
?>