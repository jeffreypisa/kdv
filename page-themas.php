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

$args = array(
  'post_type'			  => 'artikelen',
  'posts_per_page'  => -1,
);
    
$context['posts'] = Timber::get_posts($args);

Timber::render( array( 'archive-themas.twig' ), $context );