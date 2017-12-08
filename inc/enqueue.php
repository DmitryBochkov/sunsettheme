<?php

/*
@package sunsettheme
=========
Admin enqueue functions
=========
*/
function sunset_load_admin_scripts( $hook ) {
  // echo $hook;
  // register css admin section
  wp_register_style( 'raleway-admin', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
  wp_register_style( 'sunset-admin', get_template_directory_uri() . '/css/sunset.admin.css', array() , '1.0.0', 'all' );
  // register js admin section
  wp_register_script( 'sunset-admin-script', get_template_directory_uri() . '/js/sunset.admin.js', array('jquery'), '1.0.0', true );

  $pages_array = array(
    'toplevel_page_alecadd_sunset',
    'sunset_page_alecadd_sunset_theme',
    'sunset_page_alecadd_sunset_theme_contact',
  );

  if ( in_array($hook, $pages_array) ) {

    wp_enqueue_style( 'raleway-admin' );
    wp_enqueue_style( 'sunset-admin' );

  } elseif ( $hook == 'toplevel_page_alecadd_sunset' ) {

    wp_enqueue_media();

    wp_enqueue_script( 'sunset-admin-script' );

  } elseif ('sunset_page_alecadd_sunset_css' == $hook) {
    wp_enqueue_style( 'raleway-admin' );
    wp_enqueue_style( 'sunset-admin' );
    wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/sunset.ace.css', array() , '1.0.0', 'all' );

    wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array( 'jquery' ), '1.2.1', true );
    wp_enqueue_script( 'sunset-custom-css-script', get_template_directory_uri() . '/js/sunset.custom_css.js', array( 'jquery' ), '1.0.0', true );
  } else {
    return;
  }
}
add_action( 'admin_enqueue_scripts', 'sunset_load_admin_scripts' );

/*
=========
Front-end enueue functions
=========
*/
function sunset_load_scripts() {
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array() , '3.3.7', 'all' );
  wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
  wp_enqueue_style( 'sunset', get_template_directory_uri() . '/css/sunset.css', array() , '1.0.0', 'all' );

  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
  wp_enqueue_script( 'sunset', get_template_directory_uri() . '/js/sunset.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );
