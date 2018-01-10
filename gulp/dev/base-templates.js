var source = require('../config').source
var dev    = require('../config').dev
var path   = require('path')
var glob   = require('glob')
var tpl    = require('../config').tpl

tpl_folders = glob.sync(source+'tpl-*').forEach(function( dir ) {
  dir_base = path.basename( dir );
  add_dir = [ dir_base ];
  tpl.push.apply(tpl, add_dir);
});

dev_task_tpl = function() {

  var dev_task_css = require('../dev/base-functions.js').dev_task_css
  var dev_task_js  = require('../dev/base-functions.js').dev_task_js
  var dev_task_php = require('../dev/base-functions.js').dev_task_php

  for(var index in tpl) {
    var dir = tpl[index];

    dev_task_css(
        dir+'-css'
      , [source+dir+'/'+dir+'*.scss', '!'+source+dir+'/_*.scss'] // Ignore partials
      , dev+ dir
    );

    dev_task_js(
        dir+'-js'
      , [source+dir+'/'+dir+'*.js', '!'+source+dir+'/_*.js' ]
      , dev+ dir
    );

    dev_task_php (
        dir+'-php'
      , source+dir+'/'+dir
      , dev+ dir
    );
  }

}
dev_task_tpl()