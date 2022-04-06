<?php // Our custom post type function
  
  
function create_posttype() {
	
	register_post_type( 'artikelen',
	
		array(
			'labels' => array(
				'name'                  => __( 'Artikelen' ),
				'singular_name'         => __( 'Artikel' ),
				'all_items'             => __( 'Alle artikelen' ),
				'add_new_item'          => __( 'Nieuw artikel toevoegen' ),
				'new_item'              => __( 'Nieuw artikel' ),
				'add_new'               => __( 'Nieuw artikel' ),
				'edit_item'             => __( 'Bewerk artikel' ),
				'update_item'           => __( 'Update artikel' ),
				'view_item'             => __( 'Bekijk artikel' ),
				'search_items'          => __( 'Zoek artikel' ),
			),
			'menu_icon'           		=> 'dashicons-text',
			'public' 					=> true,
			'show_in_rest' 				=> true,
			'has_archive'             	=> false,
			'rewrite' 					=> array( 'slug' => 'themas/%artikelen_category%', 
			'with_front' 	=> false ),
			'supports'                	=> array( 'title', 'editor', 'thumbnail' )
		)
	);
	
	register_post_type( 'auteurs',
	
		array(
			'labels' => array(
				'name'                  => __( 'Auteurs' ),
				'singular_name'         => __( 'Auteur' ),
				'all_items'             => __( 'Alle auteurs' ),
				'add_new_item'          => __( 'Nieuwe auteur toevoegen' ),
				'new_item'              => __( 'Nieuwe auteur' ),
				'add_new'               => __( 'Nieuwe auteur' ),
				'edit_item'             => __( 'Bewerk auteur' ),
				'update_item'           => __( 'Update auteur' ),
				'view_item'             => __( 'Bekijk auteur' ),
				'search_items'          => __( 'Zoek auteur' ),
			),
			'menu_icon'           		=> 'dashicons-edit',
			'public' 					=> true,
			'show_in_rest' 				=> true,
			'has_archive'             	=> true,
			'rewrite' 					=> array( 'slug' => 'artikelen/%artikelen_category%', 
			'with_front' 	=> false ),
			'supports'                	=> array( 'title', 'editor' )
		)
	);
	
}

add_action( 'init', 'create_posttype' ); 

?>