<?php
get_header();

while (have_posts()) {
    the_post(); 
    lc_page_banner();
    ?>
    <div class="container container--narrow page-section">
        <div class="generic-content">
            <div class="row group">
                <div class="one-third"><?php the_post_thumbnail('portrait'); ?></div>
                <div class="two-thirds"><?php the_content(); ?></div>
            </div>
        </div>
        
        <?php $relatedPrograms = get_field('related_programs'); 
        if ($relatedPrograms) { ?>
            <hr class="section-break">
            <h2 class="headline headline--medium">Subjects taught</h2>
            <ul class="link-list min-list">
            <?php //print_r($relatedPrograms);
            foreach ( $relatedPrograms as $program ) { ?>
                <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
            <?php }
            ?>
            </ul>
        <?php } ?>
    </div>

<?php }
get_footer();
?>