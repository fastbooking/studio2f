gulp.task('upload', function () {
  var sftp = require('gulp-sftp');
  var prod = require('../config').prod;
  var site = require('../config').site;

  return gulp.src(prod+'**/*')
    .pipe(sftp(site));
});