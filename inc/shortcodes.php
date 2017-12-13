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

function sunset_popover( $atts, $content = null ) {
  // [popover title="Popover title" placement="top" trigger="click" content="This is popover content"]This is clickable content[/popover]

  // get the attributes
  $atts = shortcode_atts(
    array(
      'placement' => 'top',
      'trigger' => 'click',
      'title' => '',
      'content' => '',
    ),
    $atts,
    'popover'
   );

   // return html
   return '<span class="sunset-popover" data-toggle="popover" data-placement="' . $atts['placement'] . '" data-trigger="' . $atts['trigger'] . '" data-content="' . $atts['content'] . '" title="' . $atts['title'] . '">' . $content . '</span>';
}

add_shortcode( 'popover', 'sunset_popover' );
