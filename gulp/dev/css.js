var source  = require('../config').source
  , dev     = require('../config').dev
;

gulp.task('css', function() {
	return gulp.src(
		[source+'**/*.css']
	)
	.pipe(gulp.dest( dev ));
});
