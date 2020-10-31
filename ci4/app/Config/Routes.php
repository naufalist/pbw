<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Beranda::index');

/* Hobi */
$routes->get('/Hobi/add', 'Hobi::add');
$routes->get('/Hobi/edit/(:segment)', 'Hobi::edit/$1');
$routes->delete('/Hobi/(:num)', 'Hobi::delete/$1');
$routes->get('/Hobi/(:any)', 'Hobi::index');

/* Agama */
$routes->get('/Agama/add', 'Agama::add');
$routes->get('/Agama/edit/(:segment)', 'Agama::edit/$1');
$routes->delete('/Agama/(:num)', 'Agama::delete/$1');
$routes->get('/Agama/(:any)', 'Agama::index');

/* Mahasiswa */
$routes->get('/Mahasiswa/add', 'Mahasiswa::add');
$routes->get('/Mahasiswa/edit/(:segment)', 'Mahasiswa::edit/$1');
$routes->delete('/Mahasiswa/(:alphanum)', 'Mahasiswa::delete/$1');
$routes->get('/Mahasiswa/(:any)', 'Mahasiswa::detail/$1');


// $routes->get('/Mahasiswa', function(){
// 	echo "mahasiswa";
// });

// $routes->get('/', 'Mahasiswa::ucapan');

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
