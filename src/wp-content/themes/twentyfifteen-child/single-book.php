<?php
/*
  Template Name: Book
*/

get_header();

// Start the loop.
while ( have_posts() ) : the_post();
	// Cover
	$coverImage = get_field( 'book_cover_image' );
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
	);
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">

		<div class="row">
			<div class="col-sm-8 col-md-8">
				<!-- Breadcrumb -->
				<div class="breadcrumb">
					<a href="<?php echo get_permalink( PAGE_BOOKS_ID ); ?>"><?php echo __( 'Books', 'twentyfifteen-child' ); ?></a>
					<span class="separator">&raquo;</span>
					<h2 class="current-page"><?php the_title(); ?></h2>
				</div>
			</div>
			<div class="col-sm-4 col-md-4">
				<a href="<?php echo get_permalink( PAGE_BOOKS_ID ); ?>" class="button button-back">
					<i class="material-icons">arrow_back</i>
					<?php echo __( 'Back to the list', 'twentyfifteen-child' ); ?>
				</a>
			</div>
		</div>

		<div class="row">
			<!-- Tabs -->
			<section id="tabs-container" class="col-sm-12 col-md-12">
			    <ul class="tabs-menu">
			        <li class="current"><a href="#book"><?php echo __( 'Book', 'twentyfifteen-child' ); ?></a></li>
			        <li class="disabled"><a href="#press"><?php echo __( 'Press', 'twentyfifteen-child' ); ?></a></li>
			        <li class="disabled"><a href="#videos"><?php echo __( 'Videos', 'twentyfifteen-child' ); ?></a></li>
			    </ul>
			    <div class="tab">
			    	<!-- Book -->
			        <article id="book" class="tab-content">
			        	<div class="content">
				            <h2 class="title"><?php the_title(); ?></h2>
				            <h3 class="authors"><?php echo $authors; ?></h3>

				            <a class="read-link" href="#" title="<?php echo __( 'Read +', 'twentyfifteen-child' ); ?>">
				            	<i class="material-icons">book</i>
							</a>

				            <div class="description clearfix">
					            <?php if ( $coverImage ): ?>
									<img class="cover" src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php the_title(); ?>" />
								<?php endif; ?>
					            <?php the_content(); ?>
					        </div>

					        <div class="infos">
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
							</div>

							<a class="button button-buy" href="<?php echo get_field( 'book_product_link' ); ?>" title="<?php echo $post->post_title ; ?>" target="_blank">
								<?php echo __( 'Buy', 'twentyfifteen-child' ); ?>
								<i class="material-icons">open_in_new</i>
							</a>
						</div>
						<div class="book-footer">
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

			        <!-- Press -->
			        <article id="press" class="tab-content">
			           <p></p>
			        </article>

			        <!-- Videos -->
			        <article id="videos" class="tab-content">
			           <p></p>
			        </article>
			    </div>
			</section>
		</div>

		<!-- Featured content -->
		<?php if ( !empty($featuredBooks) ) : ?>
			<section class="featured-content">
				<div class="row">
					<div class="header col-sm-12 col-md-12">
						<h3><?php echo __( 'Around the same theme', 'twentyfifteen-child' ); ?></h3>
					</div>
				
					<?php $containerSize = count( $featuredBooks ) * 4; ?>
					<div class="items <?php echo 'col-sm-' . $containerSize . ' col-md-' . $containerSize; ?>">
						<div class="row">
						<?php $colSize = 12 / count( $featuredBooks ); ?>

						<?php foreach ( $featuredBooks as $featuredBook ) :
								// Cover
								$coverImage = get_field( 'book_cover_image', $featuredBook );
								// Authors
								$authors = get_field( 'book_authors', $featuredBook, false );
					        	// Tags
					        	$tags = wp_get_post_tags( $featuredBook->ID );
					    		// Categories
								$categories = get_post_categories( $featuredBook );
						?>
							<div class="<?php echo 'col-sm-' . $colSize . ' col-md-' . $colSize; ?>">
								<article class="thumbnail thumbnail-book">
									<div class="content">
		                                <div class="corner">
		                                    <a href="#" class="triangle triangle-top-right"></a>
		                                    <span class="label"><i class="material-icons">add</i></span>
		                                </div>
		                                <div class="image clearfix">
		                                    <?php if ( $coverImage ): ?>
		                                        <img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $featuredBook->post_title; ?>" />
		                                    <?php else: ?>
		                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $featuredBook->post_title; ?>" />
		                                    <?php endif; ?>
		                                </div>
		                                <h3 class="title"><?php echo $featuredBook->post_title; ?></h3>
		                                <h3 class="authors"><?php echo $authors; ?></h3>
		                                <a class="see-more-link-area" href="<?php echo get_permalink( $featuredBook ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
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
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

	</main>
</div>

<?php
// End the loop.
endwhile; ?>

<?php get_footer(); ?>

<script type="text/javascript">
	$(document).ready(function() {
	    $(".tabs-menu a").click(function(event) {
	        event.preventDefault();
	        if ($(this).parent().hasClass('disabled')) {
	        	return;
	        }
	        $(this).parent().addClass("current");
	        $(this).parent().siblings().removeClass("current");
	        var tab = $(this).attr("href");
	        $(".tab-content").not(tab).css("display", "none");
	        $(tab).fadeIn();
	    });
	});
</script>