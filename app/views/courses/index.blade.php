@extends('master')

@section('title')
	<title>Course Index</title>
@show

@section('content')

<!-- User Title -->
<h1>{{ Auth::user()->firstName . ' ' . Auth::user()->lastName . '\'s classes'}}</h1>

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

<!-- Class information -->
<div>
	@if (count($courses) == 0)
		{{ 'empty' }}
	@else
		<ul>
		@foreach ($courses as $course)
			<ul>
				<li>{{ $course->deptCode . $course->courseNumber . ': ' . $course->courseTitle }}</li>
				<li>Section: {{ $course->sectionNumber }}</li>
				<li>Instructor: {{ $course->instructor }}</li>
				<li>Credits: {{ $course->credits }}</li>
				<li>{{ ucfirst($course->semester) . ' ' . $course->year }}</li>
				<li><a href="/courses/{{ $course->id }}">View Course</a></li>
				<li><a href="/courses/{{ $course->id }}/edit">Edit Course</a></li>
			</ul>
			<br>
		@endforeach
		</ul>
	@endif
</div>

<!-- Make Class -->
<a href="/courses/create">Add a course</a>

@stop