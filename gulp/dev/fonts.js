var source= require('../config').source
  , dev   = require('../config').dev
  , fonts = 'fonts/'
;

gulp.task('fonts', function() {
  return gulp.src(source+fonts+'**/*')
  .pipe(gulp.dest(dev+fonts));
});