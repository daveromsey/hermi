<?php
/**
 * Template part for outputting the header for various post archives.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Bail right away if this isn't one of the following types of archives:
if ( ! is_search()   && 
		 ! is_category() &&
		 ! is_tag()      &&
		 ! is_date()     &&
		 ! is_author() ) {
	return;
}

?>

<header class="archive-header">

	<div class="row">
		<div class="large-12 columns">

			<h1 class="archive-heading">
				<?php
					if ( is_search() ) {
						printf( '<span class="current-archive-label">%1$s</span> <span class="search-terms current-archive-name">%2$s</span>',
												__( 'Search Results for:', 'hermi' ), esc_html( get_search_query() ) ); 

					} elseif ( is_category() ) { 
						printf( '<span class="current-archive-label">%1$s</span> <span class="current-archive-name">%2$s</span>',
												__( 'Category Archives:', 'hermi' ), single_cat_title( '', false ) ); 

					} elseif ( is_tag() ) { 
						printf( '<span class="current-archive-label">%1$s</span> <span class="current-archive-name">%2$s</span>',
												__( 'Tag  Archives:', 'hermi' ), single_cat_title( '', false ) ); 

					} elseif ( is_date() ) {
						if ( is_day() ) {
							printf( '<span class="current-archive-label">%1$s</span> <span class="current-archive-name">%2$s</span>',
													__( 'Archives by Day:', 'hermi' ), get_the_date() ); 

						} elseif ( is_month() ) {
							printf( '<span class="current-archive-label">%1$s</span> <span class="current-archive-name">%2$s</span>',
													__( 'Archives by Month:', 'hermi' ), get_the_date( 'F Y' ) ); 

						} elseif ( is_year() ) {
							printf( '<span class="current-archive-label">%1$s</span> <span class="current-archive-name">%2$s</span>',
													__( 'Archives by Year:', 'hermi' ), get_the_date( 'Y' ) ); 
						}
						
					} elseif ( is_author() ) {
						$current_author = get_query_var( 'author_name' ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) ); 
						if ( have_posts() ) { 
							printf( '<span class="current-archive-label">%1$s</span> <span class="current-archive-name">%2$s</span>',
													__( 'Author Archives: ', 'hermi' ), esc_html( $current_author->display_name ) ); 
						} else { 
							printf( '<span class="current-archive-name">%1$s</span> <span class="current-archive-label">%2$s</span>',
													esc_html( $current_author->display_name ), __( 'has not published an article yet.', 'hermi' ) ); 
						}
					}
				?>
			</h1><!-- .archive-heading -->
			
		</div><!-- row -->
	</div><!-- .large-12 columns -->
	
</header><!-- .archive-header -->