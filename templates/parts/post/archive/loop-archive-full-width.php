<?php/** * Template part for displaying the loop on archive pages with content spanning the full width of the viewport. * * @package Hermi * @since Hermi 0.1.0 */if ( ! defined( 'ABSPATH' ) ) {	exit; // Exit if accessed directly}?><?php do_action( 'hermi_content_before' ); ?><main id="main-content" class="site-main">	<?php		do_action( 'hermi_content_top' );		get_template_part( 'templates/parts/post/archive/archive-heading-container' );				if ( have_posts() ) {			do_action( 'hermi_content_while_before' );			while ( have_posts() ) {				the_post();				/*				 * Include the Post-Format-specific template for the content.				 * If you want to override this in a child theme, then include a file				 * called content-post-full-width-___.php (where ___ is the Post Format name) and that will be used instead.				 */				get_template_part( 'templates/parts/post/content-post-full-width', get_post_format() );			}			do_action( 'hermi_content_while_after' );		} else if ( is_search() ) {				get_template_part( 'templates/parts/search/content-search-empty' );		} else {				get_template_part( 'templates/parts/error/content-error' );		}		get_template_part( 'templates/parts/pagination/pagination-archive' );				do_action( 'hermi_content_bottom' );	?></main><!-- .main-content --><?php do_action( 'hermi_content_after' ); ?>