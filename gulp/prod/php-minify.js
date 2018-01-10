var source  = require('../config').source
  , prod    = require('../config').prod
;

// Create task to enable minification in enqueue.php
gulp.task('php-minify', function(){

  var replace = require('gulp-replace');
  gulp.src(source+'functions.php')
    .pipe(replace(/\/\/--DEV--/g, ''))
    .pipe(gulp.dest(prod));

});