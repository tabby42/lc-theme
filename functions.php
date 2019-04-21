<?php 
    function lc_scripts() {
        wp_enqueue_style('lc_styles', get_stylesheet_uri());
    }

    add_action('wp_enqueue_scripts', lc_scripts);
?>