<?php /* Template Name: login */ ?>
<?php get_header();?>

<main id="contact" class="login-wrapper" style="background-image: url(<?php the_post_thumbnail_url(); ?>);width: 100%;">
	<?php
		$args=array(
			'redirect' => home_url(),
		);

		wp_login_form($args);
	?>
</main>

<?php get_footer();?>