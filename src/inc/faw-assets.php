<?php
/**
 * Add Base JS
 */
global $locale;
$locales = array(
    'en' => 'en_GB',
    'fr' => 'fr_FR',
    'de' => 'de_DE',
    'it' => 'it_IT',
    'ru' => 'ru_RU',
    'es' => 'es_ES',
    'pt-pt' => 'pt_PT'
);
$locale = isset($locales[ICL_LANGUAGE_CODE]) ? $locales[ICL_LANGUAGE_CODE] : 'en_GB';
define( 'WEBSDK_LOCALE', $locale );

if ( ! function_exists( 'hh_enqueue_libs_js' ) ) {
	function hh_enqueue_libs_js() {
		$js_path = "//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui{$GLOBALS['rojak_templates_minify']}.js";
		wp_register_script( 'jqueryui', $js_path, array(), '', true );
		wp_enqueue_script(  'jqueryui' );

		$js_path = "//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap{$GLOBALS['rojak_templates_minify']}.js";
		wp_register_script( 'bootstrap', $js_path, array(), '', true );
		wp_enqueue_script(  'bootstrap' );
	}
}
add_action( 'rojak_tpl_before_core_js', 'hh_enqueue_libs_js' );

