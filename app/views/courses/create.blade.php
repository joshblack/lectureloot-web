@extends('master')

@section('title')
	<title>Add a course to your schedule</title>
@show

@section('content')

@if (Session::has('success'))
	<h2>{{ Session::get('success') }}</h2>
@endif
@if (Session::has('error'))
	<h2>{{ Session::get('error') }}</h2>
@endif

<div class="input--search">
	<input class="text-field" type="text" placeholder="Search for a Class">
</div>


@stop