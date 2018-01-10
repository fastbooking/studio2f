var prod = require('../config').prod
  , del  = require('del')
;

gulp.task('clean', function(cb) {
  del([prod], cb)
});