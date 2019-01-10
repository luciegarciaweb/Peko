<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * Authentification
 */
Auth::routes();

/**
 * Routes pour le site
 */
Route::get('/', 'HomeController@index')->name('home');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', 'ProductsController@index')->name('index');
    Route::get('/category/{category}', 'ProductsController@category')->name('index.category');
    Route::get('/variety/{variety}', 'ProductsController@variety')->name('index.variety');
    Route::get('/{product}', 'ProductsController@show')->name('show');
});

Route::prefix('parameters')->name('parameters.')->group(function () {
    Route::get('/', 'ParametersController@edit')->name('edit');
    Route::post('/', 'ParametersController@update')->name('update');
    Route::get('/passwords', 'ParametersController@passwordsEdit')->name('passwords.edit');
    Route::put('/passwords', 'ParametersController@passwordsUpdate')->name('passwords.update');
    Route::get('/pro', 'ParametersController@proCreate')->name('pro.create');
    Route::post('/pro', 'ParametersController@proStore')->name('pro.store');
});

Route::get('/addresses', 'AddressesController@index')->name('addresses.index');
Route::post('/addresses', 'AddressesController@update')->name('addresses.update');

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/create/{key}', 'OrdersController@create')->name('create');
    Route::get('/success/{key}', 'OrdersController@success')->name('success');
    Route::get('/current', 'OrdersController@index')->name('current');
    Route::get('/history', 'OrdersController@index')->name('history');
});

Route::get('/pages/{page}', 'PagesController@show')->name('pages.show');

Route::get('/contact', 'ContactsController@create')->name('contacts.create');
Route::post('/contact/store', 'ContactsController@store')->name('contacts.store');

Route::post('/subscribe', 'NewslettersController@store')->name('newsletters.store');

Route::get('/search', 'ProductsController@search')->name('search');

Route::prefix('carts')->name('carts.')->group(function () {
    Route::get('/', 'CartsController@index')->name('index');
    Route::post('/{product}/add', 'CartsController@add')->name('add');
    Route::get('/{CartProduct}/remove', 'CartsController@remove')->name('remove');
    Route::get('/{CartProduct}/decrement', 'CartsController@decrement')->name('decrement');
    Route::get('/{CartProduct}/increment', 'CartsController@increment')->name('increment');
    Route::post('/proceed', 'CartsController@proceed')->name('proceed');
});

Route::get('/carts/proceed', 'CartsController@getProceed');

/**
 * Routes pour l'administration.
 * Requier le rôle "admin" pour accéder à ces routes.
 * Prefix: /admin
 * Namespace: App\Http\Controllers\Admin;
 * Middleware: IsAdmin
 * Name:: admin
 */
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('IsAdmin')
    ->name('admin.')
    ->group(function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/users/{user}/active', 'UsersController@setActive')->name('users.active');
    Route::get('/users/{user}/admin', 'UsersController@setAdmin')->name('users.admin');
    Route::get('/users/pro', 'UsersController@pro')->name('users.pro');
    Route::get('/users/pro/new', 'UsersController@newPro')->name('users.new.pro');

    Route::get('/users/{user}/pro/accept', 'UsersController@acceptPro')->name('users.pro.accept');
    Route::get('/users/{user}/pro/refuse', 'UsersController@refusePro')->name('users.pro.refuse');

    Route::get('/pages/{page}/active', 'PagesController@setStatus')->name('pages.active');
        
    Route::get('/sliders/{slider}/active', 'SlidersController@setStatus')->name('sliders.active');

    Route::post('/contacts/{contact}/answer', 'ContactsController@answer')->name('contacts.answer');
    
    Route::get('/products/{product}/star', 'ProductsController@pushForward')->name('products.star');
    Route::get('/products/{product}/active', 'ProductsController@setStatus')->name('products.active');

    Route::get('/varieties/{category}/create', 'VarietiesController@create')->name('varieties.create');
    Route::post('/varieties/{category}/create', 'VarietiesController@store')->name('varieties.store');
    Route::get('/varieties/{variety}/edit', 'VarietiesController@edit')->name('varieties.edit');
    Route::post('/varieties/{variety}/edit', 'VarietiesController@update')->name('varieties.update');
    Route::delete('/varieties/{variety}', 'VarietiesController@destroy')->name('varieties.delete');

    Route::get('/orders/{order}/progress', 'OrdersController@inProgress')->name('orders.progress');
    Route::get('/orders/{order}/completed', 'OrdersController@isCompleted')->name('orders.completed');
    Route::get('/orders/{order}/ready', 'OrdersController@isReady')->name('orders.ready');
    Route::get('/orders/{order}/cancel', 'OrdersController@isCanceled')->name('orders.canceled');

    Route::get('/orders/completed', 'OrdersController@indexCompleted')->name('orders.index.completed');

    Route::resources([
        'users' => 'UsersController',
        'products' => 'ProductsController',
        'sliders' => 'SlidersController',
        'pages' => 'PagesController',
        'categories' => 'CategoriesController',
        'labels' => 'LabelsController',
        'newsletters' => 'NewslettersController',
        'orders' => 'OrdersController',
        'contacts' => 'ContactsController',
        'containers' => 'ContainersController'
    ]);

});