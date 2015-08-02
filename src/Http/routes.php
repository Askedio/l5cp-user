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

    # User routes
    Route::resource('admin/users', 'Askedio\Laravelcp\User\Http\Controllers\HomeController');

  }
);