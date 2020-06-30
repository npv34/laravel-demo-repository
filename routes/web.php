<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('admin/login','LoginController@showFormLogin')->name('login');
Route::post('admin/login','LoginController@login')->name('users.login');

Route::middleware(['auth', 'checkAge'])->prefix('admin')->group(function (){
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('logout','LoginController@logout')->name('logout');

    Route::prefix('users')->group(function (){
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('/create', 'UserController@create')->name('users.create');
        Route::get('/search', 'UserController@search')->name('users.search');
        Route::post('/create', 'UserController@store')->name('users.store');
        Route::get('/{id}/delete', 'UserController@delete')->name('users.delete');
        Route::get('/{id}/edit', 'UserController@edit')->name('users.edit');
        Route::post('/{id}/edit', 'UserController@update')->name('users.update');
        Route::get('/{id}/posts', 'UserController@getPostsByUser')->name('users.getPosts');
    });

    Route::prefix('posts')->group(function (){
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('/create', 'PostController@create')->name('posts.create');
        Route::post('/create', 'PostController@store')->name('posts.store');

    });

});

