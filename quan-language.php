<?php
/**
 * Plugin Name: Quan Language Taxonomy
 * Plugin URI: http://www.quandigital.com/
 * Description: Adds a language taxonomy to posts
 * Version: 1.0.0
 * License: MIT
 */

// Register Custom Taxonomy
function custom_taxonomy()  {

	$labels = array(
		'name'                       => _x( 'Languages', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Language', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Language', 'text_domain' ),
		'all_items'                  => __( 'All Languages', 'text_domain' ),
		'parent_item'                => __( 'Parent Language', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Language:', 'text_domain' ),
		'new_item_name'              => __( 'New Language Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Language', 'text_domain' ),
		'edit_item'                  => __( 'Edit Language', 'text_domain' ),
		'update_item'                => __( 'Update Language', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate languages with commas', 'text_domain' ),
		'search_items'               => __( 'Search languages', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove languages', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used languages', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'language', 'post', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy');


// remove the add new language button from the backend
function quan_remove_add_new( $hook ) {
	if( $hook != 'post.php' && $hook != 'post-new.php' ) {
		return;
	}
	
	wp_enqueue_script( 'quan_lang', plugin_dir_url( __FILE__ ) .  'quan-lang.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'admin_enqueue_scripts', 'quan_remove_add_new' );