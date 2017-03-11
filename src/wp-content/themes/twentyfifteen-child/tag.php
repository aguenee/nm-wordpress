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

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">

        <div class="row term-header">
            <!-- Title -->
            <div class="col-sm-5 col-md-5">
                <h2 class="tag-title">#<?php echo $term->name; ?></h2>
            </div>
            <!-- Buttons -->
            <div class="col-sm-7 col-md-7">
                <a href="<?php echo get_permalink( PAGE_STORIES_ID ); ?>" class="button button-all"><?php echo __( 'All stories', 'twentyfifteen-child' ); ?></a>
                <a href="<?php echo get_permalink( PAGE_BOOKS_ID ); ?>" class="button button-all"><?php echo __( 'All books', 'twentyfifteen-child' ); ?></a>
                <a href="<?php echo get_permalink( PAGE_REPORTAGES_ID ); ?>" class="button button-all"><?php echo __( 'All reportages', 'twentyfifteen-child' ); ?></a>
            </div>
        </div>

        <!-- Results -->
        <?php include( locate_template( 'partials/taxonomy.php' ) ); ?>
        
    </main>
</div>

<?php wp_reset_postdata(); ?>
<?php $post = null; ?>

<?php get_footer(); ?>