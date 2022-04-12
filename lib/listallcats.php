<?php
function get_sorted_categories() {

	// Get categories
	$cat_args   = array(
		'hide_empty'=>false, 
		'parent'=> 20
	);
	$categories = get_categories( $cat_args );

	if ( $categories ) {

		// Store category heirarchy
		$cat_data = array();

		// build data array.
		foreach ( $categories as $cat ) {

			$cat_data[ $cat->term_id ] = array(
				'name'     => $cat->cat_name,
				'snippet'  => $cat->cat_description,
				'link'     => get_category_link( $cat->term_id ),
				'children' => array(),
			);

			// Child categories
			$cat_args_child   = array(
				'hide_empty'=>false, 
				'parent'=> $cat->term_id
			);
			$child_categories = get_categories( $cat_args_child );
			if ( $child_categories ) {

				foreach ( $child_categories as $child_cat ) {
					$cat_data[ $cat->term_id ]['children'][]  = array(
						'name'     => $child_cat->cat_name,
						'snippet'  => $child_cat->cat_description,
						'link'     => get_category_link( $child_cat->term_id ),
					);
				}

			}
				
		}
		return $cat_data;
	}

	return false

}
?>