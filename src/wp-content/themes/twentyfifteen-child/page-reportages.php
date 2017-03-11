<?php
/*
  Template Name: Reportages
*/

get_header();


// Get sort parameter
$sortby = $_GET['sortby'] ? $_GET['sortby'] : 'date_desc';
$sortInfos = explode( '_', $sortby );
$orderby = $sortInfos[0] == 'date' ? 'meta_value' : $sortInfos[0];
$order = $sortInfos[1];

// Get reportages
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$reportages = new WP_Query( array(
	//'meta_key'		 => 'book_publication_date',
	'orderby'		 => 'date', //$orderby,
	'order'          => 'DESC', //$order,
	'posts_per_page' => POSTS_PER_PAGE,
	'paged' 		 => $paged,
	'post_type' 	 => 'reportage',
	'post_status' 	 => 'publish',
	'post_parent'	 => 0
) );

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">

		<section class="row">
			<!-- Breadcrumb -->
			<div class="col-sm-6 col-md-6">
				<div class="breadcrumb">
					<h2 class="current-page"><?php echo __( 'Reportages', 'twentyfifteen-child' ); ?></h2>
				</div>
			</div>
			<!-- Sorting -->
			<div class="col-sm-6 col-md-6">
				<form class="sorting" action="" method="GET">
					<img class="loader hidden" src="<?php echo get_stylesheet_directory_uri(); ?>/img/loader.gif ?>" alt="" />
					<label for="sortby"><?php echo __( 'Sort by', 'twentyfifteen-child' ); ?>&nbsp;</label>
					<select id="sortby" name="sortby">
						<option value="date_desc" <?php echo $sortby == 'date_desc' ? 'selected' : ''; ?>>
							<?php echo __( 'Date: descending', 'twentyfifteen-child' ); ?>
						</option>
						<option value="date_asc" <?php echo $sortby == 'date_asc' ? 'selected' : ''; ?>>
							<?php echo __( 'Date: ascending', 'twentyfifteen-child' ); ?>
						</option>
						<option value="title_asc" <?php echo $sortby == 'title_asc' ? 'selected' : ''; ?>>
							<?php echo __( 'Title: A->Z', 'twentyfifteen-child' ); ?>
						</option>
						<option value="title_desc" <?php echo $sortby == 'title_desc' ? 'selected' : ''; ?>>
							<?php echo __( 'Title: Z->A', 'twentyfifteen-child' ); ?>
						</option>
					</select>
				</form>
			</div>
		</section>

	<!-- Reportages -->
	<?php if ( $reportages->have_posts() ) : ?>
		<?php while ( $reportages->have_posts() ) :
				// Post
				$reportage = get_post( $reportages->the_post() );
				// Cover
				//$coverImage = get_field( 'book_cover_image', $book );
				// Authors
				//$authors = get_field( 'book_authors', $book, false );
				// Publication date
				//$publicationDate = new DateTime( get_field( 'book_publication_date', $book, false ) );
				// Description
	        	//$description = wp_strip_all_tags( get_post_field( 'post_content', $book ) );
	        	//$description = strlen( $description ) > 370 ? mb_substr( $description, 0, 370 ) . '...' : $description;
	        	// Tags
	        	$tags = wp_get_post_tags( $reportage->ID );
        		// Categories
				$categories = get_post_categories( $reportage );
		?>
			
		<?php endwhile; ?>

		<!-- Pagination -->
		<?php if ( function_exists( custom_pagination ) ) : ?>
			<div class="row">
				<div class="col-sm-12 col-md-12">
			        <?php custom_pagination( $reportages->max_num_pages, '', $paged ); ?>
			    </div>
		    </div>
      	<?php endif; ?>
      	
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	</main>
</div>

<?php get_footer(); ?>