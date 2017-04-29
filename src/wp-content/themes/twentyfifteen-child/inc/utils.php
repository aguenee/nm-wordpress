<?php

/**
 * Display pagination for custom query
 * @param int $numpages
 * @param int $pagerange
 * @param int $paged
 */
function custom_pagination( $numpages = '', $pagerange = '', $paged = '' ) {
	if ( empty($pagerange) ) {
		$pagerange = 2;
	}

	/**
	* This first part of our function is a fallback
	* for custom pagination inside a regular loop that
	* uses the global $paged and global $wp_query variables.
	* 
	* It's good because we can now override default pagination
	* in our theme, and use this function in default quries
	* and custom queries.
	*/
	global $paged;

	if ( empty($paged) ) {
		$paged = 1;
 	}

 	if ( $numpages == '' ) {
    	global $wp_query;
    	$numpages = $wp_query->max_num_pages;

    	if ( !$numpages ) {
        	$numpages = 1;
    	}
  	}

	/** 
	 * We construct the pagination arguments to enter into our paginate_links
	 * function. 
	 */
	$pagination_args = array(
		//'base'			=> get_pagenum_link(1) . '%_%',
		'format'		=> 'page/%#%',
		'total'			=> $numpages,
		'current'		=> $paged,
		'show_all'		=> false,
		'end_size'		=> 1,
		'mid_size'		=> $pagerange,
		'prev_next'		=> true,
		'prev_text'		=> __( '&laquo;' ),
		'next_text'		=> __( '&raquo;' ),
		'type'			=> 'plain',
		'add_args'		=> false,
		'add_fragment'	=> ''
	);

	$paginate_links = paginate_links($pagination_args);

	if ( $paginate_links ) {
		echo "<nav class='custom-pagination'>";
			echo $paginate_links;
			echo "<span class='page-numbers page-num'>" .
				__( 'Page', 'twentyfifteen-child' ) . " " . $paged . " " . __( 'of', 'twentyfifteen-child' ) . " " . $numpages . 
				"</span>";
		echo "</nav>";
  	}
}

/**
 * Get featured posts
 * @param int|WP_Post $post
 * @param array $terms
 * @param bool $random (optional, default false)
 * @param int $nbPosts (optional, default 2)
 * @return array
 */
function get_featured_posts( $post, $terms, $random = false, $nbPosts = 2 ) {
	$otherPosts = get_posts( array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'post_type'        => $post->post_type,
        'post_status'      => 'publish',
        'exclude'		   => array( $post->ID )
	) );
	
	$featuredPosts = array();

	foreach ( $otherPosts as $otherPost ) {
		$otherPostCategories = wp_get_post_categories( $otherPost->ID );
		$otherPostTags = wp_get_post_terms( $otherPost->ID, 'post_tag', array( 'fields' => 'ids' ) );

		if ( !empty( array_intersect( $terms['categories'], $otherPostCategories ) ) ||			
			 !empty( array_intersect( $terms['tags'], $otherPostTags ) ) )
		{
			$featuredPosts[] = $otherPost;
		}
	}

	if ( $random && $nbPosts < count( $featuredPosts ) ) {
		$randomFeaturedPosts = array();
		$randomIndexes = array_rand( $featuredPosts, $nbPosts );
		foreach ( $randomIndexes as $randomIndex ) {
			$randomFeaturedPosts[] = $featuredPosts[$randomIndex];
		}
		
		return $randomFeaturedPosts;				
	}

	return $featuredPosts;
}

/**
 * Get post's categories
 * @param int|WP_Post $post
 * @return array
 */
function get_post_categories( $post ) {
	$postCategories = wp_get_post_categories( $post->ID );
	$categories = [];

	foreach ( $postCategories as $index => $categoryID ) {
		 $category = get_category( $categoryID );
		 $categories[] = $category;
	}

	return $categories;
}

/**
 * Sort items hierarchically
 * @param $a
 * @param $b
 * @return int
 */
function sort_hierarchically( $a, $b ) {
	$itemA = get_post( pll_get_post( $a, $locale ) );
	$itemB = get_post( pll_get_post( $b, $locale ) );

    if ( $itemA->menu_order == $itemB->menu_order ) {
        return 0;
    }

    return ( $itemA->menu_order < $itemB->menu_order ) ? -1 : 1;
}