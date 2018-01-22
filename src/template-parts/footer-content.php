<?php
	global $data;
	$facebook = $data["facebook"];
	$twitter  = $data["twitter"];
	$instagram  = $data["instagram"];
?>
<footer class="footer">
	<div class="footer-social">
		<div class="footer-social_logo">
			<i class="icon-logo"></i>
		</div>
		<?php if ( ! empty( $facebook ) || ! empty( $twitter ) || ! empty( $instagram ) ) : ?>
		<ul class="footer-social_list">
			<?php if ( ! empty( $facebook ) ) : ?>
			<li><a href="<?php echo $facebook ?>" title="facebook"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if ( ! empty( $twitter ) ) : ?>
			<li><a href="<?php echo $twitter ?>" title="twitter"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if ( ! empty( $instagram ) ) : ?>
			<li><a href="<?php echo $instagram ?>" title="instagram"><i class="fa fa-instagram"></i></a></li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>
	</div>
	<div class="footer-link">
		<?php 
            wp_nav_menu([
                'theme_location' => 'footer', 
                'container' => '',
            ]); 
        ?>
	</div>
</footer>
