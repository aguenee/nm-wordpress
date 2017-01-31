<?php
/**
 * The template for displaying all posts sharing same taxonomy term
 */

get_header(); 


$term = get_queried_object(); 
$taxonomy = $term->taxonomy;

$stories = new WP_Query( array(
        'orderby'        => 'date',
        'order'          => 'DESC',
        'posts_per_page' => -1,
        'post_type'      => array( 'story' ),
        'post_status'    => 'publish',
        'tag'            => $term->slug
    )
);

$books = new WP_Query( array(
        'orderby'        => 'date',
        'order'          => 'DESC',
        'posts_per_page' => -1,
        'post_type'      => array( 'book' ),
        'post_status'    => 'publish',
        'tag'            => $term->slug
    )
);

$reportages = new WP_Query( array(
        'orderby'        => 'date',
        'order'          => 'DESC',
        'posts_per_page' => -1,
        'post_type'      => array( 'reportage' ),
        'post_status'    => 'publish',
        'tag'            => $term->slug
    )
);

//$index = 0;

?>

<div id="primary" class="content-area tag-items">
    <main id="main" class="site-main container" role="main">

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h2 class="tag-title">#<?php echo $term->name; ?></h2>
            </div>
        </div>

        <!-- Stories -->
        <?php //if ( $stories->have_posts() ) : ?>
            <section id="stories">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2><?php echo __( 'Stories', 'twentyfifteen-child' ); ?></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <article class="thumbnail thumbnail-book">
                            <div class="content">
                                <div class="corner">
                                    <a href="#" class="triangle triangle-top-right"></a>
                                    <span class="label"><i class="material-icons">add</i></span>
                                </div>
                                <a class="image clearfix" href="<?php echo get_permalink( $book ); ?>">
                                    <?php //if ( $coverImage ): ?>
                                        <!--<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />-->
                                    <?php //else: ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                                    <?php //endif; ?>
                                </a>
                                <h3 class="title">
                                    <a href="<?php echo get_permalink( $book ); ?>">Titre<?php //echo $book->post_title; ?></a>
                                </h3>
                                <h3 class="authors">Auteurs<?php //echo $authors; ?></h3>
                                <a class="see-more-link-area" href="<?php //echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
                            </div>
                            <!--<div class="footer">
                                <?php foreach ( $categories as $index => $category ) : ?>
                                    <a href="<?php echo get_category_link( $category ); ?>" class="category">
                                        <i class="material-icons">local_offer</i><?php echo $category->name; ?>
                                    </a>&nbsp;
                                <?php endforeach; ?>
                                <?php foreach ( $tags as $index => $tag ) : ?>
                                    <a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
                                <?php endforeach; ?>
                            </div>-->
                        </article>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <article class="thumbnail thumbnail-book">
                            <div class="content">
                                <div class="corner">
                                    <a href="#" class="triangle triangle-top-right"></a>
                                    <span class="label"><i class="material-icons">add</i></span>
                                </div>
                                <a class="image clearfix" href="<?php echo get_permalink( $book ); ?>">
                                    <?php //if ( $coverImage ): ?>
                                        <!--<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />-->
                                    <?php //else: ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                                    <?php //endif; ?>
                                </a>
                                <h3 class="title">
                                    <a href="<?php echo get_permalink( $book ); ?>">Titre<?php //echo $book->post_title; ?></a>
                                </h3>
                                <h3 class="authors">Auteurs<?php //echo $authors; ?></h3>
                                <a class="see-more-link-area" href="<?php //echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
                            </div>
                            <!--<div class="footer">
                                <?php foreach ( $categories as $index => $category ) : ?>
                                    <a href="<?php echo get_category_link( $category ); ?>" class="category">
                                        <i class="material-icons">local_offer</i><?php echo $category->name; ?>
                                    </a>&nbsp;
                                <?php endforeach; ?>
                                <?php foreach ( $tags as $index => $tag ) : ?>
                                    <a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
                                <?php endforeach; ?>
                            </div>-->
                        </article>
                    </div>
                </div>
            </section>
        <?php //endif; ?>

        <!-- Books -->
        <?php if ( $books->have_posts() ) : ?>
            <section id="books">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2><?php echo __( 'Books', 'twentyfifteen-child' ); ?></h2>
                    </div>
                </div>

                <div class="row transitions-enabled fluid masonry js-masonry grid">
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
                        $categories = get_post_categories( $post );
                    ?>

                        <div class="col-sm-4 col-md-4 grid-item">
                            <article class="thumbnail thumbnail-book">
                                <div class="content">
                                    <div class="corner">
                                        <a href="#" class="triangle triangle-top-right"></a>
                                        <span class="label"><i class="material-icons">add</i></span>
                                    </div>
                                    <a class="image clearfix" href="<?php echo get_permalink( $book ); ?>">
                                        <?php if ( $coverImage ): ?>
                                            <img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />
                                        <?php else: ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                                        <?php endif; ?>
                                    </a>
                                    <h3 class="title">
                                        <a href="<?php echo get_permalink( $book ); ?>"><?php echo $book->post_title; ?></a>
                                    </h3>
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
                    <div class="col-sm-4 col-md-4">
                        <article class="thumbnail thumbnail-book">
                            <div class="content">
                                <div class="corner">
                                    <a href="#" class="triangle triangle-top-right"></a>
                                    <span class="label"><i class="material-icons">add</i></span>
                                </div>
                                <a class="image clearfix" href="<?php echo get_permalink( $book ); ?>">
                                    <?php //if ( $coverImage ): ?>
                                        <!--<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />-->
                                    <?php //else: ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                                    <?php //endif; ?>
                                </a>
                                <h3 class="title">
                                    <a href="<?php echo get_permalink( $book ); ?>">Titre<?php //echo $book->post_title; ?></a>
                                </h3>
                                <h3 class="authors">Auteurs<?php //echo $authors; ?></h3>
                                <a class="see-more-link-area" href="<?php //echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
                            </div>
                            <!--<div class="footer">
                                <?php foreach ( $categories as $index => $category ) : ?>
                                    <a href="<?php echo get_category_link( $category ); ?>" class="category">
                                        <i class="material-icons">local_offer</i><?php echo $category->name; ?>
                                    </a>&nbsp;
                                <?php endforeach; ?>
                                <?php foreach ( $tags as $index => $tag ) : ?>
                                    <a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
                                <?php endforeach; ?>
                            </div>-->
                        </article>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <article class="thumbnail thumbnail-book">
                            <div class="content">
                                <div class="corner">
                                    <a href="#" class="triangle triangle-top-right"></a>
                                    <span class="label"><i class="material-icons">add</i></span>
                                </div>
                                <a class="image clearfix" href="<?php echo get_permalink( $book ); ?>">
                                    <?php //if ( $coverImage ): ?>
                                        <!--<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />-->
                                    <?php //else: ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                                    <?php //endif; ?>
                                </a>
                                <h3 class="title">
                                    <a href="<?php echo get_permalink( $book ); ?>">Titre<?php //echo $book->post_title; ?></a>
                                </h3>
                                <h3 class="authors">Auteurs<?php //echo $authors; ?></h3>
                                <a class="see-more-link-area" href="<?php //echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
                            </div>
                            <!--<div class="footer">
                                <?php foreach ( $categories as $index => $category ) : ?>
                                    <a href="<?php echo get_category_link( $category ); ?>" class="category">
                                        <i class="material-icons">local_offer</i><?php echo $category->name; ?>
                                    </a>&nbsp;
                                <?php endforeach; ?>
                                <?php foreach ( $tags as $index => $tag ) : ?>
                                    <a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
                                <?php endforeach; ?>
                            </div>-->
                        </article>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <article class="thumbnail thumbnail-book">
                            <div class="content">
                                <div class="corner">
                                    <a href="#" class="triangle triangle-top-right"></a>
                                    <span class="label"><i class="material-icons">add</i></span>
                                </div>
                                <a class="image clearfix" href="<?php echo get_permalink( $book ); ?>">
                                    <?php //if ( $coverImage ): ?>
                                        <!--<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />-->
                                    <?php //else: ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                                    <?php //endif; ?>
                                </a>
                                <h3 class="title">
                                    <a href="<?php echo get_permalink( $book ); ?>">Titre<?php //echo $book->post_title; ?></a>
                                </h3>
                                <h3 class="authors">Auteurs<?php //echo $authors; ?></h3>
                                <a class="see-more-link-area" href="<?php //echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
                            </div>
                            <!--<div class="footer">
                                <?php foreach ( $categories as $index => $category ) : ?>
                                    <a href="<?php echo get_category_link( $category ); ?>" class="category">
                                        <i class="material-icons">local_offer</i><?php echo $category->name; ?>
                                    </a>&nbsp;
                                <?php endforeach; ?>
                                <?php foreach ( $tags as $index => $tag ) : ?>
                                    <a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
                                <?php endforeach; ?>
                            </div>-->
                        </article>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Reportages -->
        <?php //if ( $reportages->have_posts() ) : ?>
            <section id="reportages">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2><?php echo __( 'Reportages', 'twentyfifteen-child' ); ?></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <article class="thumbnail thumbnail-book">
                            <div class="content">
                                <div class="corner">
                                    <a href="#" class="triangle triangle-top-right"></a>
                                    <span class="label"><i class="material-icons">add</i></span>
                                </div>
                                <a class="image clearfix" href="<?php echo get_permalink( $book ); ?>">
                                    <?php //if ( $coverImage ): ?>
                                        <!--<img src="<?php echo $coverImage['sizes']['medium_large']; ?>" alt="<?php echo $book->post_title; ?>" />-->
                                    <?php //else: ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/book-cover.jpg" alt="<?php echo $book->post_title; ?>" />
                                    <?php //endif; ?>
                                </a>
                                <h3 class="title">
                                    <a href="<?php echo get_permalink( $book ); ?>">Titre<?php //echo $book->post_title; ?></a>
                                </h3>
                                <h3 class="authors">Auteurs<?php //echo $authors; ?></h3>
                                <a class="see-more-link-area" href="<?php //echo get_permalink( $book ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
                            </div>
                            <!--<div class="footer">
                                <?php foreach ( $categories as $index => $category ) : ?>
                                    <a href="<?php echo get_category_link( $category ); ?>" class="category">
                                        <i class="material-icons">local_offer</i><?php echo $category->name; ?>
                                    </a>&nbsp;
                                <?php endforeach; ?>
                                <?php foreach ( $tags as $index => $tag ) : ?>
                                    <a href="<?php echo get_term_link( $tag ); ?>" class="tag">#<?php echo $tag->name; ?></a>&nbsp;
                                <?php endforeach; ?>
                            </div>-->
                        </article>
                    </div>
                </div>
            </section>
        <?php //endif; ?>
    </main>
</div>

<?php wp_reset_postdata(); ?>
<?php $post = null; ?>

<?php get_footer(); ?>