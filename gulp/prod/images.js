var source= require('../config').source
  , prod  = require('../config').prod
  , imagemin   	= require('gulp-imagemin')
;

gulp.task('images', function() {
  return gulp.src(source+'**/*(*.png|*.jpg|*.jpeg|*.gif|*.ico|*.svg)')
  .pipe(imagemin()) // Optimize
  .pipe(gulp.dest(prod));
});