<?php
	
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_artikelen_themas_tax', 0 );
function create_artikelen_themas_tax() {

	$labels = array(
		'name'              => _x( 'Projecten', 'taxonomy general name' ),
		'singular_name'     => _x( 'Project', 'taxonomy singular name' ),
		'search_items'      => __( 'Zoek project' ),
		'all_items'         => __( 'Alle projecten' ),
		'parent_item'       => __( 'Parent project' ),
		'parent_item_colon' => __( 'Parent project' ),
		'edit_item'         => __( 'Bewerk project' ),
		'update_item'       => __( 'Update project' ),
		'add_new_item'      => __( 'Nieuw project toevoegen' ),
		'new_item_name'     => __( 'Naam nieuw project' ),
		'menu_name'         => __( 'Projecten' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite' 			=> array('slug' => 'themas' )
	);

  register_taxonomy('artikelen_themas', array('artikelen'), $args);

}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_artikelen_tags_tax', 0 );
function create_artikelen_tags_tax() {

	$labels = array(
		'name'              => _x( 'Tags', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
		'search_items'      => __( 'Zoek tags' ),
		'all_items'         => __( 'Alle tags' ),
		'parent_item'       => __( 'Parent tag' ),
		'parent_item_colon' => __( 'Parent tag' ),
		'edit_item'         => __( 'Bewerk tag' ),
		'update_item'       => __( 'Update tag' ),
		'add_new_item'      => __( 'Nieuwe tag toevoegen' ),
		'new_item_name'     => __( 'Naam nieuwe tag' ),
		'menu_name'         => __( 'Tags' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite' 			=> array('slug' => 'tags' )
	);

  register_taxonomy('artikelen_tags', array('artikelen'), $args);

}