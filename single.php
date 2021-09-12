<?php 
	$user=wp_get_current_user();
	$meta_info=get_post_meta($post->ID, 'user', true);
	$user_login=$user->user_login;
	if(user_can($user, 'administrator')==true){

	}else if($user_login==$meta_info){
		
	}else{
		wp_redirect(home_url(''));
	}

	$thumbnail;
	if(has_post_thumbnail()) {
		$thumbnail="background: url(".get_the_post_thumbnail_url().")";
	}

?>
<?php get_header();?>

<div id="visual" class="has-blue-background-color" style="<?php echo $thumbnail; ?>">
	<div class="page-title">
		<div class="wrapper-size">
			<h1 class="has-white-color has-text-align-center has-large-font-size"><?php the_title(); ?></h1>
		</div>
	</div>
</div>
<main id="contact">
	
	<?php
		while(have_posts()): the_post();
			the_content();
		endwhile;
	?>
</main>


<?php get_footer();?>