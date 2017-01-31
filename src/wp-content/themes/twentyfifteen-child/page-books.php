<?php
/*
  Template Name: Books
*/

get_header();


// Get books (5 per page)
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$books = new WP_Query( array(
	'meta_key'		 => 'book_publication_date',
	'orderby'		 => 'meta_value',
	'order'          => 'DESC',
	'posts_per_page' => POSTS_PER_PAGE,
	'paged' 		 => $paged,
	'post_type' 	 => 'book',
	'post_status' 	 => 'publish',
	'post_parent'	 => 0
) );

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">

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
	        	$description = strlen( $description ) > 300 ? mb_substr( $description, 0, 300 ) . '...' : $description;
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
						<a href="<?php echo get_permalink( $book ); ?>">
							<?php if ( $coverImage ): ?>
								<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />
							<?php else: ?>
				                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
							<?php endif; ?>
						</a>
					</div>
					<div class="col-sm-9 col-md-9 caption">
						<h2 class="title">
							<a href="<?php echo get_permalink( $book ); ?>"><?php echo $book->post_title; ?></a>
						</h2>
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