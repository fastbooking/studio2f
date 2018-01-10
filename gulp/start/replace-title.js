	gulp.task('replace-title', function(){
		var origtitle = capitalize_first_letter( origname );
		var newtitle  = capitalize_first_letter( argv.start );
		return gulp.src( source + '**/*.*' )
			.pipe( replace(" "+ origtitle, " "+ newtitle ) )
			.pipe( gulp.dest( source ) );
	});