var source = require('../config').source
  , prod   = require('../config').prod
  , tpl    = require('../config').tpl
;

var prod_watch_tpl_assets = require('../prod/base-functions.js').prod_watch_tpl_assets
var prod_watch_tpl_php    = require('../prod/base-functions.js').prod_watch_tpl_php

gulp.task('watch', ['build'], function() {

  gulp.watch(source+'scss/**/*.scss', ['core-css', 'core-css-all']);
  gulp.watch([source+'js/**/*.js', bower+'**/*.js'], ['core-js-min']);
  gulp.watch(source+'**/*(*.png|*.jpg|*.jpeg|*.gif)', ['images']);
  gulp.watch([source+'**/*.php', '!'+source+'tpl-*/*.php'], ['watch-php']);
  gulp.watch(source+'languages/*.*', ['languages']);
  gulp.watch(source+'mobile/**/*.*', ['mobile']);

  for(var index in tpl) {
    prod_watch_tpl_php( tpl[index] );
    prod_watch_tpl_assets( tpl[index] );
    // console.log( '---[watch] ' + tpl[index] );
  }

});