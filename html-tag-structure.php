<!-- Start header.php -------------------------------------- -->
<?php 
/**
 * The header template.
 * 
 * @package Hermi
 * 
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

	<div id="page" class="site">
		
		<header id="header" class="site-header">
		</header><!-- #header -->



		<div id="content" class="site-content">
			<?php // get_header(); ------------------------------------- ?>

			
			<div id="content-inner" class="site-content-inner">


				<div class="layout-content-sidebar">

					<div class="layout-primary">
				
						<main id="main" class="site-main">

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-content">
									<div class="row">
										<div class="large-12 columns">
											<?php the_content(); ?>
										</div><!-- .large-12 .columns -->
									</div><!-- .row -->
								</div><!-- .entry-content -->
							</article><!-- #post-{id} -->

						</main><!-- .main-content .site-main -->
						
					</div><!-- .layout-primary -->
					

					<div class="layout-secondary">
						<aside id="main-widget-area" class="main-widget-area sidebar widget-area">
							<ul class="xoxo js-masonry">
								<?php dynamic_sidebar( 'main-widget-area' ); ?>
							</ul>
						</aside>
					</div><!-- .layout-secondary -->
				</div><!-- layout-content-sidebar (.row) -->
				
				
			</div><!-- .site-content-inner -->


			<?php // get_footer(); ------------------------------------- ?>
		</div><!-- .site-content -->

		<footer id="footer" class="site-footer">
			<?php do_action( 'hermi_footer' ); ?>
		</footer><!-- .site-footer -->

	</div><!-- .site -->

	
<?php //wp_footer(); ?>
</body>
</html>
<!-- End footer.php -------------------------------------- -->		