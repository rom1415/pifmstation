module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        wiredep: {
            target:{
                src: "index.php"
            }

        }
    });

    grunt.loadNpmTasks('grunt-wiredep');

    // Default task
    grunt.registerTask('default', ['wiredep']);

};