<?php
/*
  Template Name: Reportages
*/

get_header();


// Get sort parameter
$sortby = $_GET['sortby'] ? $_GET['sortby'] : 'date_desc';
$sortInfos = explode( '_', $sortby );
$orderby = $sortInfos[0];
$order = $sortInfos[1];

// Get reportages
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$reportages = new WP_Query( array(
	'orderby'		 => $orderby,
	'order'          => $order,
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
		<section class="row transitions-enabled fluid masonry js-masonry grid" id="">
			<?php while ( $reportages->have_posts() ) :
				// Post
				$reportage = get_post( $reportages->the_post() );
	        	// Tags
	        	$tags = wp_get_post_tags( $reportage->ID );
        		// Categories
				$categories = get_post_categories( $reportage );
			?>
				<div class="col-sm-4 col-md-4 grid-item">
					<article class="thumbnail thumbnail-reportage">
						<div class="content">
							<div class="corner">
								<a href="#" class="triangle triangle-top-right"></a>
								<span class="label"><i class="material-icons">add</i></span>
							</div>

							<div class="image">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large' ); ?>
								<?php else: ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/reportage-cover.jpg" alt="<?php echo $reportage->post_title; ?>" />
								<?php endif; ?>
							</div>

							<h2 class="title"><?php echo $reportage->post_title; ?></h2>
							<a class="see-more-link" href="<?php echo get_permalink( $reportage ); ?>" title="<?php echo $reportage->post_title; ?>">
								<?php echo __( 'Read the reportage', 'twentyfifteen-child' ); ?>
							</a>
							<a class="see-more-link-area" href="<?php echo get_permalink( $reportage ); ?>" title="<?php echo __( 'Read the reportage', 'twentyfifteen-child' ); ?>"></a>
						</div>
						<div class="footer">
							<?php foreach ( $categories as $index => $category ) : ?>
								<a href="<?php echo get_category_link( $category ); ?>" class="category">
									<i class="material-icons">local_offer</i><?php echo $category->name; ?>
								</a>&nbsp;
							<?php endforeach; ?>
							<?php foreach ( $tags as $index => $tag ) : ?>
								<a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
							<?php endforeach; ?>
						</div>
					</article>
				</div>
			<?php endwhile; ?>
	 	</section>

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