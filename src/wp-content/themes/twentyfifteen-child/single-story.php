<?php
/*
  Template Name: Story
*/

get_header();

// Start the loop.
while ( have_posts() ) : the_post();
	// Cover
	/*$coverImage = get_field( 'book_cover_image' );
	// Authors
	$authors = get_field( 'book_authors', $post, false );
	// Publication date
	$publicationDate = new DateTime( get_field( 'book_publication_date', $post, false ) );
	// Editor
	$editor = get_field( 'book_editor', $post, false );
	// Price
	$price = get_field( 'book_price', $post, false );
	// Description
	$description = wp_strip_all_tags( get_post_field( 'post_content' ) );
	$description = strlen( $description ) > 300 ? mb_substr( $description, 0, 300 ) . '...' : $description;
	// Tags
	$tags = wp_get_post_tags( $post->ID );
	// Categories
	$categories = get_post_categories( $post );
	// Featured books
	$featuredBooks = get_featured_posts(
		$post,
		[
			'categories' => wp_get_post_categories( $post->ID ),
			'tags' => wp_get_post_terms( $post->ID, 'post_tag', array( 'fields' => 'ids' ) )
		],
		true,
		3
	);*/
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">

		<div class="row">
			<div class="col-sm-8 col-md-8">
				<!-- Breadcrumb -->
				<div class="breadcrumb">
					<a href="<?php echo get_permalink( PAGE_STORIES_ID ); ?>"><?php echo __( 'Stories', 'twentyfifteen-child' ); ?></a>
					<span class="separator">&raquo;</span>
					<h2 class="current-page"><?php the_title(); ?></h2>
				</div>
			</div>
			<div class="col-sm-4 col-md-4">
				<a href="<?php echo get_permalink( PAGE_STORIES_ID ); ?>" class="button button-back">
					<i class="material-icons">arrow_back</i>
					<?php echo __( 'Back to the list', 'twentyfifteen-child' ); ?>
				</a>
			</div>
		</div>

		<div class="row sheet-white">
			<div class="cover">
				<?php $coverImage = get_field( 'carousel_picture_1' ); ?>
				<img src="<?php echo $coverImage['sizes']['large']; ?>" alt="<?php echo $post->post_title; ?>" />
			</div>

			<div class="col-sm-12 col-md-12 content">
				<h2 class="title"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		</div>
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