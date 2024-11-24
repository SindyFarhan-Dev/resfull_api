<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); // Home page route

// Registrasi route
$routes->get('/registrasi', 'RegistrasiController::index'); // Display the registration form
$routes->post('/registrasi', 'RegistrasiController::registrasi'); // Handle form submission

// Login route
$routes->post('/login', 'LoginController::login');

// Produk routes
$routes->group('produk', function ($routes) {
    $routes->post('/', 'ProdukController::create'); // Create new product
    $routes->get('/', 'ProdukController::list'); // List all products
    $routes->get('(:segment)', 'ProdukController::detail/$1'); // View product details
    $routes->put('(:segment)', 'ProdukController::ubah/$1'); // Update product
    $routes->delete('(:segment)', 'ProdukController::hapus/$1'); // Delete product
});

// Order routes
$routes->get('/orders', 'OrderController::index'); // List orders
$routes->get('/orders/show/(:num)', 'OrderController::show/$1'); // View specific order
$routes->post('/orders/create', 'OrderController::create'); // Create new order
$routes->post('/orders/updateStatus/(:num)', 'OrderController::updateStatus/$1'); // Update order status
