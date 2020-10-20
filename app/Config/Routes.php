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
$routes->get('/', 'Auth::index');
// $routes->get('/', 'Login::login');
// $routes->get('/client', 'Owner::index');
$routes->get('/myfairs', 'Owner::fairsView');
$routes->get('/mybooth/(:num)', 'Booths::index/$1');
$routes->get('/images/(:num)', 'Booths::imgGallery/$1');
$routes->get('/videos/(:num)', 'Booths::vidGallery/$1');
$routes->get('/files/(:any)', 'Booths::displayDownloadables/$1');
$routes->get('/company/(:num)', 'Companies::companyData/$1');

$routes->group('company', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('editcompany/(:num)', 'Companies::editBasic/$1');
	$routes->get('profiles/(:num)', 'Companies::editProfiles/$1');
	$routes->get('social/(:num)', 'Companies::editSocial/$1');
	$routes->get('contacts/(:num)', 'Companies::editContact/$1');
	$routes->get('external/(:num)', 'Companies::editLinks/$1');
	$routes->post('updateBasicData', 'Companies::updateBasicData');
	$routes->post('uploadLogo', 'Companies::uploadLogo');
	$routes->post('updateSocial', 'Companies::updateSocial');
	$routes->post('addContact', 'Companies::addContact');
	$routes->post('newLink', 'Companies::newLink');
	$routes->post('updateLink', 'Companies::updateLink');
	$routes->post('updateContact', 'Companies::updateContact');
	// $routes->post('deleteContact/(:num)/(:num)', 'Companies::deleteContact/$1/$2');
	// $routes->post('deleteLink/(:num)/(:num)', 'Companies::deleteLink/$1/$2');
});

$routes->group('admin', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Admin::index');
	$routes->get('/blank', 'Admin::blank');
});

$routes->group('owner', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Owner::index');
	// $routes->get('/myfairs', 'Owner::fairsView');
});

$routes->group('CrudFairs', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/fairs', 'CrudFairs::fairs');
});

$routes->group('CrudPavilions', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/pavilions', 'CrudPavilions::pavilions');
});

$routes->group('CrudBooths', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/booths', 'CrudBooths::booths');
});

$routes->group('booths', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/booths', 'Booths::booths');
	$routes->get('/myPdfPage/(:num)', 'Booths::myPdfPage/$1');
	$routes->get('/downloadImg/(:num)', 'Booths::downloadFile/$1');
});

$routes->group('CrudCompanies', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/companies', 'CrudCompanies::companies');
});


$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->add('login', 'Auth::login');
	$routes->get('logout', 'Auth::logout');
	// $routes->add('forgot_password', 'Auth::forgot_password');
	$routes->add('create_user', 'Auth::create_user');
	$routes->add('edit_user/(:num)', 'Auth::edit_user/$1');
	$routes->add('create_group', 'Auth::create_group');
	$routes->get('activate/(:num)', 'Auth::activate/$1');
	$routes->get('activate/(:num)/(:hash)', 'Auth::activate/$1/$2');
	$routes->add('deactivate/(:num)', 'Auth::deactivate/$1');
	$routes->get('reset_password/(:hash)', 'Auth::reset_password/$1');
	$routes->post('reset_password/(:hash)', 'Auth::reset_password/$1');
	// ...
});

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
