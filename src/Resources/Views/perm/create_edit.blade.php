@extends('lcp::layouts.master')

@section('title')
	@if (isset($user))
		{{ trans('lcp::button.edit') }}  {{ trans_choice('l5cp-user::default.permission', 1) }} {{ $user->name }}
	@else
		{{ trans('lcp::button.create') }} {{ trans_choice('l5cp-user::default.permission', 1) }}
	@endif
@stop
@section('page-header')
	@if (isset($user))
		{{ trans('lcp::button.edit') }}  {{ trans_choice('l5cp-user::default.permission', 1) }}
	@else
		{{ trans('lcp::button.create') }} {{ trans_choice('l5cp-user::default.permission', 1) }}
	@endif
@stop


@section('content')
  @if (isset($user))
    <form class="" method="post" action="{{ action('\Askedio\Laravelcp\User\Http\Controllers\PermsController@update', ['id' => $user->id]) }}">
      <input type="hidden" name="_method" value="PUT">
	@else
    <form class="form-ajax" method="post" action="{{ action('\Askedio\Laravelcp\User\Http\Controllers\PermsController@store') }}">
	@endif
      {!! csrf_field() !!}

      <div class="form-group @if ($errors->has('name')) has-error @endif">
        <label for="name">{{ trans('lcp::default.name') }}</label>
        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-fw fa-font"></i></div>
          <input type="text" class="form-control" id="name" placeholder="{{ trans('lcp::default.name') }}" name="name" value="{{ isset($user) ? $user->name : Request::old('name') }}" required maxlength="70">
        </div>
        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
      </div>

      <div class="form-group @if ($errors->has('slug')) has-error @endif">
        <label for="slug">{{ trans('lcp::default.slug') }}</label>
        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-fw fa-tag"></i></div>
          <input type="text" class="form-control" id="slug" placeholder="{{ trans('lcp::default.slug') }}" name="slug" value="{{ isset($user) ? $user->slug : Request::old('slug') }}" required maxlength="254" required>
        </div>
        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('slug') }}</p> @endif
      </div>


      <div class="clearfix"></div>

      <div class="pull-left">
        <button type="submit" class="btn-responsive btn btn-primary">{{ trans('lcp::button.save') }}</button>
        <a href="{{ action('\Askedio\Laravelcp\User\Http\Controllers\PermsController@index') }}" class="btn-responsive btn btn-danger">{{ trans('lcp::button.cancel') }}</a>
      </div>

      @if (isset($user))
      <div class="pull-right">
        <button type="reset" class="btn-responsive btn btn-default">{{ trans('lcp::button.reset') }}</button>
        <a data-row="[{ $user->id }}"  href="{{ action('\Askedio\Laravelcp\User\Http\Controllers\PermsController@destroy', ['id' => $user->id]) }}" class="delete btn-responsive btn btn-warning">{{ trans('lcp::button.delete') }}</a>
      </div>
      @endif

	</form>
@stop