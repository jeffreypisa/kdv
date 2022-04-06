<?php 

include 'lib/menu.php';
include 'lib/acf.php';
include 'lib/cpt.php';
include 'lib/ctax.php';
include 'lib/gutenberg.php';
include 'lib/includes.php';
include 'lib/optionspage.php';
include 'lib/svg.php';
include 'lib/timber.php';
include 'lib/videoembed.php';
include 'lib/wpadmin.php';

// Set permalink structure projecten

function wpa_artikelen_permalinks( $post_link, $post ){
	if ( is_object( $post ) && $post->post_type == 'artikelen' ){
		$terms = wp_get_object_terms( $post->ID, 'artikelen_themas' );
		if( $terms ){
			return str_replace( '%artikelen_category%' , $terms[0]->slug , $post_link );
		}
	}
	return $post_link;
}
add_filter( 'post_type_link', 'wpa_artikelen_permalinks', 1, 2 );