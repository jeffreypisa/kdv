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
		'show_in_rest' 			=> true,
		'query_var'         => true,
		'rewrite' 			=> array('slug' => 'themas' )
	);

  register_taxonomy('artikelen_themas', array('artikelen'), $args);

}


add_action( 'init', 'create_tag_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
	  
  'name'              => _x( 'Tags', 'taxonomy general name' ),
  'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
  'search_items'      => __( 'Zoek tags' ),
  'popular_items' => __( 'Populare tags' ),
  'all_items'         => __( 'Alle tags' ),
  'parent_item' => null,
  'parent_item_colon' => null,
  'edit_item'         => __( 'Bewerk tag' ),
  'update_item'       => __( 'Update tag' ),
  'add_new_item'      => __( 'Nieuwe tag toevoegen' ),
  'new_item_name'     => __( 'Naam nieuwe tag' ),
  'menu_name'         => __( 'Tags' ),
  'separate_items_with_commas' => __( 'Separate tags with commas' ),
  'add_or_remove_items' => __( 'Add or remove tags' ),
  'choose_from_most_used' => __( 'Choose from the most used tags' ),
	'menu_name' => __( 'Tags' ),
  ); 

  register_taxonomy('artikelen_tags', 'artikelen', array(
	'hierarchical' => false,
	'labels' => $labels,
	'show_in_rest' => true,
	'show_ui' => true,
	'update_count_callback' => '_update_post_term_count',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'tags' ),
  ));
}