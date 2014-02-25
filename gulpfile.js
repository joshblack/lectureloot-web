// Include Gulp
var gulp = require('gulp');

// Include all plugins
var jshint = require('gulp-jshint'),
	sass = require('gulp-ruby-sass'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	prefix = require('gulp-autoprefixer'),
	rename = require('gulp-rename');

// Lint Task
gulp.task('lint', function() {
	return gulp.src('app/assets/js/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});

// Compile and autoprefix our stylesheets
gulp.task('styles', function() {
	return gulp.src('app/assets/sass/*.scss')
		.pipe(
			sass(
			{
				sourcemap: true, // need sourcemaps for debugging
				style: 'compressed' // compress the output
			}))
		.pipe(prefix("last 1 versoin", ""))
		.pipe(rename('styles.css'))
		.pipe(gulp.dest('build/css'));
});

// Concatenate and minify our JS
gulp.task('scripts', function() {
	return gulp.src('app/assets/js/*.js')
		.pipe(concat('production.js'))
		.pipe(gulp.dest('build/js'))
		.pipe(rename('production.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('build/js'));
});
