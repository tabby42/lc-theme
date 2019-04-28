<?php 
/**
 * Footer
 *
 * Main footer file for the theme.
 */

get_header(); 
$title = get_the_archive_title();
$subtitle = get_the_archive_description();
lc_page_banner( 
    array(
        'title' => $title,
        'subtitle' => $subtitle
    ) 
);
?>

<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post();?>
        <div class="post-item">
            <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="metabox">
                <p>by <?php the_author_posts_link(); ?> on <?php the_time('j.m.Y'); ?> in <?php echo get_the_category_list(', ') ?></p>
            </div>
            <div class="generic-content">
                <?php the_excerpt(); ?>
                <p><a href="<?php the_permalink(); ?>" class="btn btn--blue">Continue reading</a></p>
            </div>
        </div>

    <?php }
    echo paginate_links();
    ?>
</div>

<?php get_footer();

?>