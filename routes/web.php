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


Auth::routes();

Route::redirect('/', '/classes');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'subjects', 'as' => 'subjects.'], function () {
        Route::get('', 'App\Http\Controllers\SubjectController@index')->name('index');
        Route::get('{id}/edit', 'App\Http\Controllers\SubjectController@edit')->name('edit');
        Route::post('{id}/update', 'App\Http\Controllers\SubjectController@update')->name('update');
    });

    Route::group(['prefix' => 'classes', 'as' => 'classes.'], function () {
        Route::get('', 'App\Http\Controllers\ClassController@index')->name('index');
        Route::get('{dayOfWeek}/edit', 'App\Http\Controllers\ClassController@edit')->name('edit');
        Route::post('{dayOfWeek}/update', 'App\Http\Controllers\ClassController@update')->name('update');
        Route::get('{dayOfWeek}/destroy', 'App\Http\Controllers\ClassController@destroy')
            ->name('destroy');
        Route::get('{dayOfWeek}/availableSubjects', 'App\Http\Controllers\ClassController@getAvailableSubjects')
            ->name('getAvailableSubjects');
    });

    Route::group(['prefix' => 'substitutes', 'as' => 'substitutes.'], function () {
        Route::get('create', 'App\Http\Controllers\SubstituteController@create')->name('create');
        Route::post('store', 'App\Http\Controllers\SubstituteController@store')->name('store');
        Route::get('{id}/destroy', 'App\Http\Controllers\SubstituteController@destroy')->name('destroy');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

