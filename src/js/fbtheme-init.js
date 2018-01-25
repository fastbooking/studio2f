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
	// showDateMonths();
	
	var ing_format_date    = "d M yy";
	var ing_form_el        = '.js_qs-form';
	var ing_checkin_el     = '.js_qs-form__checkin';
	var ing_checkout_el    = '.js_qs-form__checkout';
	var ing_submit_el      = '.js_qs-form__submit';
	var ing_hotel_el       = '.js_qs-form__hotel';
	var ing_fb_be_url      = 'https://www.book-secure.com/index.php?';
	var ing_fb_format_date = 'yy-mm-dd';

	$( ing_checkin_el ).datepicker({
		showOtherMonths:   true,
		selectOtherMonths: true,
		dateFormat:        ing_format_date,
		minDate:           0,
		beforeShow:        function (textbox, instance) {
			instance.dpDiv.removeClass('mobile-right-tip');
		},
		onClose: function(){
			$( ing_checkout_el ).datepicker('show');
		}
	}).on( "change", function() {
		$( ing_checkout_el ).datepicker( "option", "minDate", ing_get_date( this ) );
	});

	$( ing_checkout_el ).datepicker({
		showOtherMonths:   true,
		selectOtherMonths: true,
		dateFormat:        ing_format_date,
		minDate:           0,
		beforeShow:        function (textbox, instance) {
			instance.dpDiv.addClass('mobile-right-tip');
		}
	}).on( "change", function() {
		$( ing_checkin_el ).datepicker( "option", "maxDate", ing_get_date( this ) );
	});

	$(window).resize(function(){
		$( ing_checkin_el ).datepicker( "refresh" );
		$( ing_checkout_el ).datepicker( "refresh" );

		if( $(window).width() > 1024 ){
			$( ing_checkin_el ).datepicker( "option", "numberOfMonths", 2 );
			$( ing_checkout_el ).datepicker( "option", "numberOfMonths", 2 );
		}else{
			$( ing_checkin_el ).datepicker( "option", "numberOfMonths", 1 );
			$( ing_checkout_el ).datepicker( "option", "numberOfMonths", 1 );
		}
	}).resize();

	$( ing_submit_el ).click( function( event ) {
		event.preventDefault();
		if ( $('.js_qs-form__hotel').val() != null ) {
			$('.js_qs-form__hotel').removeClass('error');
			// open new tab
			$url_obj = ing_get_fb_be_obj();
			ing_fb_be_open_in_new_tab( $url_obj );

		}else {
			$('.js_qs-form__hotel').addClass('error');
		}
		
	});

	function ing_get_fb_be_obj () {

		var form_data = ing_form_data_obj();

		var ing_submit_checkin = ing_get_date_by_format(
			ing_format_date, ing_fb_format_date, form_data.qs_form__checkin );
		var ing_submit_checkout = ing_get_date_by_format(
			ing_format_date, ing_fb_format_date, form_data.qs_form__checkout );

		var ing_fb_be_obj = {
			'arrival'          : ing_submit_checkin,
			'departure'        : ing_submit_checkout,
			'qs_hidden'        : 1,
			'locale'           : ing_get_locale(),
			'currency'         : 'USD'
		};

		if ( 'All' == form_data.qs_form__hotel ) {
			ing_fb_be_obj['s']     = 'group';
			ing_fb_be_obj['group'] = $( ing_hotel_el ).find(':selected').data('cname');
		} else {
			ing_fb_be_obj['s']        = 'results';
			ing_fb_be_obj['property'] = form_data.qs_form__hotel;
		}

		return ing_fb_be_obj;
	}

	function ing_get_date( element ) {
		var date;
		try {
			date = $.datepicker.parseDate( ing_format_date, element.value );
		} catch( error ) {
			date = null;
		}
		return date;
	}

	function ing_fb_be_open_in_new_tab ( obj ) {
		var url = ing_fb_be_url + ing_obj_to_url_params( obj );
		ing_open_in_new_tab( url );
	}

	function ing_get_date_by_format( date_format_before, date_format_after, date_str ) {
		if ( ! date_format_before ||
		     ! date_format_after ) {
			return;
		}

		return $.datepicker.formatDate(
			date_format_after,
			$.datepicker.parseDate( date_format_before, date_str )
		);
	}

	function ing_form_data_obj () {
		var form_data = $( ing_form_el ).serializeArray().reduce(function(obj, item) {
			obj[item.name] = item.value;
			return obj;
		}, {});
		// console.log( form_data )
		return form_data;
	}

	function ing_obj_to_url_params ( obj ) {
		return Object.keys( obj ).map( function ( key ) {
			return encodeURIComponent( key ) + '=' + encodeURIComponent( obj[ key ] );
		} ).join( '&' );
	}

	function ing_open_in_new_tab ( url ) {
		var win = window.open( url, '_blank' );
		win.focus();
	}

	function ing_get_locale () {
		var languages = {
			'id'      : 'id_ID',
			'ja'      : 'ja_JP',
			'en'      : 'en_GB',
			'zh-hans' : 'zh_Hans_CN',
			'zh-hant' : 'zh_Hant_HK'
		};
		return languages[ icl_vars.current_language ] || 'en_GB';
	}

});