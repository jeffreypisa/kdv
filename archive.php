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

$term = get_queried_object();
$parent = ( isset( $term->parent ) ) ? get_term_by( 'id', $term->parent, 'artikelen_themas' ) : false;

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

$qobj = get_queried_object();

$args_cp = array(
    'post_type' => 'artikelen',
    'posts_per_page' => -1,
    'paged' => $paged,
    'tax_query' => array(
        array(
          'taxonomy' => $qobj->taxonomy,
          'field' => 'id',
          'terms' => $qobj->term_id,
    //    using a slug is also possible
    //    'field' => 'slug', 
    //    'terms' => $qobj->name
        )
      )
);

$context['posts'] = new Timber\PostQuery($args_cp);
     
if( $parent ) {
    $context['title'] = get_queried_object()->name;
    
    Timber::render( array( 'archive-project.twig' ), $context );
    
} else {
    $terms = \Timber::get_terms(array('taxonomy' => 'artikelen_themas', 'hide_empty' => true, 'parent' => 0));
    $context['categories'] = $terms;
    $context['search'] = get_search_query();
    
    Timber::render( array( 'archive-themas.twig' ), $context );

}