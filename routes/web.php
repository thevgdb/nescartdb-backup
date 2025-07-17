<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [Controllers\AppController::class, 'welcome'])->name('welcome');
Route::get('about', [Controllers\AppController::class, 'about'])->name('about');
//Route::get('search', [Controllers\AppController::class, 'search'])->name('search');
//Route::get('guides', [Controllers\AppController::class, 'guides'])->name('guides');
Route::get('plugins', [Controllers\AppController::class, 'plugins'])->name('plugins');
Route::get('missing', [Controllers\AppController::class, 'missing'])->name('missing');
Route::get('stats', [Controllers\AppController::class, 'stats'])->name('stats');

Route::group(['prefix' => 'guides'], function() {
    Route::get('/', [Controllers\GuidesController::class, 'guides'])->name('guides');
    Route::get('view/{guide_key}', [Controllers\GuidesController::class, 'view'])->name('guides.view');
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('/', [Controllers\AppController::class, 'redirectHome']);
    Route::get('view/{cart_id?}/{cart_url_slug?}', [Controllers\ProfileController::class, 'cart'])->name('cart');
    Route::get('image/{cart_id?}', [Controllers\ProfileController::class, 'image'])->name('image');
});

Route::group(['prefix' => 'search'], function() {
    Route::get('/', [Controllers\SearchController::class, 'search'])->name('search');
    Route::get('basic', [Controllers\SearchController::class, 'basic'])->name('search.basic');
    Route::get('advanced', [Controllers\SearchController::class, 'advanced'])->name('search.advanced');
    Route::get('browse/{letter?}', [Controllers\SearchController::class, 'browse'])->name('search.browse');
    Route::get('random', [Controllers\SearchController::class, 'random'])->name('search.random');
});

Route::group(['prefix' => '/'], function() {
    Route::get('login', [Controllers\Auth\LoginController::class, 'showLoginPage'])->name('login');
    Route::post('login', [Controllers\Auth\LoginController::class, 'attemptLogin'])->name('login.attempt');
    Route::match(['GET', 'POST'], 'logout', [Controllers\Auth\LoginController::class, 'processLogout'])->name('logout');
    Route::get('register', [Controllers\Auth\RegisterController::class, 'showRegisterPage'])->name('register');
    Route::post('register', [Controllers\Auth\RegisterController::class, 'attemptRegistration'])->name('register.attempt');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [Controllers\Admin\AdminController::class, 'adminHome'])->name('admin');
    Route::get('warnings', [Controllers\Admin\WarningsController::class, 'showWarningsPage'])->name('admin.warnings');
});
