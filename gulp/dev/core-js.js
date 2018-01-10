var source= require('../config').source
  , dev   = require('../config').dev
;
var dev_task_js  = require('../dev/base-functions.js').dev_task_js

dev_task_js(
	  'core-js'
	, [source+'js/*.js', '!'+source+'js/_*.js'] // Ignore partials
	, dev+'js'
);
