<?php
get_header();

while (have_posts()) {
    the_post(); 
    lc_page_banner();
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Programs</a> <span class="metabox__main"> <?php the_title(); ?></span></p>
        </div>
        <div class="generic-content"><?php the_content(); ?></div>

        <?php
        $today = date('Ymd');
        $relatedEvents = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    ),
                    array (
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            ) 
        );

        if ($relatedEvents->have_posts()) {
            ?>
            <hr class="section-break">
            <h2 class="headline headline--medium">Upcoming <?php echo get_the_title(); ?> Events</h2>

            <?php
            while ($relatedEvents->have_posts()) {
                $relatedEvents->the_post(); ?>
                <div class="event-summary">
                    <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                    <span class="event-summary__month"><?php 
                        $eventDate = new DateTime(get_field('event_date'));
                        echo $eventDate->format('M');
                    ?></span>
                    <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>  
                    </a>
                    <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <p><?php 
                    if (has_excerpt()) { 
                        echo get_the_excerpt(); 
                    } else { 
                        echo wp_trim_words(get_the_content(), 18); 
                    }  ?> 
                        <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                    </div>
                </div>
            <?php }
        }
        wp_reset_postdata();
        ?>

        <?php
        $relatedProfessors = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => 'professor',
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => array(
                    array (
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            ) 
        );

        if ($relatedProfessors->have_posts()) {
            ?>
            <hr class="section-break">
            <h2 class="headline headline--medium"><?php echo get_the_title();  ?> Professors</h2>
            <ul class="professor-cards">
            <?php
            while ($relatedProfessors->have_posts()) {
                $relatedProfessors->the_post(); ?>
                <li class="professor-card__list-item">
                    <a href="<?php the_permalink(); ?>" class="professor-card">
                        <img src="<?php the_post_thumbnail_url('tiny'); ?>" alt="<?php  the_title(); ?> " class="professor-card__image">
                        <span class="professor-card__name"><?php  the_title(); ?></span>
                    </a>
                </li>
            <?php }
        }
        wp_reset_postdata();
        ?>
            </ul>
    </div>

<?php }
get_footer();
?>