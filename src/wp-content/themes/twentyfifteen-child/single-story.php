<?php
/*
  Template Name: Story
*/

get_header();

// Start the loop.
while ( have_posts() ) : the_post();

	// Children of current page
	$args = array(
		'post_parent' => $post->ID,
		'post_type'   => 'story',
		'numberposts' => -1,
		'post_status' => 'publish'
	);
	$children = get_children( $args );
	usort( $children, 'sort_hierarchically' );

	// Ancestors of current page
	$ancestors = get_post_ancestors( $post );
	usort( $ancestors, 'sort_hierarchically' );

	// Always get the first page
	if ( empty($ancestors) ) {
		$firstPage = get_post( $post->ID );
	} elseif ( count($ancestors) >= 1 ) {
		$firstPage = get_post( $ancestors[0] );
	}

	// All story's pages
	$allPages = get_pages( array(
		'sort_order' => 'asc',
		'sort_column' => 'menu_order',
		'hierarchical' => true,
		'child_of' => $firstPage->ID,
		'parent' => -1,
		'offset' => 0,
		'post_type' => 'story',
		'post_status' => 'publish'
	) );
	array_unshift( $allPages, $firstPage );

	// Cover image
	$coverImage = get_field( 'carousel_picture_1', $firstPage );
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">

		<div class="row">
			<div class="col-sm-8 col-md-8">
				<!-- Breadcrumb -->
				<div class="breadcrumb">
					<a href="<?php echo get_permalink( PAGE_STORIES_ID ); ?>"><?php echo __( 'Stories', 'twentyfifteen-child' ); ?></a>
					<span class="separator">&raquo;</span>
					<h2 class="current-page"><?php echo $firstPage->post_title; ?></h2>
				</div>
			</div>
			<div class="col-sm-4 col-md-4">
				<a href="<?php echo get_permalink( PAGE_STORIES_ID ); ?>" class="button button-back">
					<i class="material-icons">arrow_back</i>
					<?php echo __( 'Back to the list', 'twentyfifteen-child' ); ?>
				</a>
			</div>
		</div>

		<!-- Cover -->
		<?php if ( $post->ID === $firstPage->ID ) : ?>
			<?php include( locate_template( 'partials/story-cover.php' ) ); ?>

		<!-- Page -->
		<?php else: ?>
			<?php include( locate_template( 'partials/story-page.php' ) ); ?>

		<?php endif; ?>

		<?php
			// Previous/next post navigation.
			foreach ( $allPages as $index => $page ) {
				if ( $page->ID === $post->ID ) {
					$nextPage = isset( $allPages[$index + 1] ) ? $allPages[$index + 1] : null;
					$previousPage = isset( $allPages[$index - 1] ) ? $allPages[$index - 1] : null;
				}
			}

			$previousPageTitle = strlen( $previousPage->post_title ) > 45 ? 
				mb_substr( $previousPage->post_title, 0, 45 ) . '...' : $previousPage->post_title;
			$nextPageTitle = strlen( $nextPage->post_title ) > 45 ? 
				mb_substr( $nextPage->post_title, 0, 45 ) . '...' : $nextPage->post_title;
		?>
		<nav class="previous-next-page">
			<div class="row">
				<?php if ( isset( $previousPage ) ) : ?>
					<div class="col-sm-6 col-md-6 previous-page">
						<a href="<?php echo get_permalink( $previousPage->ID ); ?>">
							<span class="previous-page-label">&laquo;&nbsp;<?php echo __( 'Previous page', 'twentyfifteen-child' ); ?></span>
							<span class="previous-page-title"><?php echo $previousPageTitle; ?></span>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( isset( $nextPage ) ) : ?>
				<div class="col-sm-6 col-md-6 next-page">
					<a href="<?php echo get_permalink( $nextPage->ID ); ?>">
						<span class="next-page-label"><?php echo __( 'Next page', 'twentyfifteen-child' ); ?>&nbsp;&raquo;</span>
						<span class="next-page-title"><?php echo $nextPageTitle; ?></span>
					</a>
				</div>
				<?php else: ?>
					<p class="col-sm-6 col-md-6 the-end">
						<?php echo __( 'The end.', 'twentyfifteen-child' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</nav>
	</main>
</div>

<?php
// End the loop.
endwhile; ?>

<?php get_footer(); ?>

<script type="text/javascript">
	$(document).ready(function() {
	});
</script>