<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$context = Timber::get_context();
 
 $post = new TimberPost();
 $context['post'] = $post;
 
 /* Load categories */
 $postcatid = get_queried_object()->term_id;
 $context['current_category'] = $postcatid;
 
 $terms = \Timber::get_terms(array('taxonomy' => 'artikelen_themas', 'hide_empty' => true, 'parent' => 0));
 $context['categories'] = $terms;

     
 $context['posts'] = Timber::get_posts();
 
 Timber::render( array( 'archive-themas.twig' ), $context );