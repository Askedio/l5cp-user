<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

# Admin group
Route::group([
    'as' => 'dashboard',
    'middleware' => 'role:admin',
  ],
  function () {

    Route::resource('admin/users', 'Askedio\Laravelcp\User\Http\Controllers\HomeController');
    Route::resource('admin/roles', 'Askedio\Laravelcp\User\Http\Controllers\RolesController');
    Route::resource('admin/permissions', 'Askedio\Laravelcp\User\Http\Controllers\PermsController');

  }
);