<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/','WarehouseController::index');
$routes->get('/warehouses/create','WarehouseController::create');
$routes->post('/warehouses/store','WarehouseController::store');