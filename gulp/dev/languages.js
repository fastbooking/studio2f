var source= require('../config').source
  , dev   = require('../config').dev
  , lang = 'languages/'
;

gulp.task('languages', function() {
  return gulp.src(source+lang+'**/*')
  .pipe(gulp.dest(dev+lang));
});