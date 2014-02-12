@extends('master')

@section('title')
	<title>Add a course to your schedule</title>
@show

@section('content')

<!-- User Title -->
<div>
	<h1>{{ Auth::user()->firstName . ' ' . Auth::user()->lastName . '\'s classes'}}</h1>
	<p>Add or remove classes from your schedule</p>
</div>

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

<!-- User Class information -->
<div style="float:left;">
	<h3>My Classes</h3>
	@if (count($userCourses) == 0)
		{{ 'empty' }}
	@else
		<ul>
		@foreach ($userCourses as $userCourse)
			<ul>
				<li>{{ $userCourse->deptCode . $userCourse->courseNumber . ': ' . $userCourse->courseTitle }}</li>
				<li>Section: {{ $userCourse->sectionNumber }}</li>
				<li>Instructor: {{ $userCourse->instructor }}</li>
				<li>Credits: {{ $userCourse->credits }}</li>
				<li>{{ ucfirst($userCourse->semester) . ' ' . $userCourse->year }}</li>
				<li><a href="/courses/{{ $userCourse->id }}">View Course</a></li>
			</ul>
			{{ Form::open(['method' => 'DELETE', 'url' => 'courses/' . $userCourse->id]) }}
				{{ Form::submit('Remove class') }}
			{{ Form::close() }}
			<br>
		@endforeach
		</ul>
	@endif
</div>

<div style="float:right;">
	<h3>Available Classes</h3>
	<ul>
		@foreach ($allCourses as $course)
			<ul>
				<li>{{ $course->deptCode . $course->courseNumber . ': ' . $course->courseTitle }}</li>
				<li>Section: {{ $course->sectionNumber }}</li>
				<li>Instructor: {{ $course->instructor }}</li>
				<li>Credits: {{ $course->credits }}</li>
				<li>{{ ucfirst($course->semester) . ' ' . $course->year }}</li>
			</ul>
			{{ Form::open(['route' => 'courses.store']) }}
				{{ Form::hidden('course_id', $course->id) }}
				{{ Form::submit('Add class') }}
			{{ Form::close() }}
			<br>
		@endforeach
	</ul>
</div>


@stop