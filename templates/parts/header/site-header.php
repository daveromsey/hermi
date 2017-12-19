<?php 
/**
 * Template part that outputs the site's <header> element.
 * 
 */ 

do_action( 'hermi_header_before' ); ?>
<header id="header" class="site-header">
	<?php 
		do_action( 'hermi_header_top' );
		do_action( 'hermi_header' );
		do_action( 'hermi_header_bottom' );
	?>
</header><!-- #header -->
<?php do_action( 'hermi_header_after' ); ?>
