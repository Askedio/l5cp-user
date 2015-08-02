<?php

namespace Askedio\Laravelcp\User\Http\Controllers;

use Askedio\Laravelcp\Models\User;
use Askedio\Laravelcp\Models\Role;

use Askedio\Laravelcp\User\Helpers\PermHelper as Helper;

use Askedio\Laravelcp\User\Http\Requests\Perm\CreatePostRequest;
use Askedio\Laravelcp\User\Http\Requests\Perm\StorePostRequest;
use Askedio\Laravelcp\User\Http\Requests\Perm\UpdatePostRequest;
use Askedio\Laravelcp\User\Http\Requests\Perm\DestroyPostRequest;
use Askedio\Laravelcp\User\Http\Requests\Perm\EditRequest;
use Askedio\Laravelcp\User\Http\Requests\Perm\IndexRequest;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PermsController extends Controller
{
  public function index(IndexRequest $request)
  {
    return Helper::index($request);
  }

  public function create(CreatePostRequest $request)
  {
    return Helper::create($request);
  }

  public function store(StorePostRequest $request)
  {
    return Helper::store($request);
  }

  public function edit(EditRequest $request, $id)
  {
    return Helper::edit($id, $request);
  }

  public function update(UpdatePostRequest $request, $id)
  {
    return Helper::update($id, $request);
  }

  public function destroy(DestroyPostRequest $request, $id)
  {
    return Helper::destroy($id, $request);
  }
}