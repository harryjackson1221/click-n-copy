<?php
   /*
   Plugin Name: Click2Copy
   Plugin URI: https://github.com/harryjackson1221/click-n-copy
   Description: A plugin to rule them all and add clipboard.js to WordPress
   Version: 0.1
   Author: Harry Jackson
   Author URI: http://harryj.us
   License: GPL2
   */


// Protections
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

remove_filter('the_content', 'wpautop');

wp_register_script( 'clipboardjs', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js' , array() , '1.7.1', 'all' );
wp_enqueue_script('clipboardjs');
wp_register_script('copyjs', plugins_url('/js/copy.js', __FILE__), false, '1.0', 'all');
wp_enqueue_script( 'copyjs');
wp_register_style('click2copy', plugins_url('/css/copy.css', __FILE__), false, '1.0', 'all');
wp_enqueue_style( 'click2copy');



add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );
function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
    $shortcodes[] = 'c2c';
    return $shortcodes;
}


//lets add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'Click2Copy');

//Set the function to allow for the shortcode
function Click2Copy($atts, $content) {
$escaped_copytext = htmlspecialchars( $content );
//$unescaped_copytext = html_entity_decode( $content );
return '<pre id="' . $atts['id'] . '" class="' . $atts['pclass'] . '">' . $escaped_copytext . '</pre><br/><center>
<button style="text-align: center;" class="' . $atts['bclass'] . '" data-clipboard-target="pre#' . $atts['id'] . '">
    ' . $atts['button-text'] . '
</button></center>';
}
