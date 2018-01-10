var source= require('../config').source
  , prod  = require('../config').prod
  , fonts = 'fonts/'
;

gulp.task('fonts', function() {
  return gulp.src(source+fonts+'**/*')
  .pipe(gulp.dest(prod+fonts));
});