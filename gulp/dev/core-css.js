var source= require('../config').source
  , dev   = require('../config').dev
;
var dev_task_css = require('../dev/base-functions.js').dev_task_css

dev_task_css(
    'core-css'
  , [source+'scss/*.scss', '!'+source+'scss/_*.scss'] // Ignore partials
  , dev
);
