<?php

namespace Askedio\Laravelcp\User\Helpers;

use Askedio\Laravelcp\Models\User;
use Askedio\Laravelcp\Models\Role;

use Illuminate\Http\Request;

class UserHelper
{

  public static function index($request)
  {

    
    if($request->input('limit') || !session()->has('l5cp-user-limit'))
      session(['l5cp-user-limit' => $request->input('limit', 15)]);

    if(null !== $request->input('q') || !session()->has('l5cp-user-search'))
      session(['l5cp-user-search' => $request->input('q', '')]);
    
   
    if(null !== $request->input('sort') || !session()->has('l5cp-user-sort'))
      session(['l5cp-user-sort' => $request->input('sort', 'name')]);

    if(null !== $request->input('order') || !session()->has('l5cp-user-order'))
      session(['l5cp-user-order' => $request->input('order', 'desc')]);


    $users = User::
      where('name', 'LIKE', '%'.session('l5cp-user-search').'%')
      ->orWhere('email', 'LIKE', '%'.session('l5cp-user-search').'%')
      ->paginate(session('l5cp-user-limit'));

    return view('l5cp-user::user.index')->withRoles(Role::all())->withUsers($users);
  }

  public static function create($request)
  {
    return view('l5cp-user::user.create_edit')->withRoles(Role::all());
  }

  public static function store($request)
  {
    $user = self::createOrUpdate(null, $request); 
    return $user ? redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\HomeController@edit', [$user->id])->withSccess(trans('lcp::default.saved')) :
    back()->withError(trans('l5cp-user::default.nouser'));
  }

  public static function edit($id, $request)
  {
    $user = User::findOrFail($id);
    return view('l5cp-user::user.create_edit')->withRoles(Role::all())->withUser($user);
  }

  public static function update($id, $request)
  {
    $user = self::createOrUpdate($id, $request);
    return redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\HomeController@edit', [$user->id])->withSuccess(trans('lcp::default.saved'));
  }

  public static function destroy($id, $request)
  {
    $user = User::findOrFail($id)->delete();
    return redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\HomeController@index')->withSuccess(trans('lcp::default.removed'));
  }

	public static function createOrUpdate($id = null, $request)
  {
    $model = is_null($id) ? new User : User::findOrFail($id);
    $model->name = $request->input('name');
    $model->email = $request->input('email');
    if(!$id || $id && $request->input('password')) $model->password = $request->input('password');
    $model->detachAllRoles(); 
    $model->attachRole($request->input('roles')); 
    return $model->save() ? $model : false;
  }
}