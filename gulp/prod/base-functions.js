var source   = require('../config').source
    bower    = require('../config').bower
    lazypipe = require('lazypipe')
  , sass     = require('gulp-sass')
  , autoprefixer = require('gulp-autoprefixer')
  , rename       = require('gulp-rename')
  , minifyCss = require('gulp-minify-css')
;

var prod_sass = lazypipe()
                 .pipe( sass, {includePaths: [bower, source+'scss'], errLogToConsole: true })
                 .pipe( autoprefixer, 'last 2 versions', 'ie 9', 'ios 6', 'android 4' )

var prod_sass_min = lazypipe()
                      .pipe(rename, {suffix: '.min'})
                      .pipe(minifyCss, { keepSpecialComments: 1 })

var prod_sass_error = function(err) { console.log(err) }



module.exports = {

	prod_sass:       prod_sass,
	prod_sass_min:   prod_sass_min,
	prod_sass_error: prod_sass_error,

	prod_task_css: function( name, src, dest ) {
	  gulp.task(name + '-min', function() {
	    return gulp.src(src) // Ignore partials
				.pipe(prod_sass().on('error', prod_sass_error))
	      .pipe(prod_sass_min().on('error', prod_sass_error))
	      .pipe(gulp.dest(dest));
	  });
	},

	prod_task_js_min: function( name, deps, src, dest ) {
	  gulp.task(name, deps, function() {
	    var uglify = require('gulp-uglify');
	    var js_min = lazypipe()
	      .pipe(rename, {suffix: '.min'})
	      .pipe(uglify);

	    return gulp.src(src)
	      .pipe(js_min().on('error', prod_sass_error))
	      .pipe(gulp.dest(dest))
	  });
	},

	prod_task_js: function( name, src, dest ) {
	  var include = require('gulp-include');
	  gulp.task(name, function(){
	    return gulp.src(src)
	      .pipe( include({ extensions: 'js' }) )
	      .pipe(gulp.dest( dest ));
	  });
	},

	prod_task_php: function( name, src, dest ) {
	  gulp.task(name, function() {
	    return gulp.src( src + '*.php' )
	    .pipe(gulp.dest( dest ));
	  });
	},

	prod_watch_tpl_assets : function( dir ) {
		gulp.watch(source+dir+'/'+dir+'.scss', [dir+'-css']);
		gulp.watch(source+dir+'/'+dir+'.js',   [dir+'-js-min']);
	},

	prod_watch_tpl_php : function( dir ) {
		gulp.watch(source+dir+'/'+dir+'*.php', [dir+'-php']);
	},


}



