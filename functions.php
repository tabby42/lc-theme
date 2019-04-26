<?php 
    function lc_scripts() {
        wp_enqueue_style( 'roboto', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' );
        wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
        wp_enqueue_style( 'lc_styles', get_stylesheet_uri(), NULL, microtime() );

        wp_enqueue_script( 'lc-theme-js', get_theme_file_uri('/js/scripts-bundled.js') , NULL, microtime(), true );
    }

    add_action('wp_enqueue_scripts', 'lc_scripts');

    function lc_features() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails', array( 'post', 'professor' ) );
        register_nav_menu( 'mainMenu', 'Main Menu' );
        register_nav_menu( 'footerMenuOne', 'Footer Menu 1' );
        register_nav_menu( 'footerMenuTwo', 'Footer Menu 2' );
    }
    
    add_action( 'after_setup_theme', 'lc_features' );

    function lc_adjust_queries ( $query ) {
        if ( !is_admin() && is_post_type_archive( 'event' ) && $query-> is_main_query() ) {
            $today = date('Ymd');
            $query->set( 'posts_per_page', 4 );
            $query->set( 'meta_key', 'event_date' );
            $query->set( 'orderby', 'meta_value_num' );
            $query->set( 'order', 'ASC' );
            $query->set( 'meta_query', array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                 )
            ) );
        }

        if ( !is_admin() &&  is_post_type_archive( 'program' ) && $query-> is_main_query() ) {
            $query->set( 'posts_per_page', -1 );
            $query->set( 'orderby', 'title' );
            $query->set( 'order', 'ASC' );
        }
    }

    add_action( 'pre_get_posts', 'lc_adjust_queries' );
?>