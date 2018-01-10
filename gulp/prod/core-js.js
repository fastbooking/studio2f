var source= require('../config').source
  , prod   = require('../config').prod
;
var prod_task_js  = require('../prod/base-functions.js').prod_task_js
var prod_task_js_min  = require('../prod/base-functions.js').prod_task_js_min

prod_task_js_min(
    'core-js-min'
  , ['core-js']
  , [prod+'js/**/*.js', '!'+prod+'js/**/*.min.js']
  , prod+'js/'
);

prod_task_js(
		'core-js'
	, [source+'js/*.js', '!'+source+'js/_*.js'] // Ignore partials
	, prod+'js'
);