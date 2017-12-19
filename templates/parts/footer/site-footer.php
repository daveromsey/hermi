<?php 
/**
 * Template part that outputs the site's <footer> element.
 * 
 */ 

do_action( 'hermi_footer_before' ); ?>
<footer id="footer" class="site-footer">
	<?php
		do_action( 'hermi_footer_top' );
		do_action( 'hermi_footer' ); 
		do_action( 'hermi_footer_bottom' );
	?>
</footer><!-- .site-footer -->
<?php do_action( 'hermi_footer_after' ); ?>
