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
                tasks: ['sass:dev', 'autoprefixer:multiple_files', 'concat:css', 'cssmin', 'notify:watch_css']
			},
            webfont: {
                files: ['app/assets/img/icons/*.svg', 'app/assets/img/icons-2x/*.svg'],
                tasks: ['webfont', 'autoprefixer:single_file', 'cssmin', 'notify:watch_svg']
            },
            js: {
                files: ['app/assets/js/**/*.js'],
                tasks: ['uglify', 'notify:watch_js']
            }
        },
        concat: {
            css: {
                src: ['public/dist/css/icons.css', 'public/dist/css/styles.css'],
                dest: 'public/dist/css/production.css'
            }
        },
        uglify: {
            my_target: {
                files: {
                    'public/dist/js/production.min.js': ['app/assets/js/vendor/classie.js', 'app/assets/js/vendor/fastclick.js','app/assets/js/main.js']
                }
            }
        },
        sass: {
            dist: {
                files: {
                    'public/dist/css/styles.css': 'app/assets/css/styles.scss'
                }
            },
            dev: {
                options: {
                    sourceComments: 'map'
                },
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
			},
            multiple_files: {
                options: {
                    map: true
                },
                expand: true,
                flatten: true,
                src: ['public/dist/css/*.css', '!public/dist/css/production.min.css'],
                dest: 'public/dist/css'
            }
        },
        cssmin: {
            minify: {
                expand: true,
                cwd: 'public/dist/css/',
                src: ['production.css', '!*.min.css'],
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
        webfont: {
            icons: {
                src: ['app/assets/img/icons/*.svg', 'app/assets/img/icons-2x/*.svg'],
                dest: 'public/dist/css/fonts',
                destCss: 'public/dist/css',
                options: {
                    htmlDemo: true,
                    relativeFontPath: '/dist/css/fonts'
                }
            }
        },
        notify: {
            watch_css: {
                options: {
                    title: 'Task Complete',
                    message: 'Sass finished compiling'
                }
            },
            watch_svg: {
                options: {
                    title: 'Task Complete',
                    message: 'SVG icons have been converted and css compiled'
                }
            },
            watch_js: {
                options: {
                    title: 'Task Complete',
                    message: 'Uglify finished running'
                }
            }
        }
	});

	grunt.registerTask('default', ['sass:dist', 'watch', 'autoprefixer:single_file', 'cssmin']);

    grunt.registerTask('webfonts', ['webfont', 'autoprefixer:multiple_files', 'concat:css', 'cssmin', 'notify:watch_svg']);
};