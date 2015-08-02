<?php

namespace Askedio\Laravelcp\User\Helpers;

use Askedio\Laravelcp\Models\User;
use Askedio\Laravelcp\Models\Role;
use Askedio\Laravelcp\Models\Permission;

use Illuminate\Http\Request;

class PermHelper
{

  public static function index($request)
  {

    
    if($request->input('limit') || !session()->has('l5cp-role-limit'))
      session(['l5cp-role-limit' => $request->input('limit', 15)]);

    if(null !== $request->input('q') || !session()->has('l5cp-role-search'))
      session(['l5cp-role-search' => $request->input('q', '')]);
    
   
    if(null !== $request->input('sort') || !session()->has('l5cp-role-sort'))
      session(['l5cp-role-sort' => $request->input('sort', 'name')]);

    if(null !== $request->input('order') || !session()->has('l5cp-role-order'))
      session(['l5cp-role-order' => $request->input('order', 'desc')]);


    $users = Permission::
      where('name', 'LIKE', '%'.session('l5cp-role-search').'%')
      ->orWhere('slug', 'LIKE', '%'.session('l5cp-role-search').'%')
      ->paginate(session('l5cp-role-limit'));

    return view('l5cp-user::perm.index')->withRoles(Role::all())->withUsers($users);
  }

  public static function create($request)
  {
    return view('l5cp-user::perm.create_edit')->withRoles(Role::all());
  }

  public static function store($request)
  {
    $user = self::createOrUpdate(null, $request); 
    return $user ? redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\PermsController@edit', [$user->id])->withSuccess(trans('lcp::default.saved')) :
    back()->withError(trans('l5cp-user::default.nouser'));
  }

  public static function edit($id, $request)
  {
    $user = Permission::findOrFail($id);
    return view('l5cp-user::perm.create_edit')->withRoles(Role::all())->withUser($user);
  }

  public static function update($id, $request)
  {
    $user = self::createOrUpdate($id, $request);
    return redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\PermsController@edit', [$user->id])->withSuccess(trans('lcp::default.saved'));
  }

  public static function destroy($id, $request)
  {
    $user = Permission::findOrFail($id)->delete();
    return redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\PermsController@index')->withSuccess(trans('lcp::default.removed'));
  }

	public static function createOrUpdate($id = null, $request)
  {
    $model = is_null($id) ? new Permission : Permission::findOrFail($id);
    $model->name = $request->input('name');
    $model->slug = $request->input('slug');
    return $model->save() ? $model : false;
  }
}