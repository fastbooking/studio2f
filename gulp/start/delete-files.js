gulp.task('delete-files', function() {
	var del   = require('del');
	return del([ source + "**/" + origname + "*.*"  ]);
});