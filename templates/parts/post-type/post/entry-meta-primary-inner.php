<?php
/**
 * Template part for displaying inner primary meta for posts.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
 
<ul class="entry-meta-primary-inner entry-meta">
	<li class="post-date-meta"><i></i> <?php echo hermi_posted_on(); ?></li>
	<li class="by-author-meta"><i></i> <?php echo hermi_posted_by(); ?></li>
	<?php hermi_comments_meta( '<li class="comments-meta meta-label"><i></i> ', '</li>' ); ?>
</ul><!-- .entry-meta-primary-inner .entry-meta -->