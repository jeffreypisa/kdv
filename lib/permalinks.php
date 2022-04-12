<?php

// Set permalink structure 

add_action( 'generate_rewrite_rules', 'register_product_rewrite_rules' );
function register_product_rewrite_rules( $wp_rewrite ) {
	$new_rules = array( 
		'themas/([^/]+)/?$' => 'index.php?artikelen_themas=' . $wp_rewrite->preg_index( 1 ), // 'themas/any-character/'
		'themas/([^/]+)/([^/]+)/?$' => 'index.php?post_type=artikelen&artikelen_themas=' . $wp_rewrite->preg_index( 1 ) . '&artikelen=' . $wp_rewrite->preg_index( 2 ), // 'themas/any-character/post-slug/'
		'themas/([^/]+)/([^/]+)/page/(\d{1,})/?$' => 'index.php?post_type=artikelen&artikelen_themas=' . $wp_rewrite->preg_index( 1 ) . '&paged=' . $wp_rewrite->preg_index( 3 ), // match paginated results for a sub-category archive
		'themas/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?post_type=artikelen&artikelen_themas=' . $wp_rewrite->preg_index( 2 ) . '&artikelen=' . $wp_rewrite->preg_index( 3 ), // 'themas/any-character/sub-category/post-slug/'
		'themas/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?post_type=artikelen&artikelen_themas=' . $wp_rewrite->preg_index( 3 ) . '&artikelen=' . $wp_rewrite->preg_index( 4 ), // 'themas/any-character/sub-category/sub-sub-category/post-slug/'
	);
	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}


// A hacky way of adding support for flexible custom permalinks
// There is one case in which the rewrite rules from register_kb_rewrite_rules() fail:
// When you visit the archive page for a child section(for example: http://example.com/faq/category/child-category)
// The deal is that in this situation, the URL is parsed as a Knowledgebase post with slug "child-category" from the "category" section
function fix_product_subcategory_query($query) {
	if ( isset( $query['post_type'] ) && 'artikelen' == $query['post_type'] ) {
		if ( isset( $query['artikelen'] ) && $query['artikelen'] && isset( $query['artikelen_themas'] ) && $query['artikelen_themas'] ) {
			$query_old = $query;
			// Check if this is a paginated result(like search results)
			if ( 'page' == $query['artikelen_themas'] ) {
				$query['paged'] = $query['name'];
				unset( $query['artikelen_themas'], $query['name'], $query['artikelen'] );
			}
			// Make it easier on the DB
			$query['fields'] = 'ids';
			$query['posts_per_page'] = 1;
			// See if we have results or not
			$_query = new WP_Query( $query );
			if ( ! $_query->posts ) {
				$query = array( 'artikelen_themas' => $query['artikelen'] );
				if ( isset( $query_old['artikelen_themas'] ) && 'page' == $query_old['artikelen_themas'] ) {
					$query['paged'] = $query_old['name'];
				}
			}
		}
	}
	return $query;
}
add_filter( 'request', 'fix_product_subcategory_query', 10 );

function filter_post_type_link($link, $post)
{
	if ($post->post_type != 'artikelen')
		return $link;

	if ($cats = get_the_terms($post->ID, 'artikelen_themas'))
	{
		$link = str_replace('%artikelen_themas%', get_taxonomy_parents(array_pop($cats)->term_id, 'artikelen_themas', false, '/', true), $link); // see custom function defined below\
		$link = str_replace('//', '/', $link);
		$link = str_replace('https:/', 'https://', $link);
	}
	return $link;
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2);

// my own function to do what get_category_parents does for other taxonomies
function get_taxonomy_parents($id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array()) {    
	$chain = '';   
	$parent = &get_term($id, $taxonomy);

	if (is_wp_error($parent)) {
		return $parent;
	}

	if ($nicename)    
		$name = $parent -> slug;        
else    
		$name = $parent -> name;

	if ($parent -> parent && ($parent -> parent != $parent -> term_id) && !in_array($parent -> parent, $visited)) {    
		$visited[] = $parent -> parent;    
		$chain .= get_taxonomy_parents($parent -> parent, $taxonomy, $link, $separator, $nicename, $visited);

	}

	if ($link) {
		// nothing, can't get this working :(
	} else    
		$chain .= $name . $separator;    
	return $chain;    
}