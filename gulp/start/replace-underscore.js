
	gulp.task('replace-underscore', function(){
		return gulp.src( source + '**/*.*' )
			.pipe( replace( origname + "_", argv.start + "_" ) )
			.pipe( gulp.dest( source ) );
	});