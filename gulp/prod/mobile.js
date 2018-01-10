var source = require('../config').source
  , prod   = require('../config').prod
  , mobile      = 'mobile/'
  , mobile_css  = mobile + 'css/'
  , mobile_lang = mobile + 'languages/'
;

var prod_sass_error = require('../prod/base-functions.js').prod_sass_error

var prod_mobile_sass = lazypipe()
  .pipe(sass, {includePaths: [bower, source+'scss', source+mobile_css], errLogToConsole: true})
  .pipe(autoprefixer, 'last 2 versions', 'ie 9', 'ios 6', 'android 4');


gulp.task('mobile', ['mobile-js', 'mobile-style-css', 'mobile-css', 'mobile-languages' ]);

gulp.task('mobile-css',  function() {

  return gulp.src([source+mobile_css+'*.scss', '!'+source+mobile_css+'_*.scss'])
    .pipe(prod_mobile_sass().on('error', prod_sass_error))
    .pipe(gulp.dest(prod+mobile_css))
});

gulp.task('mobile-style-css', function() {
  return gulp.src(source+mobile+'*.css')
  .pipe(gulp.dest(prod+mobile))
});


gulp.task('mobile-js', function() {
  return gulp.src(source+mobile+'**/*.js')
  .pipe(gulp.dest(prod+mobile))
});


gulp.task('mobile-languages', function() {
  return gulp.src(source+mobile_lang+'**/*')
  .pipe(gulp.dest(prod+mobile_lang));
});
