@extends('lcp::layouts.master')

@section('title', 'Module')
@section('page-header', 'Module')

@section('content')
    <p>This is my modules body content.</p>
@endsection

@section('after')
    @parent
     This page took {{ (microtime(true) - LARAVEL_START) }} seconds to render
@endsection


@section('keywords', '')
@section('author', '')
@section('description', '')

@section('styles')

@endsection

@section('head')

@endsection

@section('header')

@endsection

@section('before')
    @parent

@endsection

@section('side-menu')
    @parent

@endsection

@section('sidebar')

@endsection

@section('page-wrapper')
    @parent

@endsection

@section('after')
    @parent

@endsection

@section('footer')

@endsection

@section('scripts')

@endsection

@section('navbar-right')
@endsection
