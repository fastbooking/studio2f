<?php
/**
Template Name: Home
*/

get_header(); ?>

<div class="main" id="main">
<?php
    get_template_part('template-parts/boxes/home', 'intro');
    get_template_part('template-parts/boxes/home', 'offers');
    get_template_part('template-parts/boxes/home', 'service');
?>
</div>

<?php get_footer(); ?>