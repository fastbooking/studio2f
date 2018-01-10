$(document).ready(function() {
	if($('.js-hero-slider').length){
		$('.js-hero-slider').slick({
		  dots: false,
		  infinite: true,
		  speed: 600,
		  slidesToShow: 1,
		  autoplay: true,
		  fade: true
		});
	}

} )
