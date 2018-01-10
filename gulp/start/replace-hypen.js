
	gulp.task('replace-hyphen', function(){
		return gulp.src( source + '**/*.*' )
			.pipe( replace( origname + "-", argv.start + "-" ) )
			.pipe( gulp.dest( source ) );
	});