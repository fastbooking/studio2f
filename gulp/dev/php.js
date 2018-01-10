var source  = require('../config').source
  , dev     = require('../config').dev
  , changed = require('gulp-changed')
;

gulp.task('php', function() {
	return gulp.src(
		[source+'**/*.php', '!'+source+'tpl-*/*.php'] // Ignore tpls
	)
	.pipe(changed( dev ))
	.pipe(gulp.dest( dev ));
});
