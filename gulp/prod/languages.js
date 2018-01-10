var source = require('../config').source
  , prod   = require('../config').prod
  , lang   = 'languages/'
;

gulp.task('languages', function() {
  return gulp.src(source+lang+'**/*')
  .pipe(gulp.dest(prod+lang));
});