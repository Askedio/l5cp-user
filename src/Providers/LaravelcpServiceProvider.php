<?php

namespace Askedio\Laravelcp\User\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

use Askedio\Laravelcp\Helpers\NavigationHelper;
use Askedio\Laravelcp\Helpers\HookHelper;
use Askedio\Laravelcp\Helpers\SearchHelper;

class LaravelcpServiceProvider extends ServiceProvider
{
  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {

  }

  /**
   * Register routes, translations, views and publishers.
   *
   * @return void
   */
  public function boot()
  {
    $this->loadTranslationsFrom(realpath(__DIR__.'/../Resources/Lang'), 'l5cp-user');

    /*$submenu = [['nav' => 'main',
      'sort' => '1', 
      'link' => url('/admin/users'), 
      'title' => trans_choice('l5cp-user::default.user', 2)
     ]];*/

    NavigationHelper::Add([
      'nav' => 'main',
      'sort' => '1', 
      'link' => url('/admin/users'), 
      'title' => trans_choice('l5cp-user::default.user', 2), 
      'icon' => 'fa-users',
      //'submenu' => $submenu
    ]);

    HookHelper::Add(['hook' => 'dashboard', 'template' => 'l5cp-user::dashboard.welcome', 'sort' => '1']);
    SearchHelper::Add(
      ['model' => 'Askedio\Laravelcp\Models\User', 
      'name' => 'User', 
      'var' => 'user', 
      'columns' => ['email', 'name', 'id'], 
      'actions' => ['id' => 
            ['method'=>'link', 'action'=>'/admin/users/?/edit']
           ]]
      
     );


    if (! $this->app->routesAreCached()) {
      require realpath(__DIR__.'/../Http/routes.php');
    }

    $this->loadViewsFrom(realpath(__DIR__.'/../Resources/Views'), 'l5cp-user');

    $this->publishes([
      realpath(__DIR__.'/../Resources/Views') => base_path('resources/views/vendor/askedio/laravelcp'),
    ], 'views');

    $this->publishes([
      realpath(__DIR__.'/../Resources/Assets') => public_path('assets'),
    ], 'public');

    $this->publishes([
      realpath(__DIR__.'/../Resources/Config') => config_path('')
    ], 'config');

    $this->publishes([
      realpath(__DIR__.'/../Database/Migrations') => database_path('migrations')
    ], 'migrations');

    $this->publishes([
      realpath(__DIR__.'/../Database/Seeds') => database_path('seeds')
    ], 'seeds');

  }
}