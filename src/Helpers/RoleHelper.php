<?php

namespace Askedio\Laravelcp\User\Helpers;

use Askedio\Laravelcp\Models\User;
use Askedio\Laravelcp\Models\Role;
use Askedio\Laravelcp\Models\Permission;

use Illuminate\Http\Request;

class RoleHelper
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


    $roles = Role::
      where('name', 'LIKE', '%'.session('l5cp-role-search').'%')
      ->orWhere('slug', 'LIKE', '%'.session('l5cp-role-search').'%')
      ->paginate(session('l5cp-role-limit'));

    return view('l5cp-user::role.index')->withPermissions(Permission::all())->withRoles($roles);
  }

  public static function create($request)
  {
    return view('l5cp-user::role.create_edit')->withPermissions(Permission::all())->withRoles(Role::all());
  }

  public static function store($request)
  {
    $user = self::createOrUpdate(null, $request); 
    return $user ? redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\RolesController@edit', [$user->id])->withSuccess(trans('lcp::default.saved')) :
    back()->withError(trans('l5cp-user::default.nouser'));
  }

  public static function edit($id, $request)
  {
    return view('l5cp-user::role.create_edit')->withPermissions(Permission::all())->withUser(Role::findOrFail($id));
  }

  public static function update($id, $request)
  {
    $user = self::createOrUpdate($id, $request);
    return redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\RolesController@edit', [$user->id])->withSuccess(trans('lcp::default.saved'));
  }

  public static function destroy($id, $request)
  {
    $user = Role::findOrFail($id)->delete();
    return redirect()->action('\Askedio\Laravelcp\User\Http\Controllers\RolesController@index')->withSuccess(trans('lcp::default.removed'));
  }

	public static function createOrUpdate($id = null, $request)
  {
    $model = is_null($id) ? new Role : Role::findOrFail($id);
    $model->name = $request->input('name');
    $model->slug = $request->input('slug');
    $save = $model->save() ? $model : false;
    if($save) $model->permissions()->sync($request->input('permissions'));
    return $save;
  }
}