var source  = require('../config').source
  , prod    = require('../config').prod
;

gulp.task('php', function() {
  return gulp.src(
    [source+'**/*.php', '!'+source+'tpl-*/*.php'] // Ignore tpls
  )
  .pipe(gulp.dest( prod ));
});
