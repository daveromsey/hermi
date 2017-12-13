<?php
/**
 * The template for displaying search forms.
 *
 * @package Hermi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_attr( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'screen reader search label', 'hermi' ); ?></span>
		
		<div class="input-group">
			<input type="search" class="search-field input-group-field"
				placeholder="<?php echo esc_attr_x( 'Search...', 'search placeholder', 'hermi' ); ?>" 
				name="s" value="<?php echo get_search_query(); ?>"
				title="<?php echo esc_attr_x( 'Search for:', 'search title attribute', 'hermi' ); ?>" />
			
			<div class="input-group-button">
				<button type="submit" class="mdi-search search-submit button" value="<?php
					echo esc_attr_x( 'Search', 'search button', 'hermi' ); ?>"></button>
			</div>
		</div><!-- .input-group -->
	</label>
</form>