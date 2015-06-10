'use strict';
module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        // watch our project for changes
        watch: {
            css: {
                files: ['public/assets/sass/**/*.scss'],
                tasks: ['compass']
            },
            livereload: {
                options: { livereload: true },
                files: ['public/assets/**/*', '**/*.html', '**/*.php', 'public/assets/img/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },
   		concat: {
            dist: {
                src: [
                    'public/assets/js/source/util--wp-api.js',
                    'public/assets/js/source/wp-search.js'
               	],
                dest: 'public/assets/js/wp-search.js'
            }
        },
        compass: {
     		dist: {
                options: {
                    config: 'config.rb',
                    force: true
                }
            }
        }
    });

    // register task
    grunt.registerTask('default', ['watch']);

};