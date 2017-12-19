<?php 
/**
 * The theme's header.php template.
 * 
 * @package Hermi
 */ ?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta class="foundation-mq">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body id="body" <?php body_class(); ?>>
<?php do_action( 'hermi_body_top' ); ?>

	<?php do_action( 'hermi_site_before' ); ?>
	<div id="page" class="site-page">
		<?php do_action( 'hermi_site_top' ); ?>
		
		<?php do_action( 'hermi_header_before' ); ?>
		<header id="header" class="site-header">
			<?php 
				do_action( 'hermi_header_top' );
				do_action( 'hermi_header' );
				do_action( 'hermi_header_bottom' );
			?>
		</header><!-- #header -->
		<?php do_action( 'hermi_header_after' ); ?>
			
			
		<?php do_action( 'hermi_site_content_before' ); ?>
		<div id="content" class="site-content">
			<?php do_action( 'hermi_site_content_top' ); ?>
