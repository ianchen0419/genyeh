<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
	<title><?php bloginfo('name'); wp_title('|'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	<link rel="stylesheet prefetch" href="<?php bloginfo('template_directory') ?>/style.css" />
	<link rel="stylesheet prefetch" href="<?php bloginfo('template_directory') ?>/mobile.css" media="screen and (max-width: 782px)" />
</head>
<body>
<?php wp_footer(); ?>

<header id="header">
	<table width="100%">
		<tr>
			<td>
				<?php the_custom_logo(); ?>
				<h1 hidden><?php bloginfo('name') ?></h1>
			</td>
			<td align="right">
				<nav>
					<?php
						if(is_user_logged_in() && is_front_page()==false){
							wp_nav_menu(array('theme_location' => 'header')); 	
						}
						
					?>
				</nav>
			</td>
		</tr>
	</table>
	
</header>