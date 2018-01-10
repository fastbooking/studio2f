var source = require('../config').source
var react  = require('../config').react
var tpl    = require('../config').tpl
var path   = require('path')
var glob   = require('glob')
var fs     = require('fs')


tpl_folders = glob.sync(source+'tpl-*').forEach(function( dir ) {
  dir_base = path.basename( dir );

	var react_src = react+dir_base+'.js';
	if( fs.existsSync(react_src) ) {
	  add_dir = [ dir_base ];
	  tpl.push.apply(tpl, add_dir);
	}

});