@extends('master')

@section('title')
	<title>Courses - LectureLoot</title>
@show

@section('content')
<h1>Your Classes</h1>
{{ link_to('courses/create', 'Add a Class', ['class' => 'link--add']) }}
@if (Session::has('success'))
	<h2>{{ Session::get('success') }}</h2>
@endif
@if (Session::has('error'))
	<h2>{{ Session::get('error') }}</h2>
@endif
@if (count($courses) == 0)
	{{ 'empty' }}
@else
	@foreach ($courses as $course)
		<div class="info-box">
			<span class="icon icon_ellipses info-box--options"></span>
			<div class="info-box--heading">
				<h6 class="info-box--heading__course-name">
					<span class="icon icon_rightarrow"></span>
					{{ $course->deptCode . $course->courseNumber }}
				</h6>
				<a href="/courses/{{ $course->id }}" class="info-box--heading__link">
					<span class="icon icon_book"></span>
					{{ $course->courseTitle }}
				</a>
			</div>
			<div class="options-box">
				<div class="option-select">
					<a class="option-select--edit" href="#">
						<span class="icon icon_checkin"></span>
						<p class="option-select--text">Checkin</p>
					</a>
				</div>
				<div class="option-select">
					<a class="option-select--delete" href="#">
						<span class="icon icon_trash"></span>
						<p class="option-select--text">Remove</p>
					</a>
				</div>
			</div>
			<ul class="info-box--desc__list">
				<li class="info-box--desc__list-item">Section: {{ $course->sectionNumber }}</li>
				<li class="info-box--desc__list-item">Instructor: {{ $course->instructor }}</li>
				<li class="info-box--desc__list-item">Credits: {{ $course->credits }}</li>
				<li class="info-box--desc__list-item">{{ ucfirst($course->semester) . ' ' . $course->year }}</li>
			</ul>
		</div>
	@endforeach
@endif
@stop