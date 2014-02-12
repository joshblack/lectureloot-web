@extends('master')

@section('title')
	<title>Class Information</title>
@show

@section('content')

<!-- Header -->
<h1>Information for {{ $course->deptCode . $course->courseNumber }}</h1>

<!-- Flash Messages -->
<div>
	@if (Session::has('success'))
		<h2>{{ Session::get('success') }}</h2>
	@endif
</div>
<div>
	@if (Session::has('error'))
		<h2>{{ Session::get('error') }}</h2>
	@endif
</div>

<!-- Display Course -->
<div>

	<ul>
		<li>{{ $course->deptCode . $course->courseNumber . ': ' . $course->courseTitle }}</li>
		<li>Section Number: {{ $course->sectionNumber }}</li>
		<li>Credits: {{ $course->credits }}</li>
		<li>Instructor: {{ $course->instructor }}</li>
		<li>Term: {{ ucfirst($course->semester) . ' ' . $course->year }}</li>
	</ul>
</div>

<!-- Add or Remove Class -->
{{ Form::open(['route' => 'courses.store']) }}
	{{ Form::hidden('course_id', $course->id) }}
	{{ Form::submit('Add class') }}
{{ Form::close() }}

{{ Form::open(['method' => 'DELETE', 'url' => 'courses/' . $course->id]) }}
	{{ Form::submit('Remove class') }}
{{ Form::close() }}

@stop