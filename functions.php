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
        register_nav_menu( 'mainMenu', 'Main Menu' );
        register_nav_menu( 'footerMenuOne', 'Footer Menu 1' );
        register_nav_menu( 'footerMenuTwo', 'Footer Menu 2' );


    }
    
    add_action( 'after_setup_theme', 'lc_features' );
?>