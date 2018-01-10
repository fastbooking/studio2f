<footer class="footer">
	<div class="footer-social">
		<div class="footer-social_logo">
			<i class="icon-logo"></i>
		</div>
		<ul class="footer-social_list">
			<li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#" title="instagram"><i class="fa fa-instagram"></i></a></li>
		</ul>
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
