<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package studio2let
 */

get_header(); ?>

<?php get_template_part( 'template-parts/hero', 'page' ); ?>

<?php get_template_part( 'template-parts/breadcrumb' ); ?>

<div class="two-col hotel-list__body">
	<div class="two-col--layout-center section--layout-center o_layout-center">

		<div class="two-col__sidebar sidebar hotel-list__sidebar js_sidebar">

		</div>

		<div class="two-col__content hotel-list__hotels">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_format() );

			endwhile; // End of the loop.
			?>

		</div>

	</div>
</div>

<?php get_footer();