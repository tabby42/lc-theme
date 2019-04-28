<?php 
/**
 * Enqueues styles and scripts for theme
 *
 * @return void
 */
function Lc_scripts() 
{
    wp_enqueue_style('roboto', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('lc_styles', get_stylesheet_uri(), null, microtime());

    wp_enqueue_script('lc-theme-js', get_theme_file_uri('/js/scripts-bundled.js'), null, microtime(), true);
}

add_action('wp_enqueue_scripts', 'lc_scripts');

/**
 * Adds theme support, image sizes, and registers nav menus
 *
 * @return void
 */
function Lc_features() 
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', array( 'post', 'professor'));
    add_image_size('tiny', 400, 260, true);
    add_image_size('portrait', 150, 280, true);
    add_image_size('page_banner', 1500, 350, true);
    register_nav_menu('mainMenu', 'Main Menu');
    register_nav_menu('footerMenuOne', 'Footer Menu 1');
    register_nav_menu('footerMenuTwo', 'Footer Menu 2');
}

add_action('after_setup_theme', 'lc_features');

/**
 * Adjust queries for Events and Programs Archive pages
 *
 * @param object $query query-object
 * 
 * @return void
 */
function Lc_Adjust_queries($query)
{
    if (!is_admin() && is_post_type_archive('event') && $query-> is_main_query()) {
        $today = date('Ymd');
        $query->set('posts_per_page', 4);
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set(
            'meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
                )
            ) 
        );
    }

    if (!is_admin() &&  is_post_type_archive('program') && $query-> is_main_query()) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
}

add_action('pre_get_posts', 'lc_adjust_queries');

/**
 * Outputs the page banner with title, subtitle and background image
 *
 * @param array $args title, subtitle, bg_image
 * 
 * @return void
 */
function Lc_Page_banner($args = null)
{ 
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }
    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('subtitle');
    }
    $args['bg_image'] = get_field('page_banner_background_image')['sizes']['page_banner'];
    if (!$args['bg_image']) {
        $args['bg_image'] = get_theme_file_uri('/images/ocean.jpg');
    }
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['bg_image']; ?>);"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle']; ?></p>
        </div>
        </div>  
    </div>
<?php }
?>