<?php

/*
@package sunsettheme
=========
Shortcode Options
=========
*/
function sunset_tooltip( $atts, $content = null ) {
  // get the attributes
  $atts = shortcode_atts(
    array(
      'placement' => 'top',
      'title' => '',
    ),
    $atts,
    'tooltip'
   );

   $title = $atts['title'] = '' ? $content : $atts['title'];

   // return html
   return '<span class="sunset-tooltip" data-toggle="tooltip" data-placement="' . $atts['placement'] . '" title="' . $title . '">' . $content . '</span>';
}

add_shortcode( 'tooltip', 'sunset_tooltip' );
