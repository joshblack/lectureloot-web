@extends('master')

@section('title')
	<title>Add a course to your schedule</title>
@show

@section('body')
<body class="search-page cbp-spmenu-push">
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

<div class="input--search shadow">
  {{ Form::open(['method' => 'get' ,'url' => '/courses/search', 'class' => 'search--form']) }}
    {{ Form::input('search', 'q', null, ['placeholder' => 'Search for Classes', 'class' => 'text-field']) }}
    <button class="icon icon_search"></button>
  {{ Form::close() }}
</div>
@if (isset($courses))
  @if ($courses->count())
    @foreach ($courses as $course)
    <div class="info-box info-box__alternate">
      <button class="option-select--add md-trigger" data-modal="modal-1" data-url="/courses?{{ 'course_id=' . $course->id }}">Add</button>
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

      <ul class="info-box--desc__list">
        <li class="info-box--desc__list-item">Section: {{ $course->sectionNumber }}</li>
        <li class="info-box--desc__list-item">Instructor: {{ $course->instructor }}</li>
        <li class="info-box--desc__list-item">Credits: {{ $course->credits }}</li>
        <li class="info-box--desc__list-item">{{ ucfirst($course->semester) . ' ' . $course->year }}</li>
      </ul>
    </div>
    @endforeach

  @else
    {{ 'No Courses to display' }}
  @endif
@else
  <div class="alert--search">
    <span class="icon icon_bell"></span>
    <p class="alert--search__desc">No results to display, try searching for something!</p>
  </div>
@endif
<div class="md-modal md-effect-1" id="modal-1">
  <div class="md-content">
      <h3>Add this Course</h3>
      <div>
          <p>Are you sure you want to add this course?</p>
          <div class="modal--options">
            {{ Form::open(['method' => 'POST', 'url' => '', 'id' => 'modalForm']) }}
              <button class="modal--options__confirm">Yes</button>
            {{ Form::close() }}
            <button class="modal--options__close md-close">No Way!</button>
          </div>
      </div>
  </div>
</div>
<div class="md-overlay"></div>
@stop