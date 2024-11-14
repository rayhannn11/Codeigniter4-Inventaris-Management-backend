<?php

use App\Controllers\Users;
use App\Controllers\Categories;
use App\Controllers\Products;
use App\Controllers\Stock;
use App\Controllers\ImageController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes for user authentication
$routes->post('/user/register', 'Users::register'); // Register user
$routes->post('/user/login', 'Users::login');       // Login user and get token
$routes->get('/user/admin-count', 'Users::getAdminCount');       // get AdminCount


// Resource routes for categories, products, and stock
$routes->resource('category', ['controller' => 'Categories']); // CRUD kategori
$routes->post('category/update/(:num)', 'Categories::change/$1');
$routes->resource('product', ['controller' => 'Products']);     // CRUD produk
$routes->post('product/update/(:num)', 'Products::change/$1');
$routes->resource('stock', ['controller' => 'Stock']);          // CRUD stok
$routes->post('stock/update/(:num)', 'Stock::change/$1');


$routes->add('products/(:any)', function ($filename) {
    return file_get_contents(FCPATH . 'products/' . $filename);
});


// Uncomment the following line to enable Laporan routes
// $routes->resource('laporan', ['controller' => 'LaporanController']); // CRUD laporan (uncomment when needed)
