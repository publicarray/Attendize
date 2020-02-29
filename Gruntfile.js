module.exports = function (grunt) {
    //Initializing the configuration object
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        // Task configuration
        less: {
            development: {
                options: {
                    compress: true,
                    javascriptEnabled: true,
                },
                files: {
                    "./public/assets/stylesheet/application.css": "./public/assets/stylesheet/application.less",
                    "./public/assets/stylesheet/frontend.css": "./public/assets/stylesheet/frontend.less",
                }
            },
        },
        copy: {
            jquery_js: {
                files: [{
                    src: './node_modules/@bower_components/jquery/jquery.min.js',
                    dest: './public/assets/javascript/jquery.min.js',
                }],
            },
            moment: {
                files: [{
                    src: './node_modules/@bower_components/moment/min/moment-with-locales.min.js',
                    dest: './public/assets/javascript/moment.min.js',
                }],
            },
            vue: {
                files: [{
                    src: './node_modules/@bower_components/vue/vue.min.js',
                    dest: './public/assets/javascript/vue.min.js',
                }],
            },
            vue_resource: {
                files: [{
                    src: './node_modules/@bower_components/vue-resource/dist/vue-resource.min.js',
                    dest: './public/assets/javascript/vue-resource.min.js',
                }],
            },
            geocomplete: {
                files: [{
                    src: './node_modules/@bower_components/geocomplete/jquery.geocomplete.min.js',
                    dest: './public/assets/javascript/jquery.geocomplete.min.js',
                }],
            },
            simplemde_js: {
                files: [{
                    src: './node_modules/@bower_components/simplemde/dist/simplemde.min.js',
                    dest: './public/assets/javascript/simplemde.min.js',
                }],
            },
            simplemde_css: {
                files: [{
                    src: './node_modules/@bower_components/simplemde/dist/simplemde.min.css',
                    dest: './public/assets/stylesheet/simplemde.min.css',
                }],
            },
            fullcalendar_js: {
                files: [{
                    src: './node_modules/@bower_components/fullcalendar/dist/fullcalendar.min.js',
                    dest: './public/assets/javascript/fullcalendar.min.js',
                }],
            },
            fullcalendar_css: {
                files: [{
                    src: './node_modules/@bower_components/fullcalendar/dist/fullcalendar.min.css',
                    dest: './public/assets/stylesheet/fullcalendar.min.css',
                }],
            },
            fullcalendar_lang: {
                files: [{
                    expand: true,
                    cwd: './node_modules/@bower_components/fullcalendar/dist/lang/',
                    src: '*.js',
                    dest: './public/assets/javascript/fullcalendar/',
                }],
            },
        },
        concat: {
            options: {
                separator: ';',
                stripBanners: {
                    block: true,
                    line: true
                },
            },
            js_frontend: {
                src: [
                    './node_modules/@bower_components/jquery/jquery.min.js',
                    './node_modules/@bower_components/bootstrap/dist/js/bootstrap.js',
                    './node_modules/@bower_components/jquery-form/jquery.form.js',
                    './node_modules/@bower_components/RRSSB/js/rrssb.js',
                    './node_modules/@bower_components/humane-js/humane.js',
                    './node_modules/@bower_components/jquery.payment/lib/jquery.payment.js',
                    './public/assets/javascript/app-public.js'
                ],
                dest: './public/assets/javascript/frontend.js',
            },
            js_backend: {
                src: [
                    './node_modules/@bower_components/modernizr/modernizr.js',
                    './node_modules/@bower_components/html.sortable/dist/html.sortable.js',
                    './node_modules/@bower_components/bootstrap/dist/js/bootstrap.js',
                    './node_modules/@bower_components/jquery-form/jquery.form.js',
                    './node_modules/@bower_components/humane-js/humane.js',
                    './node_modules/@bower_components/RRSSB/js/rrssb.js',
                    './node_modules/@bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
                    './node_modules/@bower_components/datetimepicker/dist/DateTimePicker.js',
                    './node_modules/@bower_components/jquery-minicolors/jquery.minicolors.min.js',
                    './public/assets/javascript/app.js'
                ],
                dest: './public/assets/javascript/backend.js',
            },
        },
        uglify: {
            options: {
                mangle: true,  // Use if you want the names of your functions and variables unchanged
                preserveComments: false,
                banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                '<%= grunt.template.today("yyyy-mm-dd") %> */',

            },
            frontend: {
                files: {
                    './public/assets/javascript/frontend.js': ['<%= concat.js_frontend.dest %>'],
                }
            },
            backend: {
                files: {
                    './public/assets/javascript/backend.js': './public/assets/javascript/backend.js',
                }
            },
        },
        watch: {
            scripts: {
                files: ['./public/assets/**/*.js'],
                tasks: ['default'],
                options: {
                    spawn: false,
                },
            },
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    // Task definition
    grunt.registerTask('default', ['less', 'concat', 'copy']);
    grunt.registerTask('deploy', ['less', 'concat', 'uglify', 'copy']);
    grunt.registerTask('js', ['concat', 'copy']);
    grunt.registerTask('styles', ['concat', 'copy']);
    grunt.registerTask('minify', ['uglify']);
};
