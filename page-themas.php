<?php
/**
* Template Name: Thema's
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
    

$context = Timber::get_context();

$post = new TimberPost();
$context['post'] = $post;

/* Load categories */

$terms = \Timber::get_terms(array('taxonomy' => 'artikelen_themas', 'hide_empty' => true, 'parent' => 0));
$context['categories'] = $terms;

$paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
  
$args = array(
  'post_type'			  => 'artikelen',
  'posts_per_page'  => -1,
  'paged' => $paged
);
    
$context['posts'] = Timber::get_posts($args);
  
/* Load categories */

$terms = \Timber::get_terms(array('taxonomy' => 'artikelen_themas', 'hide_empty' => true, 'parent' => 0));
$context['categories'] = $terms;

Timber::render( array( 'archive-themas.twig' ), $context );