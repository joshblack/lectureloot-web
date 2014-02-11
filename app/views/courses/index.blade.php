@extends('master')

@section('title')
	<title>Course Index</title>
@show

@section('content')

@if (count($courses) == 0)
	{{ 'empty' }}
@else
	@foreach ($courses as $course)
		<p>hi</p>
	@endforeach
@endif

@stop