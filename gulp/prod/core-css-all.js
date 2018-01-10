var source= require('../config').source
	, prod   = require('../config').prod
	, folders = require('gulp-folders')
	, concat  = require('gulp-concat')
  , path    = require('path')
  , prod_sass = require('../prod/base-functions.js').prod_sass
  , prod_sass_min = require('../prod/base-functions.js').prod_sass_min
  , prod_sass_error = require('../prod/base-functions.js').prod_sass_error
;

gulp.task('core-css-all', folders(source, function(folder){
  return gulp.src(path.join(source, folder, folder+'.scss'))
    .pipe(prod_sass().on('error', prod_sass_error))
    .pipe(prod_sass_min().on('error', prod_sass_error))
    .pipe(gulp.dest(prod + folder));
}));