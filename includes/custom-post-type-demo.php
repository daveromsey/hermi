<?php
/**
 * Register post type to demonstrate template functionality.
 * 
 * Once post type has been registered, add some posts. Then review
 * the single-cptdemo.php and archive-cptdemo.php templates for an
 * examples of how to implement post type templates.
 *
 * This is for demonstration purposes only. Post type registration
 * should typically be handled by a plugin.
 */
add_action( 'init', 'hermi_custom_post_type_template_demo' );
function hermi_custom_post_type_template_demo() {
	register_post_type( 'cptdemo', [
			'label'              => __( 'Custom Post Type Demo', 'hermi' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => 'cptdemo' ],
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ],
			//'taxonomies'         => [ 'category' ],
	] );
}
