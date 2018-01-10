var source   = require('../config').source
var dev      = require('../config').dev
var bower    = require('../config').bower
var lazypipe = require('lazypipe')
var sass     = require('gulp-sass')
var autopref = require('gulp-autoprefixer')

var dev_sass = lazypipe()
                 .pipe( sass, {includePaths: [bower, source+'scss'], errLogToConsole: true })
                 .pipe( autopref, 'last 2 versions', 'ie 9', 'ios 6', 'android 4' )

var dev_sass_error = function(err) { console.log(err) }

module.exports = {

	dev_sass:       dev_sass,
	dev_sass_error: dev_sass_error,

	dev_task_css: function( name, src, dest ) {
		gulp.task(name, function() {
			return gulp.src(src) // Ignore partials
				.pipe(dev_sass().on('error', dev_sass_error))
				.pipe(gulp.dest(dest))
				.pipe(browserSync.stream());
		});
	},

	dev_task_js: function( name, src, dest ) {
		var include = require('gulp-include');
		gulp.task(name, function(){
			return gulp.src(src)
				.pipe( include({ extensions: 'js' }) )
				.pipe(gulp.dest( dest ))
				.pipe(browserSync.stream());
		});
	},

	dev_task_php : function( name, src, dest ) {
		var changed = require('gulp-changed')
		gulp.task(name, function() {
			return gulp.src( src + '*.php' )
			.pipe(changed( dest ))
			.pipe(gulp.dest( dest ));
		});
	},

	dev_watch_tpl_assets : function( dir ) {
		gulp.watch(
			[ source+dir+'/'+dir+'*.scss',
			  source+dir+'/_'+dir+'*.scss' ],
			[ dir+'-css' ] );
		gulp.watch(
			[ source+dir+'/'+dir+'*.js',
			  source+dir+'/_'+dir+'*.js' ],
			[ dir+'-js' ]
		);
	},

	dev_watch_tpl_php : function( dir ) {
		gulp.watch(source+dir+'/'+dir+'*.php', [dir+'-php']);
	},

}



