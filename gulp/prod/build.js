var prod  = require('../config').prod
var react = require('../config').react
var fs    = require('fs')
var tpl   = require('../config').tpl
var del   = require('del')
var tasks = [ 'core-css'
            , 'core-js-min'
            , 'images'
            , 'languages'
            , 'fonts'
            , 'mobile'
            , 'php'
            , 'css'
            ];

prod_set_tpl_tasks = function() {

	for(var index in tpl) {
		var dir = tpl[index];
		var tpl_tasks = [
			dir+'-css-min'
		, dir+'-js-min'
		, dir+'-php'
		];
		tasks.push.apply(tasks, tpl_tasks)
	}

	if ( has_react ) {
		for(var index in tpl) {
			var dir = tpl[index];
			var dir_src = react+dir+'.js';
			if( fs.existsSync(dir_src) ) {
				var tpl_src = [dir+'-react'];
				tasks.push.apply(tasks, tpl_src)
			}
		}
	}

	console.log( ' ------------------------------------------------------' );
	console.log( ' Listing all tasks' );
	console.log( tasks );
	console.log( ' ------------------------------------------------------' );

};
prod_set_tpl_tasks();

gulp.task('delete-js', function(cb) {
	del( [
		  prod+'**/*.js'
		, '!'+prod+'**/*.min.js'
		, '!'+prod+'**/*-react-bundle.js'
	], cb )
});

gulp.task('build', function(callback) {
	run( tasks
	   , 'php-minify'
	   , 'delete-js'
	   , callback
	);
});