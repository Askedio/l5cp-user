<?php

namespace Askedio\Laravelcp\User\Http\Controllers;

use Askedio\Laravelcp\Models\User;
use Askedio\Laravelcp\Models\Role;

use Askedio\Laravelcp\User\Helpers\UserHelper;

use Askedio\Laravelcp\User\Http\Requests\CreatePostRequest;
use Askedio\Laravelcp\User\Http\Requests\StorePostRequest;
use Askedio\Laravelcp\User\Http\Requests\UpdatePostRequest;
use Askedio\Laravelcp\User\Http\Requests\DestroyPostRequest;
use Askedio\Laravelcp\User\Http\Requests\EditRequest;
use Askedio\Laravelcp\User\Http\Requests\IndexRequest;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class HomeController extends Controller
{
  public function index(IndexRequest $request)
  {
    return UserHelper::index($request);
  }

  public function create(CreatePostRequest $request)
  {
    return UserHelper::create($request);
  }

  public function store(StorePostRequest $request)
  {
    return UserHelper::store($request);
  }

  public function edit(EditRequest $request, $id)
  {
    return UserHelper::edit($id, $request);
  }

  public function update(UpdatePostRequest $request, $id)
  {
    return UserHelper::update($id, $request);
  }

  public function destroy(DestroyPostRequest $request, $id)
  {
    return UserHelper::destroy($id, $request);
  }
}