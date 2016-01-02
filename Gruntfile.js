module.exports = function (grunt) {

	var fs = require('fs');
	var path = require('path');

	grunt.util.linefeed = '\n';

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		absPath: path.resolve(),
		buildPath: 'app/assets/build',
		vendorPath: 'app/assets/vendor',

		/*
		sass: {
			options: {
				sourceComments: 'none',
				outputStyle: 'compressed',
				sourceMap: true,
				includePaths: [
					'app/assets/vendor',
					'app/assets/vendor/bootstrap/assets/stylesheets'
				]
			},
			destiny: {
				files: {
					'public/css/destiny.css': 'app/assets/sass/destiny.scss'
				}
			}
		},
		*/
		compass: {
			options: {
				force: true,
				sourcemap: true,
				sassDir: 'app/assets/sass',
		    cssDir: 'public/css',
		    imagesPath: 'assets/img',
		    noLineComments: true,
		    outputStyle: 'compressed',
				importPath: [
					'app/assets/vendor',
					'app/assets/vendor/bootstrap/assets/stylesheets'
				]
				/*
				sourceComments: 'none',
				outputStyle: 'compressed',
				sourceMap: true,
				*/
			},
			destiny: {
				files: {
					'public/css/destiny.css': 'app/assets/sass/destiny.scss'
				}
			}
		},

		uglify: {
			jquery: {
				src: [
					'<%= vendorPath %>/jquery/dist/jquery.js',
					'<%= vendorPath %>/jquery-ui/ui/minified/core.min.js',
					'<%= vendorPath %>/jquery-ui/ui/minified/widget.min.js',
					'<%= vendorPath %>/jquery-ui/ui/minified/mouse.min.js',
					'<%= vendorPath %>/jquery-ui/ui/minified/draggable.min.js',
					'<%= vendorPath %>/jquery-ui/ui/minified/datepicker.min.js',
					'<%= vendorPath %>/jquery-ui/ui/minified/sortable.min.js',
					'<%= vendorPath %>/jquery-cookie/jquery.cookie.js',
					'<%= vendorPath %>/jquery-mousewheel/jquery.mousewheel.js',
					'<%= vendorPath %>/jquery-mcustomscrollbar/jquery.mCustomScrollbar.js',
					'<%= vendorPath %>/jquery-placeholder/jquery.placeholder.js'
				],
				dest: '<%= buildPath %>/js/jquery.min.js'
			},
			bootstrap: {
				src: [
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/transition.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/alert.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/button.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/carousel.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/collapse.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/dropdown.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/modal.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/tooltip.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/popover.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/scrollspy.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/tab.js',
					'<%= vendorPath %>/bootstrap/assets/javascripts/bootstrap/affix.js'
				],
				dest: '<%= buildPath %>/js/bootstrap.min.js'
			},
			libs: {
				src: [
					'<%= vendorPath %>/greensock/src/minified/TimelineMax.min.js',
					'<%= vendorPath %>/greensock/src/minified/TweenMax.min.js'
				],
				dest: '<%= buildPath %>/js/libs.min.js'
			},
			destiny: {
				src: [
					'app/assets/js/destiny.js'
				],
				dest: '<%= buildPath %>/js/destiny.min.js'
			}
		},

		concat: {
			destiny: {
				src: [
					'<%= buildPath %>/js/jquery.min.js',
					'<%= buildPath %>/js/bootstrap.min.js',
					'<%= buildPath %>/js/libs.min.js',
					'<%= buildPath %>/js/destiny.min.js'
				],
				dest: 'public/js/destiny.js'
			}
		},

		clean: ['<%= buildPath %>'],

		watch: {
			styles: {
				files: ['app/assets/sass/**/*.{scss,sass}'],
				tasks: 'build-css'
			},
			scripts: {
				files: ['app/assets/js/**/*.js'],
				tasks: 'build-js'
			},
			livereload: {
				files: [
					'app/controllers/**/*.php',
					'app/views/**/*.php',
					'app/views/**/*.html',
					'app/assets/img/metadata.json',
					'app/*.php',
					'app/destiny/**/*.php',
					'app/destiny/*.php',
					'public/css/**',
					'public/js/**',
					'public/img/**',
					'public/fonts/**',
				],
				options: {
					livereload: true
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-compass');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['build-css', 'build-js']);
	grunt.registerTask('build-css', ['compass']);
	grunt.registerTask('build-js', ['uglify', 'concat', 'clean']);
	//grunt.registerTask('build-js', ['uglify', 'concat']);
}
