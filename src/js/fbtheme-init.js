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
	showDateMonths();
	
});
function showDateMonths() {
	var w = $( window ).width();
	var date_check_in = $( '.js_qs__checkin' );
	var date_check_out = $( '.js_qs__checkuot' );


	if(w > 991) {
		if( date_check_in.length){
			date_check_in.datepicker({
				numberOfMonths: 2
			});
		}

		if( date_check_out.length){
			date_check_out.datepicker({
				numberOfMonths: 2
			});
		}
	}else {
		if( date_check_in.length){
			date_check_in.datepicker({
				numberOfMonths: 1
			});
		}

		if( date_check_out.length){
			date_check_out.datepicker({
				numberOfMonths: 1
			});
		}
	}
}