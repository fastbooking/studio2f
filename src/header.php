<!DOCTYPE html>
<html <?php language_attributes(); ?> class="hidden">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

<script>var $studio2let_url = "<?php echo trailingslashit(get_bloginfo('wpurl')); ?>";</script>
<?php wp_head(); ?>
<style>html.hidden { visibility: hidden; }</style>
<noscript>
  This page needs JavaScript activated to work.
  <style>html.hidden { visibility: visible; }</style>
</noscript>
<!-- START Add google fonts ex:Playfair -->
<script type="text/javascript">
  	WebFontConfig = {
		google: { families: [ 'Playfair Display:300,400,500,700:latin' ] }
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
  	})(); 
	var	theme_dir = '<?php echo get_stylesheet_directory_uri(); ?>';

</script>
<!-- END Add google fonts -->
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
<?php 
	get_template_part('template-parts/header-box');
?>
