@extends('master')

@section('title')
	<title>Add a course to your schedule</title>
@show

@section('body')
<body class="alternate-page cbp-spmenu-push">
@stop

@section('main-nav')
<nav class="main-nav main-nav__alternate">
@stop

@section('logo')
<a href="/dashboard" class="logo logo--alternate">LectureLoot</a>
@stop

@section('content')

@if (Session::has('success'))
	<h2>{{ Session::get('success') }}</h2>
@endif
@if (Session::has('error'))
	<h2>{{ Session::get('error') }}</h2>
@endif

<div class="input--search">
  {{ Form::open(['method' => 'get' ,'url' => '/courses/search', 'class' => 'search--form']) }}
    {{ Form::input('search', 'q', null, ['placeholder' => 'Search for Classes', 'class' => 'text-field']) }}
  {{ Form::close() }}
</div>
@if (isset($courses))
  @if ($courses->count())
    @foreach ($courses as $course)
      {{ $course->courseTitle }}
    @endforeach
  @else
    {{ 'No Courses to display' }}
  @endif
@endif
@stop