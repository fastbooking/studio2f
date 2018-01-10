var dev   = require('../config').dev
  , del   = require('del')
;

gulp.task('clean', function(cb) {
  del([dev], cb)
});