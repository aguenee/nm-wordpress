<?php
/*
  Template Name: Books
*/

get_header();


// Get sort parameter
$sortby = $_GET['sortby'] ? $_GET['sortby'] : 'date_desc';
$sortInfos = explode( '_', $sortby );
$orderby = $sortInfos[0] == 'date' ? 'meta_value' : $sortInfos[0];
$order = $sortInfos[1];

// Get books (5 per page)
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$books = new WP_Query( array(
	'meta_key'		 => 'book_publication_date',
	'orderby'		 => $orderby,
	'order'          => $order,
	'posts_per_page' => POSTS_PER_PAGE,
	'paged' 		 => $paged,
	'post_type' 	 => 'book',
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
					<h2 class="current-page"><?php echo __( 'Books', 'twentyfifteen-child' ); ?></h2>
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

	<!-- Books -->
	<?php if ( $books->have_posts() ) : ?>
		<?php while ( $books->have_posts() ) :
				// Post
				$book = get_post( $books->the_post() );
				// Cover
				$coverImage = get_field( 'book_cover_image', $book );
				// Authors
				$authors = get_field( 'book_authors', $book, false );
				// Publication date
				$publicationDate = new DateTime( get_field( 'book_publication_date', $book, false ) );
				// Editor
				$editor = get_field( 'book_editor', $book, false );
				// Price
				$price = get_field( 'book_price', $book, false );
				// Description
	        	$description = wp_strip_all_tags( get_post_field( 'post_content', $book ) );
	        	$description = strlen( $description ) > 370 ? mb_substr( $description, 0, 370 ) . '...' : $description;
	        	// Tags
	        	$tags = wp_get_post_tags( $book->ID );
        		// Categories
				$categories = get_post_categories( $post );
		?>
			<article class="row thumbnail thumbnail-book">
				<div class="content clearfix">
					<div class="corner">
						<a href="#" class="triangle triangle-top-right"></a>
						<span class="label"><i class="material-icons">add</i></span>
					</div>
					<div class="col-sm-3 col-md-3 image">
						<?php if ( $coverImage ): ?>
							<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />
						<?php else: ?>
			                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
						<?php endif; ?>
					</div>
					<div class="col-sm-9 col-md-9 caption">
						<h2 class="title"><?php echo $book->post_title; ?></a></h2>
						<h3 class="authors"><?php echo $authors; ?></h3>
						<small class="publication-date">
							<strong><?php echo __( 'Publication', 'twentyfifteen-child' ); ?> :</strong> <?php echo $publicationDate->format('d/m/Y'); ?>
						</small>
						&middot;
						<small class="editor">
							<strong><?php echo __( 'Editor', 'twentyfifteen-child' ); ?> :</strong> <?php echo $editor; ?>
						</small>
						&middot;
						<small class="price">
							<strong><?php echo __( 'Price', 'twentyfifteen-child' ); ?> :</strong> <?php echo $price; ?>&nbsp;€
						</small>

						<p class="description"><?php echo $description; ?></p>
						<a class="see-more-link" href="<?php echo get_permalink( $book ); ?>" title="<?php echo $book->post_title; ?>">
							<?php echo __( 'See more', 'twentyfifteen-child' ); ?>
						</a>
					</div>
					<a class="see-more-link-area" href="<?php echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
				</div>
				<div class="col-sm-12 col-md-12 footer">
					<?php foreach ( $tags as $index => $tag ) : ?>
						<a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
					<?php endforeach; ?>
					<?php foreach ( $categories as $index => $category ) : ?>
						<a href="<?php echo get_category_link( $category ); ?>" class="category">
							<i class="material-icons">local_offer</i><?php echo $category->name; ?>
						</a>&nbsp;
					<?php endforeach; ?>
				</div>
			</article>
		<?php endwhile; ?>

		<!-- Pagination -->
		<?php if ( function_exists( custom_pagination ) ) : ?>
			<div class="row">
				<div class="col-sm-12 col-md-12">
			        <?php custom_pagination( $books->max_num_pages, '', $paged ); ?>
			    </div>
		    </div>
      	<?php endif; ?>
      	
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	</main>
</div>

<?php get_footer(); ?>