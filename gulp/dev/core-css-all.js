var source= require('../config').source
	, dev   = require('../config').dev
	, folders = require('gulp-folders')
	, concat  = require('gulp-concat')
  , path    = require('path')
  , dev_sass = require('../dev/base-functions.js').dev_sass
  , dev_sass_error = require('../dev/base-functions.js').dev_sass_error
;


gulp.task('core-css-all', folders(source, function(folder){
  return gulp.src(path.join(source, folder, folder+'.scss'))
    .pipe(dev_sass().on('error', dev_sass_error))
    .pipe(concat(folder + '.css'))
    .pipe(gulp.dest(dev + folder))
    .pipe(browserSync.stream());
}));

