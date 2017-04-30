<?php
/**
 * The template for displaying all single reportage posts and attachments
 */

get_header(); ?>


<?php
// Start the loop.
while ( have_posts() ) : the_post();
    // Tags
    $tags = wp_get_post_tags( $post->ID );
    // Categories
    $categories = get_post_categories( $post );
    // Featured books
    $featuredReportages = get_featured_posts(
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
                <a href="<?php echo get_permalink( PAGE_REPORTAGES_ID ); ?>"><?php echo __( 'Reportages', 'twentyfifteen-child' ); ?></a>
                <span class="separator">&raquo;</span>
                <h2 class="current-page"><?php the_title(); ?></h2>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <a href="<?php echo get_permalink( PAGE_REPORTAGES_ID ); ?>" class="button button-back">
              <i class="material-icons">arrow_back</i>
              <?php echo __( 'Back to the list', 'twentyfifteen-child' ); ?>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <article id="reportage">
                <div class="content">
                    <h2 class="title"><?php the_title(); ?></h2>

                    <a class="read-link" href="#" title="<?php echo __( 'Read +', 'twentyfifteen-child' ); ?>">
                        <i class="material-icons">book</i>
                    </a>

                    <div class="description">
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="reportage-footer">
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
        </div>
    </div>

    <!-- Featured content -->
    <?php if ( !empty($featuredReportages) ) : ?>
        <section class="featured-content">
            <div class="row">
                <div class="header col-sm-12 col-md-12">
                    <h3><?php echo __( 'Around the same theme', 'twentyfifteen-child' ); ?></h3>
                </div>
            
                <?php $containerSize = count( $featuredReportages ) * 4; ?>
                <div class="items <?php echo 'col-sm-' . $containerSize . ' col-md-' . $containerSize; ?>">
                    <div class="row">
                    <?php $colSize = 12 / count( $featuredReportages ); ?>

                    <?php foreach ( $featuredReportages as $featuredReportage ) :
                            // Cover
                            $coverImage = get_the_post_thumbnail( $featuredReportage, 'medium' );
                            // Tags
                            $tags = wp_get_post_tags( $featuredReportage->ID );
                            // Categories
                            $categories = get_post_categories( $featuredReportage );
                    ?>
                        <div class="<?php echo 'col-sm-' . $colSize . ' col-md-' . $colSize; ?>">
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
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default/reportage-cover.jpg" alt="<?php echo $featuredReportage->post_title; ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="title"><?php echo $featuredReportage->post_title; ?></h3>
                                    <a class="see-more-link-area" href="<?php echo get_permalink( $featuredReportage ); ?>" title="<?php echo __( 'See more', 'twentyfifteen-child' ); ?>"></a>
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

<?php endwhile; ?>


<?php get_footer(); ?>