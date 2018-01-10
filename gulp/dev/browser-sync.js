var source= require('../config').source
var dev   = require('../config').dev
var proxy = require('../config').proxy
var tpl   = require('../config').tpl

var dev_watch_tpl_assets = require('../dev/base-functions.js').dev_watch_tpl_assets

gulp.task('browser-sync', ['build'], function() {

  browserSync.init({
    proxy: proxy,
    online: true,
    open: false,
    browser: ["google chrome"]
  });

  gulp.watch(source+'scss/*.scss', ['core-css', 'core-css-all']);
  gulp.watch(source+"**/*.php").on("change", browserSync.reload);
  gulp.watch(source+'**/*(*.png|*.jpg|*.jpeg|*.gif|*.ico|*.svg)', ['images']).on("change", browserSync.reload);
  gulp.watch(source+'mobile/**/*.scss', ['mobile-css']);
  gulp.watch(source+'mobile/**/*.js', ['mobile-js']);

  for(var index in tpl) {
    var dir = tpl[index];
    dev_watch_tpl_assets( dir );
    // console.log( '---[bsync] ' + dir );
  }

});