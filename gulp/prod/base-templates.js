var source = require('../config').source
  , prod   = require('../config').prod
  , path   = require('path')
  , glob   = require('glob')
  , tpl    = require('../config').tpl
;

tpl_folders = glob.sync(source+'tpl-*').forEach(function( dir ) {
  dir_base = path.basename( dir );
  add_dir = [ dir_base ];
  tpl.push.apply(tpl, add_dir);
});

prod_task_tpl = function() {

  var prod_task_css    = require('../prod/base-functions.js').prod_task_css
  var prod_task_js     = require('../prod/base-functions.js').prod_task_js
  var prod_task_js_min = require('../prod/base-functions.js').prod_task_js_min
  var prod_task_php    = require('../prod/base-functions.js').prod_task_php

  for(var index in tpl) {
    var dir = tpl[index];

    prod_task_css(
        dir+'-css'
      , [source+dir+'/'+dir+'*.scss', '!'+source+dir+'/_*.scss'] // Ignore partials
      , prod+ dir
    );

    prod_task_js_min(
        dir+'-js-min'
      , [dir+'-js']
      , [prod+ dir +'/*.js', '!'+prod+ dir +'/*.min.js']
      , prod+ dir +'/'
    );

    prod_task_js(
        dir+'-js'
      , [source+dir+'/'+dir+'*.js', '!'+source+dir+'/_*.js' ]
      , prod+ dir
    );

    prod_task_php(
        dir+'-php'
      , source+dir+'/'+dir
      , prod+ dir
    );

  }

}
prod_task_tpl()
