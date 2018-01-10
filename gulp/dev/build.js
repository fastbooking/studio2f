var source = require('../config').source
var react  = require('../config').react
var fs     = require('fs')
var tpl    = require('../config').tpl
var tasks  = [ 'core-css'
             , 'core-js'
             , 'images'
             , 'languages'
             , 'fonts'
             , 'mobile'
             , 'php'
             , 'css'
             ];

dev_set_tpl_tasks = function() {

	for(var index in tpl) {
		var dir = tpl[index];
		if( fs.existsSync(source+dir+'/'+dir+'.scss') ) {
			tasks.push.apply(tasks, [dir+'-css'])
		}
		if( fs.existsSync(source+dir+'/'+dir+'.js') ) {
			tasks.push.apply(tasks, [dir+'-js'])
		}
		if( fs.existsSync(source+dir+'/'+dir+'.php') ) {
			tasks.push.apply(tasks, [dir+'-php'])
		}
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
dev_set_tpl_tasks();

gulp.task('build', tasks);