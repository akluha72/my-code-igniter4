<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'DashboardController::index');
$routes->get('/warehouses','WarehouseController::index');
$routes->get('/warehouses/create','WarehouseController::create');
$routes->post('/warehouses/store','WarehouseController::store');
$routes->get('/warehouses/edit/(:num)','WarehouseController::edit/$1');
$routes->post('/warehouses/update/(:num)','WarehouseController::update/$1');
$routes->post('/warehouses/delete/(:num)','WarehouseController::delete/$1');

$routes->get('/products','ProductController::index');
$routes->get('/products/create','ProductController::create');
$routes->post('/products/store','ProductController::store');
$routes->get('/products/edit/(:num)','ProductController::edit/$1');
$routes->post('/products/update/(:num)','ProductController::update/$1');
$routes->post('/products/delete/(:num)','ProductController::delete/$1');

$routes->get('/stocks','StockController::index');
$routes->get('/stocks/create', 'StockController::create');
$routes->post('/stocks/store','StockController::store');
$routes->get('/stocks/edit/(:num)', 'StockController::edit/$1');
$routes->post('/stocks/update/(:num)', 'StockController::update/$1');
$routes->post('/stocks/delete/(:num)', 'StockController::delete/$1');