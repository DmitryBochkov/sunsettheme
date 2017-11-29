<?php

/*
=========
Theme Support Options
=========
*/
$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = [];

foreach ($formats as $format) {
  $output[] = @$options[$format] == '1' ? $format : '';
}
if ( !empty($options) ) {
  add_theme_support( 'post-formats', $output );
}

$header = get_option( 'custom_header' );
if ( @$header == 1) {
  add_theme_support( 'custom-header' );
}

$background = get_option( 'custom_background' );
if ( @$background == 1) {
  add_theme_support( 'custom-background' );
}

/* Activate Nav Menu Option */
function sunset_register_nav_menu() {
  register_nav_menu( 'primary', 'Header Navigaton Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );
