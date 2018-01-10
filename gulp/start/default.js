gulp.task('default', function(callback) {

	var run = require('run-sequence');
	run(
		'rename-files',
		'replace-single-quotes',
		'replace-underscore',
		'replace-domain',
		'replace-title',
		'replace-hyphen',
		'delete-files',
		callback
	);

});