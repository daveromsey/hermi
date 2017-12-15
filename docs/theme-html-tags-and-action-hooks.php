<!-- Start header.php -------------------------------------- -->
<!DOCTYPE html>
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

	<div id="page" class="site">

		<?php do_action( 'hermi_header_before' ); ?>
		<header id="header" class="site-header">
			<?php
				do_action( 'hermi_header_top' );
				do_action( 'hermi_header' );
				do_action( 'hermi_header_bottom' );
			?>
		</header><!-- #header -->
		<?php do_action( 'hermi_header_after' ); ?>


		<?php do_action( 'hermi_header_before' ); ?>
		<div id="content" class="site-content">
			<?php do_action( 'hermi_content_top' ); ?>
<!-- End header.php -------------------------------------- -->


<!-- Start index.php -------------------------------------- -->
			<?php do_action( 'hermi_content_inner_before' ); ?>
			<div id="content-inner" class="site-content-inner">
				<?php do_action( 'hermi_content_inner_top' ); ?>


<!-- Start <?php // get_template_part( 'templates/parts/archive/layout', 'content-sidebar' ); ?> -------------------------------------- -->
				<?php if ( is_active_sidebar( 'main-widget-area' ) ) { ?>
					<div class="layout-content-sidebar">

						<div class="layout-grid">
							<div class="layout-primary">


<!-- Start <?php // get_template_part( 'templates/parts/archive/loop-archive' ); ?> -------------------------------------- -->
								<?php do_action( 'hermi_content_before' ); ?>
								<main id="main-content" class="site-main">
									<?php
										do_action( 'hermi_content_top' );

										get_template_part( 'templates/parts/archive/title-archive' );

										if ( have_posts() ) {
											while ( have_posts() ) {
												the_post(); ?>


<!-- Start <?php // get_template_part( 'templates/parts/content/format', hermi_get_post_format_name() ); ?> -------------------------------------- -->
											<?php do_action( 'hermi_entry_before' ); ?>
											<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
												<?php do_action( 'hermi_entry_top' ); ?>

												<?php
													get_template_part( 'templates/parts/entry-sticky' );

													if ( ! is_search() ) {
														get_template_part( 'templates/parts/entry-featured-image' );
													}

													get_template_part( 'templates/parts/entry-title' );

													get_template_part( 'templates/parts/entry-meta-primary' );
												?>

												<div class="entry-content">
													<div class="grid-x">
														<div class="cell small-12">
															<?php
																// Only show excerpts when showing search results.
																if ( is_search() ) {
																	the_excerpt();
																} else {
																	the_content( hermi_read_more_link() );
																	wp_link_pages();
																}
															?>
														</div><!-- .cell .small-12 -->
													</div><!-- .grid-x -->
												</div><!-- .entry-content -->

												<?php
													get_template_part( 'templates/parts/entry-meta-secondary' );
												?>

												<?php do_action( 'hermi_entry_bottom' ); ?>
											</article><!-- #post-{id} -->
											<?php do_action( 'hermi_entry_after' ); ?>

											<?php
											}
										}

										do_action( 'hermi_content_bottom' );
									?>
								</main><!-- .main-content -->

								<?php get_template_part( 'templates/parts/navigation/pagination-archive' ); ?>
								<?php do_action( 'hermi_content_after' ); ?>

							</div><!-- .layout-primary -->

							
							<div class="layout-secondary">
							
<!-- Start <?php // get_template_part( 'templates/parts/sidebar/sidebar', 'main' ); ?> -------------------------------------- -->
								<?php do_action( 'hermi_sidebars_before' ); ?>
								<aside id="main-widget-area" class="main-widget-area sidebar widget-area">
									<ul class="xoxo js-masonry">
										<?php
											do_action( 'hermi_sidebar_top' );

											dynamic_sidebar( 'main-widget-area' );

											do_action( 'hermi_sidebar_bottom' );
										?>
									</ul>
								</aside>
								<?php do_action( 'hermi_sidebars_after' ); ?>

							</div><!-- .layout-secondary -->

						</div><!-- .layout-grid -->
						
					</div><!-- .layout-content-sidebar -->



				<?php do_action( 'hermi_content_inner_bottom' ); ?>
			</div><!-- .site-content-inner -->
			<?php do_action( 'hermi_content_inner_after' ); ?>
<!-- End index.php -------------------------------------- -->



<!-- Start footer.php -------------------------------------- -->
			<?php do_action( 'hermi_site_content_bottom' ); ?>
		</div><!-- .site -->
		<?php do_action( 'hermi_site_content_after' ); ?>


		<?php do_action( 'hermi_footer_before' ); ?>
		<footer id="footer" class="site-footer">
			<?php
				do_action( 'hermi_footer_top' );
				do_action( 'hermi_footer' );
				do_action( 'hermi_footer_bottom' );
			?>
		</footer><!-- .site-footer -->
		<?php do_action( 'hermi_footer_after' ); ?>


		<?php do_action( 'hermi_site_bottom' ); ?>
	</div><!-- .site -->
	<?php do_action( 'hermi_site_after' ); ?>


<?php do_action( 'hermi_body_bottom' ); ?>
<?php wp_footer(); ?>
</body>
</html>
<!-- End footer.php -------------------------------------- -->