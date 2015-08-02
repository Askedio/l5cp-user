@extends('lcp::layouts.master')

@section('title', trans_choice('l5cp-user::default.user', 2))
@section('page-header', trans_choice('l5cp-user::default.user', 2))

@section('content')
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      {!! trans('lcp::auth.error') !!}<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row">
    <div class="col-sm-2">
      <form method="get">
        <div class="form-group">  
          <div class="input-group">  
            <input type="number" class="form-control" name="limit" value="{{ session('l5cp-user-limit') }}">
            <div class="input-group-btn"><button type="submit" class="btn btn-default">Limit</button></div>
          </div>
        </div>
      </form>
    </div>

    <div class="col-sm-6 pull-right">
      <form method="get">
        <div class="form-group">  
          <div class="input-group">  
            <div class="input-group-addon"><i class="fa fa-search"></i></div>
            <input name="q" type="search" class="form-control" placeholder="Search"  value="{{ session('l5cp-user-search') }}">
        </div>
      </form>
    </div>

    </div>
  </div>

  <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="col-md-2 col-sm-3 col-xs-5">{{ trans('lcp::default.control') }}</th>
          <th>
            {{ trans('lcp::default.name') }} 
            <a href="?sort=name&order={{ session('l5cp-user-order') == 'desc' ? 'asc' : 'desc' }}" class="disabled">
              <i class="fa fa-sort{{ session('l5cp-user-sort') == 'name' ? (Input::get('order', 'desc') == 'desc' ? '-alpha-asc' : '-alpha-desc') : '' }} pull-right"></i>
            </a>
          </th>
          <th class="hidden-xs">
            {{ trans('lcp::default.email') }}
            <a href="?sort=email&order={{ session('l5cp-user-order') == 'desc' ? 'asc' : 'desc' }}" class="disabled">
              <i class="fa fa-sort{{ session('l5cp-user-sort') == 'email' ? (Input::get('order', 'desc') == 'desc' ? '-alpha-asc' : '-alpha-desc') : '' }} pull-right"></i>
            </a>
          </th>
        </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td>
            <a href="{{ action('\Askedio\Laravelcp\User\Http\Controllers\HomeController@edit', ['id' => $user->id]) }}" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i></a>
            <a href="{{ action('\Askedio\Laravelcp\User\Http\Controllers\HomeController@destroy', ['id' => $user->id]) }}" class="btn btn-danger delete" data-type="DELETE"><i class="fa fa-fw fa-trash"></i></a>
          </td>
          <td>{{ $user->name }}</td>
          <td class="hidden-xs">{{ $user->email }}</td>
        </tr>
     @endforeach
  </table>
  {!! $users->render() !!}
@endsection

@section('page-header-right')
    <a href="{{ action('\Askedio\Laravelcp\User\Http\Controllers\HomeController@create') }}" class=" pull-right btn btn-primary btn-xl">Create</a>
@endsection