<?php
/**
 * Template part for displaying comments navigation links.
 */ ?>

<div class="comments-nav-previous">
	<?php
		previous_comments_link( apply_filters( 'hermi_previous_comments_link_label',
			sprintf( '<i></i> %1$s', __( 'Older Comments', 'hermi' ) )
		) );
	?>
</div>

<div class="comments-nav-next">
	<?php	
		next_comments_link( apply_filters( 'hermi_next_comments_link_label',
			sprintf( '%1$s <i></i>', __( 'Newer Comments', 'hermi' ) )
		) );
	?>
</div>