<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;


$terms = get_the_terms( $post->ID, 'artikelen_themas' );
if ( !empty( $terms ) ){
  // get the first term
  $term = array_shift( $terms );
  $term_id = $term->term_id;
}

$ancestors = get_ancestors( $term_id, 'artikelen_themas' ); // Get a list of ancestors
$ancestors = array_reverse($ancestors); //Reverse the array to put the top level ancestor first
$ancestors[0] ? $top_term_id = $ancestors[0] : $top_term_id = $term_id; //Check if there is an ancestor, else use id of current term
$term = get_term( $top_term_id, 'artikelen_themas' ); //Get the term
$top_term_id = $term->term_id;

$args = array(
  'post_type'			  => 'artikelen',
  'post__not_in' => array( get_the_ID() ),
  'posts_per_page'  => 3,
  'cat'     => $top_term_id
);
    
$context['artikelen'] = Timber::get_posts($args);
    
if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}