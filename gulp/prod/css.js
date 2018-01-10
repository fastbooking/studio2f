var source  = require('../config').source
  , prod     = require('../config').prod
;

gulp.task('css', function() {
	return gulp.src(
		[source+'**/*.css']
	)
	.pipe(gulp.dest( prod ));
});