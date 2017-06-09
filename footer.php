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
}
?>

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
