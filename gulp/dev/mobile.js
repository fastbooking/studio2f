var source      = require('../config').source
var bower       = require('../config').bower
var lazypipe    = require('lazypipe')
var sass        = require('gulp-sass')
var autopref    = require('gulp-autoprefixer')
var dev         = require('../config').dev
var mobile      = 'mobile/'
var mobile_css  = mobile + 'css/'
var mobile_lang = mobile + 'languages/'

var dev_sass_error = require('../dev/base-functions.js').dev_sass_error

var dev_mobile_sass = lazypipe()
  .pipe(sass, {includePaths: [bower, source+'scss', source+mobile_css], errLogToConsole: true})
  .pipe(autopref, 'last 2 versions', 'ie 9', 'ios 6', 'android 4');


gulp.task('mobile', ['mobile-js', 'mobile-style-css', 'mobile-css' ]);

gulp.task('mobile-css',  function() {
  return gulp.src([source+mobile_css+'*.scss', '!'+source+mobile_css+'_*.scss'])
    .pipe( dev_mobile_sass().on('error', dev_sass_error))
    .pipe(gulp.dest(dev+mobile_css))
    .pipe(browserSync.stream());
});

gulp.task('mobile-style-css', function() {
  return gulp.src(source+mobile+'*.css')
  .pipe(gulp.dest(dev+mobile))
  .pipe(browserSync.stream());
});


gulp.task('mobile-js', function() {
  return gulp.src(source+mobile+'**/*.js')
  .pipe(gulp.dest(dev+mobile))
  .pipe(browserSync.stream());
});

gulp.task('mobile-languages', function() {
  return gulp.src(source+mobile_lang+'**/*')
  .pipe(gulp.dest(dev+mobile_lang));
});

