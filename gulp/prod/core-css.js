var source= require('../config').source
	, prod   = require('../config').prod
  , prod_sass = require('../prod/base-functions.js').prod_sass
  , prod_sass_min = require('../prod/base-functions.js').prod_sass_min
  , prod_sass_error = require('../prod/base-functions.js').prod_sass_error
;

gulp.task('core-css', function() {
  return gulp.src([source+'scss/*.scss', '!'+source+'scss/_*.scss'])
    .pipe(prod_sass().on('error', prod_sass_error))
    .pipe(prod_sass_min().on('error', prod_sass_error))
    .pipe(gulp.dest(prod));
});