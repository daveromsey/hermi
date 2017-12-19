<?php
/**
 * The theme's footer template.
 *
 * @package hermi
 * @since hermi 0.1.0
 */ 
 
// Exit if accessed directly 
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
} ?>

			<?php do_action( 'hermi_site_content_bottom' ); ?>
		</div><!-- .site-content -->
		<?php do_action( 'hermi_site_content_after' ); ?>

		<?php
			// Template part that handles the site's <footer> element.
			get_template_part( 'templates/parts/footer/site-footer' );
		?>

		<?php do_action( 'hermi_site_bottom' ); ?>
	</div><!-- .site-page -->
	<?php do_action( 'hermi_site_after' ); ?>
	
<?php do_action( 'hermi_body_bottom' ); ?>
<?php wp_footer(); ?>
</body>
</html>