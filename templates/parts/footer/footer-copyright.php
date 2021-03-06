<?php
/**
 * Template part used for displaying the copyright message in the footer.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	
<div class="footer-copyright-wrap">

	<div class="grid-x">
		<div class="cell small-12">
		
			<div class="copyright">
				<div>
					<span class="date">&copy; <?php echo esc_html( date( 'Y' ) ); ?> </span>
					
					<a href="<?php echo esc_attr( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<span class="site-name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
					</a>
				</div>
			</div>
			
		</div><!-- .cell .small-12 -->
	</div><!-- .grid-x -->
</div><!-- .footer-copyright-wrap -->