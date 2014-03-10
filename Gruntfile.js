'use strict';

module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			sass: {
				files: ['app/assets/css/*.scss'],
                tasks: ['sass:dev', 'autoprefixer:single_file']
			},
            livereload: {
                files: ['*.html', '*.php', 'js/**/*.{js,json}', 'css/*.css','img/**/*.{png,jpg,jpeg,gif,webp,svg}'],
                options: {
                    livereload: true
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

        }
	});

	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.registerTask('default', ['sass:dist', 'watch', 'autoprefixer:single_file']);


};