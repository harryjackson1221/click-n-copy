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

wp_register_script( 'clipboardjs', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js' , array() , '1.7' );
wp_enqueue_script('clipboardjs');
wp_register_script('copyjs', plugins_url('/js/copy.js', __FILE__), false, '1.0', 'all');
wp_enqueue_script( 'copyjs');

//lets add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'Click2Copy');

//Set the function to allow for the shortcode
function Click2Copy($atts, $content) {
//echo "<pre>\n";
//echo "attr: [";
//print_r($atts);
//echo "]\n";
//echo "content: [";
//print_r($content);
//echo "]";
//echo "</pre>\n";
//$escaped_copytext = htmlEntities( $content , ENT_NOQUOTES , ENT_HTML5 );
$escaped_copytext = htmlentities( $content );
$unescaped_copytext = html_entity_decode( $escaped_copytext );
return '<pre id="' . $atts['id'] . '">' . $escaped_copytext . '</pre><br/><center><button style="text-align: center;" class="btn ' . $atts['class'] . '" data-clipboard-text="' . $unescaped_copytext . '">
    ' . $atts['button-text'] . '
</button></center>';
}


//usage
//[c2c id="code1" class="btn" button-text="Copy"]
//a href="//link.com">link</a>
//<a href="//link.com">link</a>
//I can output HTML here and CSS
//#rule {
//color:#333;
//}
//[/c2c]

