<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Common Routes
$routes->get('/', 'Welcome::index');
$routes->post('GetLogin', 'Welcome::index');
$routes->get('blocked', 'Welcome::forbiddenPage');
$routes->get('register', 'Welcome::register');
$routes->post('register', 'Welcome::registration');
$routes->get('home', 'Home::index');

// Setting Routes
$routes->get('users/userRoleAccess', 'Users::userRoleAccess');
$routes->post('users/createRole', 'Users::createRole');
$routes->post('users/updateRole', 'Users::updateRole');
$routes->delete('users/deleteRole', 'Users::deleteRole');
$routes->post('users/createUser', 'Users::createUser');
$routes->post('users/updateUser', 'Users::updateUser');
$routes->delete('users/deleteUser', 'Users::deleteUser');
$routes->post('users/changeMenuPermission', 'Users::changeMenuPermission');
$routes->post('users/changeMenuCategoryPermission', 'Users::changeMenuCategoryPermission');
$routes->post('users/changeSubMenuPermission', 'Users::changeSubMenuPermission');

$routes->post('menuManagement/createMenuCategory', 'Developers\MenuManagement::createMenuCategory');
$routes->post('menuManagement/createMenu', 'Developers\MenuManagement::createMenu');
$routes->post('menuManagement/createSubMenu', 'Developers\MenuManagement::createSubMenu');

//Developer Routes
$routes->get('menuManagement', 'Developers\MenuManagement::index');
$routes->get('crudGenerator', 'Developers\CRUDGenerator::index');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
