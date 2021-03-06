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
	<?php the_custom_logo(); ?>
	<h1 hidden><?php bloginfo('name') ?></h1>
</header>