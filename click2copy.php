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

wp_register_script( 'clipboardjs', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js' );
wp_enqueue_script('clipboardjs');

//lets add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'Click2Copy');

//Set the function to allow for the shortcode, need to replace htmlspecialchars with something that works on single and double quotes inside "", currently have to set copytext with single quotes, and can only use double in code
function Click2Copy($atts, $content) {
$escaped_copytext = htmlspecialchars( $atts[ 'copytext' ] );
return '<pre>' . $escaped_copytext . '</pre><br/><button id="' . $atts['id'] . '" class="' . $atts['class'] . '" data-clipboard-text="' . $escaped_copytext . '">
    ' . $atts['button-text'] . '
</button>
    <script>
    var clipboard = new Clipboard(' . $atts['id'] . ');
    clipboard.on("success", function(e) {
        console.log(e);
    });
    clipboard.on("error", function(e) {
        console.log(e);
    });
    </script>';
}




//usage
//[c2c id="code1" class="css-custom-class" content="testing"]
