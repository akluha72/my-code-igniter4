<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/','WarehouseController::index');
$routes->get('/warehouses/create','WarehouseController::create');
$routes->post('/warehouses/store','WarehouseController::store');

$routes->get('/products','ProductController::index');
$routes->get('/products/create','ProductController::create');
$routes->post('/products/store','ProductController::store');