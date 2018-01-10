var source = require('../config').source
var bower  = require('../config').bower
var dev    = require('../config').dev
var tpl    = require('../config').tpl

var dev_watch_tpl_assets = require('../dev/base-functions.js').dev_watch_tpl_assets
var dev_watch_tpl_php    = require('../dev/base-functions.js').dev_watch_tpl_php

gulp.task('watch', ['browser-sync'], function() {

	gulp.watch(source+'scss/**/*.scss', ['core-css', 'core-css-all']);
	gulp.watch([source+'js/**/*.js', bower+'**/*.js'], ['core-js']);
	gulp.watch(source+'**/*(*.png|*.jpg|*.jpeg|*.gif|*.ico)', ['images']);
	gulp.watch([source+'**/*.php', '!'+source+'tpl-*/*.php'], ['php']);
	gulp.watch(source+'languages/**/*', ['languages']);
	gulp.watch(source+'mobile/**/*.*', ['mobile']);

	for(var index in tpl) {
		dev_watch_tpl_php( tpl[index] );
		dev_watch_tpl_assets( tpl[index] );
		// console.log( '---[watch] ' + tpl[index] );
	}

});
