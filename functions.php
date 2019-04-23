<?php 
    function lc_scripts() {
        wp_enqueue_style('roboto', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('lc_styles', get_stylesheet_uri());

        wp_enqueue_script('lc-theme-js', get_theme_file_uri('/js/scripts-bundled.js') , '', '', true);
    }

    add_action('wp_enqueue_scripts', 'lc_scripts');
?>