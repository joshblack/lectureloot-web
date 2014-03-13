'use strict';

module.exports = function(grunt) {

    // Load grunt tasks automatically
    require('load-grunt-tasks')(grunt);

    // Time how long tasks take. Can help when optimizing build times
    require('time-grunt')(grunt);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
        // Project settings
        config: {
            // Configurable paths
            app: 'app',
            dist: 'public/dist'
        },
		watch: {
            options: {
                livereload: true,
            },
			sass: {
				files: ['app/assets/css/**/*.scss'],
                tasks: ['sass:dev', 'autoprefixer:single_file', 'cssmin', 'notify:watch_css']
			}
        },
        sass: {
            dist: {
                files: {
                    'public/dist/css/styles.css': 'app/assets/css/styles.scss'
                }
            },
            dev: {
				// options: {
				// sourceMap: 'map'
				// },
                files: {
                    'public/dist/css/styles.css': 'app/assets/css/styles.scss'
                }
            }
        },
        autoprefixer: {
			// prefix the specified file
			single_file: {
				src: 'public/dist/css/styles.css',
				dest: 'public/dist/css/styles.css'
			}
        },
        cssmin: {
            minify: {
                expand: true,
                cwd: 'public/dist/css/',
                src: ['*.css', '!*.min.css'],
                dest: 'public/dist/css/',
                ext: '.min.css'
            }
        },
        // The following *-min tasks produce minified files in the dist folder
        imagemin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%%= config.app %>/assets/img',
                    src: '{,*/}*.{gif,jpeg,jpg,png}',
                    dest: '<%%= config.dist %>/img'
                }]
            }
        },
        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%%= config.app %>/img',
                    src: '{,*/}*.svg',
                    dest: '<%%= config.dist %>/img'
                }]
            }
        },
        notify: {
            watch_css: {
                options: {
                    title: 'Task Complete',
                    message: 'Sass finished compiling'
                }
            }
        }
	});

	grunt.registerTask('default', ['sass:dist', 'watch', 'autoprefixer:single_file', 'cssmin']);


};