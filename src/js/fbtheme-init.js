$( document ).ready( function () {

	setTimeout( function (){
		$( 'html' ).removeClass( 'hidden' );
	}, 300);
	$('[data-scroll-to]').on('click',function(e){
		e.preventDefault();
		var target = '#' + $(this).attr('data-scroll-to');
		$('html, body').animate({scrollTop: $(target).offset().top + 'px'}, 500);
	});
	$('[data-chosen-lang]').on('click',function(){
		$('html').toggleClass('open-menu');
		$('.header-language_box').toggleClass('show');
	});
	initMap('map-canvas');
});