var source = require('../config').source
var react  = require('../config').react
var tpl    = require('../config').tpl
var fs     = require('fs')
var tasks  = [];

dev_set_tpl_tasks = function() {

	for(var index in tpl) {
		var dir = tpl[index];
		var dir_src = react+dir+'.js';
		if( fs.existsSync(dir_src) ) {
			var tpl_src = [dir+'-react'];
			tasks.push.apply(tasks, tpl_src)
		}
	}

	console.log( ' ------------------------------------------------------' );
	console.log( ' Listing all tasks' );
	console.log( tasks );
	console.log( ' ------------------------------------------------------' );

};
dev_set_tpl_tasks();

gulp.task('default', tasks);