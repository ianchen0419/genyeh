	
	<?php if(is_user_logged_in()){ ?>
		<nav id="quick">
			<?php wp_nav_menu(array('theme_location' => 'quick')); ?>
		</nav>
	<?php } ?>
	<footer id="footer" class="has-text-align-center has-black-background-color has-white-color">Copyrights © <?php bloginfo('name') ?>. All Rights Reserved.</footer>
	
</body>
</html>