<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fbtheme
 */

// before wp_head, make sure to remove yoast meta
// if hotel page
global $FB_CHENDOL;
if ( $FB_CHENDOL->current_hotel ) {
	remove_all_actions('wpseo_head');
}

get_header();

$url = trailingslashit( get_bloginfo( 'wpurl' ) ); ?>

<div class="hero hero_404">
	<div class="hero_404__content">
		<h1 class="hero_404__heading">404</h1>
		<h4 class="hero_404__texts"><?php _e( 'Oops.. It seems the page you are looking for does not exist. Please go back to our <a href="' . $url . '">homepage.</a>', 'fbtheme' ) ?></h4>
	</div>
</div>

<?php get_footer();