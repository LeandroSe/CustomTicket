module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*\n' +
                ' * CustomTicket <%= pkg.version %>\n' +
                ' */\n',
        concat: {
            options: {
                banner: '<%= banner %>',
                stripBanners: false
            },
            customticket: {
                src: [
                    'frontend/jquery/dist/jquery.js',
                    'frontend/bootstrap/dist/js/bootstrap.js',
                    'frontend/angular/angular.js',
                    'frontend/src/js/*.js'
                ],
                dest: 'web/js/<%= pkg.name %>.js'
            }
        },
        uglify: {
            customticket: {
                options: {
                    banner: '<%= banner %>',
                    report: 'min'
                },
                src: ['<%= concat.customticket.dest %>'],
                dest: 'web/js/<%= pkg.name %>.min.js'
            }
        },
        less: {
            compileCore: {
                options: {
                    strictMath: true,
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapURL: '<%= pkg.name %>.css.map',
                    sourceMapFilename: 'web/css/<%= pkg.name %>.css.map'
                },
                files: {
                    'web/css/<%= pkg.name %>.css': [
                        'frontend/bootstrap/dist/css/bootstrap.css',
                        'frontend/src/less/<%= pkg.name %>.less'
                    ]
                }
            },
            minify: {
                options: {
                    cleancss: true,
                    report: 'min'
                },
                files: {
                    'web/css/<%= pkg.name %>.min.css': 'web/css/<%= pkg.name %>.css'
                }
            }
        },
        usebanner: {
            dist: {
                options: {
                    position: 'top',
                    banner: '<%= banner %>'
                },
                files: {
                    src: [
                        'web/css/<%= pkg.name %>.css',
                        'web/css/<%= pkg.name %>.min.css'
                    ]
                }
            }
        }
    });

    // These plugins provide necessary tasks.
    grunt.loadNpmTasks('grunt-banner');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');

    // Default task(s).

    grunt.registerTask('css', ['less', 'usebanner']);
    grunt.registerTask('js', ['concat', 'uglify']);
    grunt.registerTask('default', ['js', 'css']);

};
