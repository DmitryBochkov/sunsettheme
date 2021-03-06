<?php

/*
@package sunsettheme
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

/*Featured image support*/
add_theme_support( 'post-thumbnails' );

/* Activate Nav Menu Option */
function sunset_register_nav_menu() {
  register_nav_menu( 'primary', 'Header Navigaton Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/* Activate HTML5 features */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/*
=========
Blog Post Loop Functions
=========
*/
function sunset_posted_meta() {
  $posted_on = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) );
  $categories = get_the_category();
  $separator = ', ';
  $output = '';
  $i = 1;

  if ( !empty($categories) ) {
    foreach ( $categories as $category ) {
      if ( $i > 1 ): $output .= $separator; endif;
      $output .= '<a href="' . get_category_link( $category->term_id ) . '" alt="' . esc_attr( 'View all post in%', $category->name ) . '">' . esc_html( $category->name ) . '</a>';
      $i++;
    }
  }

  return '<span class="posted-on">Posted <a href="' . esc_url( get_the_permalink() ) . '">' . $posted_on . '</a> ago</span> / <span class="posted-in">' . $output . '</span>';
}

function sunset_posted_footer( $onlyComments = false ) {
  $comments_num = get_comments_number();
  if ( comments_open() ) {
    if (0 == $comments_num) {
      $comments = __('No comments');
    } elseif ( $comments_num > 1 ) {
      $comments = $comments_num . __(' Comments');
    } else {
      $comments = __('1 Comment');
    }
    $comments = '<a class="comments-link" href="' . get_comments_link() . '">' . $comments . ' <span class="sunset-icon sunset-comment"></span></a>';
  } else {
    $comments = __('Comments are closed');
  }

  if ($onlyComments) {
    return $comments;
  }

  return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">' . get_the_tag_list( '<div class="tags-list"><span class="sunset-icon sunset-tag"></span>', ' ', '</div>' ) . '</div><div class="col-xs-12 col-sm-6 text-right">' . $comments . '</div></div></div>';
}

function sunset_get_attachment( $num = 1 ) {
  $output = '';

  if ( has_post_thumbnail() && 1 == $num ) {
    $output = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) );
  } else {
    $attachments = get_posts( array(
      'post_type' => 'attachment',
      'posts_per_page' => $num,
      'post_parent' => get_the_id(),
    ) );
    if ( $attachments && 1 == $num ) {
      foreach ($attachments as $attachment) {
        $output = wp_get_attachment_url( $attachment->ID );
      }
    } elseif ( $attachments && $num > 1 ) {
      $output = $attachments;
    }
    wp_reset_postdata();
  }
  return $output;
}

function sunset_get_embeded_media( $type = array() ) {

  $content = do_shortcode( apply_filters(  'the_content', get_the_content() ) );
  $embed = get_media_embedded_in_content( $content, $type );

  if ( in_array( 'audio', $type) ) {
    $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
  } else {
    $output = $embed[0];
  }

  return $output;
}

function sunset_get_bs_slides( $attachments ) {

  $output = array();
  $count = count( $attachments ) - 1;
  for ( $i = 0; $i <= $count; $i++ ):
    $active = $i == 0 ? ' active' : '';

    $n = ( $i == $count ) ? 0 : $i+1;
    $nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID );
    $p = ( $i == 0 ) ? $count : $i-1;
    $prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID );

    $output[$i] = array(
      'class' => $active,
      'url' => wp_get_attachment_url( $attachments[$i]->ID ),
      'next_img' => $nextImg,
      'prev_img' => $prevImg,
      'caption' => $attachments[$i]->post_excerpt,
    );
  endfor;

  return $output;
}

function sunset_grab_url() {
  if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ) {
    return false;
  }
  return esc_url( $links[1] );
}

function sunset_grab_current_uri() {
  $http = isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
  $referer = $http . $_SERVER['HTTP_HOST'];
  $archive_url = $referer . $_SERVER['REQUEST_URI'];

  return $archive_url;
}

/*
=========
SIDEBAR FUNCTIONS
=========
*/
function sunset_sidebar_init() {
  $args = array(
    'name' => esc_html__( 'Sunset Sidebar', 'sunsettheme' ),
    'id' => 'sunset-sidebar',
    'description' => 'Dynamic Right Sidebar',
    'before_widget' => '<section id="%1$s" class="sunset-widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="sunset-widget-title">',
    'after_title' => '</h2>',
  );
  register_sidebar( $args );
}
add_action( 'widgets_init', 'sunset_sidebar_init' );

/*
=========
Single Post Custom Functions
=========
*/
function sunset_post_navigation() {
  $nav = '<div class="row">';
  $prev = get_previous_post_link( '<div class="post-link-nav"><span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span> %link</div>' );
  $nav .= '<div class="col-xs-12 col-sm-6">' . $prev . '</div>';
  $next = get_next_post_link( '<div class="post-link-nav">%link <span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span></div>' );
  $nav .= '<div class="col-xs-12 col-sm-6 text-right">' . $next . '</div>';
  $nav .= '</div>';

  return $nav;
}

function sunset_share_this( $content ) {

  if ( is_single() ) {
    $content .= '<div class="sunset-shareThis"><h4>Share this</h4>';

    $title = get_the_title();
    $permalink = get_the_permalink();
    $twitterHandler = get_option( 'twitter_handler' ) ? '&amp;via=' . esc_attr( get_option( 'twitter_handler' ) ) : '';

    $twitter = 'https://twitter.com/intent/tweet?text=' . $title . '&amp;url=' . $permalink . $twitterHandler . '';
    $facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
    $google = 'https://plus.google.com/share?url=' . $permalink;

    $content .= '<ul>';
    $content .= '<li><a href="' . $twitter . '" target="_blank" rel="nofollow"><span class="sunset-icon sunset-twitter"></span></a></li>';
    $content .= '<li><a href="' . $facebook . '" target="_blank" rel="nofollow"><span class="sunset-icon sunset-facebook"></span></a></li>';
    $content .= '<li><a href="' . $google . '" target="_blank" rel="nofollow"><span class="sunset-icon sunset-googleplus"></span></a></li>';
    $content .= '</ul></div><!-- .sunset-share -->';
  }

  return $content;
}
add_filter( 'the_content', 'sunset_share_this' );

function sunset_get_post_naigation() {
  // if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
  //   require( get_template_directory() . '/inc/templates/sunset-comment-nav.php' );
  // }
  require( get_template_directory() . '/inc/templates/sunset-comment-nav.php' );
}

function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71fed4e9e65f5d';
  $phpmailer->Password = '9c94f70a09e739';
}

add_action('phpmailer_init', 'mailtrap');

// Initilize global Mobile detect
function mobileDetectGlobal() {
  global $detect;
  $detect = new Mobile_Detect;
}
add_action( 'after_setup_theme', 'mobileDetectGlobal' );
