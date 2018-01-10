gulp.task('rename-files', function() {
	var rename   = require('gulp-rename');
	return gulp.src( source + "**/" + origname + "*.*", { base: process.cwd() } )
		.pipe( rename(function (path) {
			path.basename = str_replace( path.basename, origname, argv.start )
			return path;
		}))
		.pipe( gulp.dest( './' ) );
});
