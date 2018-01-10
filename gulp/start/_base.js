source   = require('../config').source;
replace  = require('gulp-replace');
origname = "";

str_replace = function (str, find, replace) {
	return str.replace(new RegExp(find, 'g'), replace);
}

capitalize_first_letter = function (string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
