<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'child-style', get_template_directory_uri().'/style.css', array( 'essentials-style' ), wp_get_theme()->get('Version') );
   wp_enqueue_style('essentials-child-style', get_stylesheet_uri());
}
?>
