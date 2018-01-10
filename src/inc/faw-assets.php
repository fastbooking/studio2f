<?php
/**
 * Add Base JS
 */
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