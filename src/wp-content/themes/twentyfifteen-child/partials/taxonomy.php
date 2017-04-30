<!-- Stories -->
<section id="stories" class="featured-content section <?php echo $stories->have_posts() ? 'section-open' : 'section-disabled'; ?>">
    <div class="row section-title">
        <div class="col-sm-12 col-md-12">
            <h4>
                <?php echo __( 'Stories', 'twentyfifteen-child' ); ?>&nbsp;<small>(<?php echo $stories->post_count; ?>)</small>
                <i class="material-icons arrow-down">keyboard_arrow_down</i>
                <i class="material-icons arrow-right">keyboard_arrow_right</i>
            </h4>
            <hr />
        </div>
    </div>

    <div class="row transitions-enabled fluid masonry js-masonry grid section-content">
        <?php while ( $stories->have_posts() ) :
            // Post
            $story = get_post( $stories->the_post() );
            // Cover
            $coverImage = get_field( 'carousel_picture_1', $story );
            // Tags
            $tags = wp_get_post_tags( $story->ID );
            // Categories
            $categories = get_post_categories( $story );
        ?>
            <div class="col-sm-4 col-md-4 grid-item">
                <article class="thumbnail thumbnail-book">
                    <div class="content">
                        <div class="corner">
                            <a href="#" class="triangle triangle-top-right"></a>
                            <span class="label"><i class="material-icons">add</i></span>
                        </div>
                        <?php if ( $coverImage ): ?>
                            <div class="image clearfix">
                                <img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $story->post_title; ?>" />
                            </div>
                        <?php endif; ?>
                        <h3 class="title"><?php echo $story->post_title; ?></h3>
                        <a class="see-more-link-area" href="<?php echo get_permalink( $story ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
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
    </div>
</section>

<!-- Books -->
<section id="books" class="featured-content section <?php echo $books->have_posts() ? 'section-open' : 'section-disabled'; ?>">
    <div class="row section-title">
        <div class="col-sm-12 col-md-12">
            <h4>
                <?php echo __( 'Books', 'twentyfifteen-child' ); ?>&nbsp;<small>(<?php echo $books->post_count; ?>)</small>
                <i class="material-icons arrow-down">keyboard_arrow_down</i>
                <i class="material-icons arrow-right">keyboard_arrow_right</i>
            </h4>
            <hr />
        </div>
    </div>

    <div class="row transitions-enabled fluid masonry js-masonry grid section-content">
        <?php while ( $books->have_posts() ) :
            // Post
            $book = get_post( $books->the_post() );
            // Cover
            $coverImage = get_field( 'book_cover_image', $book );
            // Authors
            $authors = get_field( 'book_authors', $book, false );
            // Publication date
            $publicationDate = new DateTime( get_field( 'book_publication_date', $book, false ) );
            // Tags
            $tags = wp_get_post_tags( $book->ID );
            // Categories
            $categories = get_post_categories( $book );
        ?>
            <div class="col-sm-4 col-md-4 grid-item">
                <article class="thumbnail thumbnail-book">
                    <div class="content">
                        <div class="corner">
                            <a href="#" class="triangle triangle-top-right"></a>
                            <span class="label"><i class="material-icons">add</i></span>
                        </div>
                        <div class="image clearfix">
                            <?php if ( $coverImage ): ?>
                                <img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />
                            <?php else: ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                            <?php endif; ?>
                        </div>
                        <h3 class="title"><?php echo $book->post_title; ?></h3>
                        <h3 class="authors"><?php echo $authors; ?></h3>
                        <a class="see-more-link-area" href="<?php echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
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
    </div>
</section>

<!-- Reportages -->
<section id="reportages" class="featured-content section <?php echo $reportages->have_posts() ? 'section-open' : 'section-disabled'; ?>">
    <div class="row section-title">
        <div class="col-sm-12 col-md-12">
            <h4>
                <?php echo __( 'Reportages', 'twentyfifteen-child' ); ?>&nbsp;<small>(<?php echo $reportages->post_count; ?>)</small>
                <i class="material-icons arrow-down">keyboard_arrow_down</i>
                <i class="material-icons arrow-right">keyboard_arrow_right</i>
            </h4>
            <hr />
        </div>
    </div>

    <div class="row transitions-enabled fluid masonry js-masonry grid section-content">
        <?php while ( $reportages->have_posts() ) :
            // Post
            $reportage = get_post( $reportages->the_post() );
            // Cover
            $coverImage = get_the_post_thumbnail( $reportage, 'medium' );
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
                        <div class="image clearfix">
                            <?php if ( $coverImage ): ?>
                               <?php echo $coverImage; ?>
                            <?php else: ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/reportage-cover.jpg" alt="<?php echo $reportage->post_title; ?>" />
                            <?php endif; ?>
                        </div>
                        <h3 class="title"><?php echo $reportage->post_title; ?></h3>
                        <a class="see-more-link-area" href="<?php echo get_permalink( $reportage ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
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
    </div>
</section>