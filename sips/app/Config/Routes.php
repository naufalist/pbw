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
// $routes->setDefaultController('Home'); // default
$routes->setDefaultController('Login');
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
$routes->addRedirect('/', '/beranda');
$routes->get('/daftar', 'Auth::daftar');
$routes->post('/daftar', 'Auth::daftarProses');
$routes->get('/masuk', 'Auth::masuk', ['filter' => 'auth']);
$routes->post('/masuk', 'Auth::masukProses');
$routes->get('/keluar', 'Auth::keluar', ['filter' => 'auth']);
$routes->get('/lupa_katasandi', 'Auth::lupaKatasandi');
$routes->post('/lupa_katasandi', 'Auth::lupaKatasandiProses');

$routes->get('/beranda', 'Page::beranda', ['filter' => 'auth']);
$routes->get('/quiz', 'Quiz::index', ['filter' => 'auth']);
$routes->post('/quiz', 'Quiz::quiz', ['filter' => 'auth']);

// $routes->group('materi', ['filter' => 'auth'], function($routes) {
// 	$routes->get('/', 'Page::index');
// 	$routes->get('materi/add', 'Page::add');
// 	$routes->post('materi/store', 'Page::store');
// });

$routes->get('/mail', function() {
	return view('mail');
});

$routes->get('/hash', function() {
	$hash = password_hash("pass", PASSWORD_DEFAULT, ['cost' => 10]);
	return $hash." ".strlen($hash);
});

$routes->get('/verifikasi/(:segment)/(:num)/', 'Auth::verifikasi/$1/$2');
$routes->get('/ubah_katasandi/(:segment)/(:num)/', 'Auth::ubahKatasandi/$1/$2');
$routes->post('/ubah_katasandi', 'Auth::ubahKatasandiProses');
$routes->addRedirect('/verifikasi', '/beranda');
$routes->addRedirect('/verifikasi/(:any)/', '/beranda');
// mau pake addRedirect, kayaknya bentrok sama route post
$routes->get('/ubah_katasandi', function(){
	return redirect()->to('/beranda');
});
$routes->addRedirect('/ubah_katasandi/(:any)/', '/beranda');

// $routes->get('/ubah_katasandi', 'Auth::ubahKatasandi');

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
