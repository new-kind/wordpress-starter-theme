module.exports = function (grunt) {

    'use strict';

    require('time-grunt')(grunt);
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        jshint: {
            grunt: {
                options: {node: true},
                globals: {module: true},
                src: 'Gruntfile.js'
            },
            dist: {
                src: 'js/main.js'
            }
        },

        less: {
            dist: {
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]})
                    ],
                    compress: true,
                    sourceMap: true
                },
                files: {
                    'css/styles.css': 'css/less/styles.less'
                }
            }
        },

        uglify: {
            dist: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'js/main.min.js.map'
                },
                files: {
                    'js/main.min.js': ['js/main.js']
                }
            }
        },

        watch: {
            less: {
                files: [
                    'css/less/*.*',
                    'css/lib/*.*'
                ],
                tasks: 'less:dist',
                interrupt: true
            },
            js: {
                files: [
                    'js/main.js'
                ],
                tasks: ['jshint:dist','uglify:dist'],
                interrupt: true
            }
        }

    });

    grunt.registerTask('default', ['jshint', 'less:dist', 'uglify:dist' ,'watch']);

};
