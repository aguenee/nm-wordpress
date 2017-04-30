<?php
/*
  Template Name: Stories
*/

get_header();


// Get sort parameter
$sortby = $_GET['sortby'] ? $_GET['sortby'] : 'date_desc';
$sortInfos = explode( '_', $sortby );
$orderby = $sortInfos[0];
$order = $sortInfos[1];

// Get stories
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$stories = new WP_Query( array(
	'orderby'		 => $orderby,
	'order'          => $order,
	'posts_per_page' => POSTS_PER_PAGE * 2,
	'paged' 		 => $paged,
	'post_type' 	 => 'story',
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
					<h2 class="current-page"><?php echo __( 'Stories', 'twentyfifteen-child' ); ?></h2>
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

	<!-- Stories -->
	<?php if ( $stories->have_posts() ) : ?>
		<section class="row transitions-enabled fluid masonry js-masonry grid bb-custom-grid" id="bb-custom-grid">

			<?php while ( $stories->have_posts() ) :
				// Post
				$story = get_post( $stories->the_post() );
				// Publication date
				$publicationDate = new DateTime( $story->post_date );
				// Description
	        	$description = wp_strip_all_tags( get_post_field( 'post_content', $story ) );
	        	$description = strlen( $description ) > 100 ? mb_substr( $description, 0, 100 ) . '...' : $description;
	        	// Tags
	        	$tags = wp_get_post_tags( $story->ID );
	    		// Categories
				$categories = get_post_categories( $story );
			?>
				<div class="col-sm-4 col-md-4 grid-item">
					<article class="thumbnail thumbnail-story bb-custom-item">
						<div class="content">
							<div class="corner">
								<a href="#" class="triangle triangle-top-right"></a>
								<span class="label"><i class="material-icons">add</i></span>
							</div>
							<h2 class="title"><?php echo $story->post_title; ?></h2>
							<div class="bb-bookblock">
							<?php $nbCoverImages = 0; ?>
							<?php for ( $i = 1; $i <= 3; ++$i ) { ?>
								<?php $coverImage = get_field( 'carousel_picture_' . $i, $story ); ?>
								<?php if ( !$coverImage ) { break; } ?>
								<div class="bb-item">
									<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $story->post_title; ?>" />
								</div>
								<?php $nbCoverImages++; ?>
							<?php } ?>
							</div>
							<?php if ( $nbCoverImages > 1 ) : ?>
								<nav>
									<?php for ( $j = 1; $j <= $nbCoverImages; ++$j ) { ?>
										<span class="<?php echo $j === 1 ? 'bb-current' : ''; ?>"></span>
									<?php } ?>
								</nav>
							<?php endif; ?>
							<!--<small class="publication-date"><?php echo $publicationDate->format('d/m/Y'); ?></small>-->
							<p class="description"><?php echo $description; ?></p>
							<a class="see-more-link" href="<?php echo get_permalink( $story ); ?>" title="<?php echo $story->post_title; ?>">
								<?php echo __( 'Read the story', 'twentyfifteen-child' ); ?>
							</a>
							<a class="see-more-link-area" href="<?php echo get_permalink( $story ); ?>" title="<?php echo __( 'Read the story', 'twentyfifteen-child' ); ?>"></a>
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
			        <?php custom_pagination( $stories->max_num_pages, '', $paged ); ?>
			    </div>
		    </div>
      	<?php endif; ?>

	<?php endif ?>
	<?php wp_reset_postdata(); ?>

	</main>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(document).ready(function() {

		var $grid = $( '#bb-custom-grid' );

		$grid.find( 'div.bb-bookblock' ).each( function( i ) {
			
			var $bookBlock = $( this ),
				$nav = $bookBlock.next().children( 'span' ),
				bb = $bookBlock.bookblock( {
					speed : 600,
					shadows : false
				} );
				
			// add navigation events
			$nav.each( function( i ) {
				$( this ).on( 'click touchstart', function( event ) {
					var $dot = $( this );
					$nav.removeClass( 'bb-current' );
					$dot.addClass( 'bb-current' );
					$bookBlock.bookblock( 'jump', i + 1 );
					return false;
				} );
			} );
			
			// add swipe events
			$bookBlock.children().on( {
				'swipeleft' : function( event ) {
					$bookBlock.bookblock( 'next' );
					return false;
				},
				'swiperight' : function( event ) {
					$bookBlock.bookblock( 'prev' );
					return false;
				}

			} );
			
		} );

	});
</script>