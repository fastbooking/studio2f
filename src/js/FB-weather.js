/*
* FB's implementation of SimpleWeather
* http://simpleweatherjs.com/
*
* Prerequisites: jquery, moment (all in core.js)
*
* Markup format:
*		<div class="js_weather" data-city="$city" data-country="$country" data-time="$time"></div>
*
* Refer to hv_get_weather()
* https://github.com/fastbooking/holidayvilla/blob/dev/src/inc/hv-utilities.php
*/

#=include ../../bower/simpleWeather/jquery.simpleWeather.js

$( document ).ready(function() {
	weatherInit();
} );

function weatherInit() {
	$( '.js_weather' ).each( function () {
		getWeather( this );
	} );
}

// -----------------------------------------
// Current Time in City
// -----------------------------------------
function getCurrentTime( city, country ) {
	var timezone = {
		'japan'       : 9,
		'korea'       : 9,
		'china'       : 8,
		'indonesia'   : 8,
		'taiwan'      : 8,
		'thailand'    : 7,
		'vietnam'     : 7,
		'palau'       : 9,
		'germany'     : 1,
		'netherlands' : 1,
		'guam'        : 10,
		'usa'         : {
			'Hawaii'        : -10,
			'San Francisco' : -8
		},

	};

	var offset = timezone[ country ] || 0;

	if ( typeof offset === 'object' ) {
		offset = timezone[ country ][ city ] || 0;
	}

	offset += isDST( city );

	return moment().utcOffset( offset );
}


function isDST( city ) {
	if ( city !== 'San Francisco' && city !== 'Düsseldorf' && city !== 'Amsterdam' ) {
		return 0;
	}

	var dst_dates = {
		'2016' : {
			'start' : 'Mar 13 2016',
			'end'   : 'Nov 6 2016'
		},
		'2017' : {
			'start' : 'Mar 12 2017',
			'end'   : 'Nov 5 2017'
		},
		'2018' : {
			'start' : 'Mar 11 2018',
			'end'   : 'Nov 4 2018'
		},
		'2019' : {
			'start' : 'Mar 10 2019',
			'end'   : 'Nov 3 2019'
		},
		'2020' : {
			'start' : 'Mar 8 2020',
			'end'   : 'Nov 1 2020'
		},
		'2021' : {
			'start' : 'Mar 14 2021',
			'end'   : 'Nov 1 2021'
		}
	};

	var moment_format  = 'MMM D YYYY';
	var full_year      = moment().format( 'YYYY' );
	var dst_date       = dst_dates[ full_year ] || dst_dates[ full_year - 6 ];
	var dst_start_date = moment( dst_date[ 'start' ], moment_format );
	var dst_end_date   = moment( dst_date[ 'end' ], moment_format );
	var today          = moment();

	if ( city === 'Düsseldorf' || city === 'Amsterdam' ) {
		dst_start_date.add( 14, 'days' );
		dst_end_date.subtract( 7, 'days' );
	}

	return moment().isBetween( dst_start_date, dst_end_date );
}

function getWeather( el ) {
	// NOTE: Test all city's availability for weather
	// before release
	var city         = $( el ).data( 'city' );
	var country      = $( el ).data( 'country' );
	var show_time    = $( el ).data( 'time' );
	var current_city = {
		'jogja'     : 'Yogyakarta',
		'singapore' : 'Singapore, Singapore',
		'guam'      : 'Tamuning, Guam',
		'palau'     : 'Koror, Palau',
		'yomitan'   : 'Yomitan-son, Japan',
		'karuizawa' : 'Karuizawa-machi, Japan',
		'okuma'     : 'Kunigami-son, Japan',
		'fukuoka'   : 'Fukuoka-shi, Japan',
		'kochi'     : 'Kochi-shi, Japan',
		'niigata'   : 'Niigata-shi, Japan',
		'sendai'    : 'Sendai-shi, Japan',
		'osaka'     : 'Osaka-shi, Japan',
		'aomori'    : 'Aomori-shi, Japan',
		'kisarazu'  : 'Kisarazu-shi, Japan',
		'chiba'     : 'Chiba-shi, Japan',
		'himeji'    : 'Himeji-shi, Japan',
		'hiroshima' : 'Hiroshima-shi, Japan',
		'kobe'      : 'Kobe-shi, Japan',
		'tsukuba'   : 'Tsukuba-shi, Japan',
		'kagoshima' : 'Kagoshima-shi, Japan',
		'ebina'     : 'Ebina-shi, Japan',
		'kanazawa'  : 'Kanazawa-shi, Japan',
		'kawasaki'  : 'Kawasaki-shi, Japan',
		'asahi'     : 'Asahi-shi, Japan',
		'kumamoto'  : 'Kumamoto-shi, Japan',
		'kyoto'     : 'Kyoto-shi, Japan',
		'matsumaya' : 'Matsumaya-shi, Japan',
		'miyazaki'  : 'Miyazaki-shi, Japan',
		'nagano'    : 'Nagano-shi, Japan',
		'nagasaki'  : 'Nagasaki-shi, Japan',
		'narita'    : 'Narita-shi, Japan',
		'obihiro'   : 'Obihiro-shi, Japan',
		'naha'      : 'Naha-shi, Japan',
		'hamamatsu' : 'Hamamatsu-shi, Japan',
		'yokohama'  : 'Yokohama-shi, Japan',
		'macau'     : 'Macau, Macau'
	}

	var weather_city = current_city[ city.toLowerCase() ] || city;

	$.simpleWeather( {
		'location' : weather_city,
		'unit'     : 'c',
		'success'  : function ( weather ) {
			// Display time only if data-time attr is 1
			var now       = new Date();
			var format    = 'MMM D ddd';
			var separator = ', '

			if ( show_time ) {
				now       = getCurrentTime( city, country );
				format    = 'H:mm';
				separator = ' ';
			}

			$( el ).html( '<span class="weather-city js_weather-city"></span><span class="weather-date js_weather-date"></span><span class="weather-icon js_weather-icon"><i class="wi"></i></span><span class="weather-temp js_weather-temp"></span>' );
			$( el ).find( '.js_weather-city' ).text( city + separator );
			$( el ).find( '.js_weather-date' ).text( moment( now ).format( format ) + ' ' );
			$( el ).find( '.js_weather-icon > i' ).addClass( 'wi-yahoo-' + weather.code );
			$( el ).find( '.js_weather-temp' ).html( ' ' + weather.temp + '&deg;' + weather.units.temp + ' | ' + weather.alt.temp + '&deg;' + weather.alt.unit );
		}
	} );
}
