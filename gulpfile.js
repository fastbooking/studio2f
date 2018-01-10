/*
	gulpfile.js
	===========
	Rather than manage one giant configuration file responsible
	for creating multiple tasks, each task has been broken out into
	its own file in gulp/tasks. Any files in that directory get
	automatically required below.
	To add a new task, simply add a new task file that directory.
	gulp/tasks/default.js specifies the default set of tasks to run
	when you run `gulp`.
*/

// require("time-require");

gulp = require('gulp');
argv = require('yargs').argv;

if ( argv.clean ) {

	var del   = require('del');
	var prod  = require('./gulp/config').prod;
	var dev = require('./gulp/config').dev;
	gulp.task('default', function(cb) {
		del([ dev, prod ], cb);
	});

} else if ( argv.dev ) {

	browserSync = require('browser-sync').create();

	has_react = false;
	if ( 'react' == argv.dev ) {
		has_react = true;
		console.log( ' ------------------------------------------------------' );
		console.log( ' REACT ON!' );
	}

	var requireDir = require('require-dir');
	requireDir('./gulp/dev', { recurse: true });

} else if ( argv.prod ) {

	has_react = false;
	if ( 'react' == argv.prod ) {
		has_react = true;
		console.log( ' ------------------------------------------------------' );
		console.log( ' REACT ON!' );
	}

	var requireDir = require('require-dir');
	requireDir('./gulp/prod', { recurse: true });

	run = require('run-sequence');
	gulp.task('default', ['watch']);

} else if ( argv.react ) {

	var requireDir = require('require-dir');
	requireDir('./gulp/react', { recurse: true });

} else if ( argv.upload ) {

	var requireDir = require('require-dir');
	requireDir('./gulp/prod', { recurse: true });

	run = require('run-sequence');
	gulp.task('default', function(callback) {
		run('clean', 'build', 'upload', callback);
	});

} else if ( argv.start ) {

	if (typeof argv.start === 'string' || argv.start instanceof String) {
		var requireDir = require('require-dir');
		requireDir('./gulp/start', { recurse: true });
	} else {
		console.log( '------------------------------------------' )
		console.log()
		console.log( 'Error: "gulp --start" # Requires a string' )
		console.log( 'Example: gulp --start newtheme' )
		console.log()
		console.log( '------------------------------------------' )
	}

}