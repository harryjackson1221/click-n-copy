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

wp_register_script( 'clipboardjs', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js' );
wp_enqueue_script('clipboardjs');

//lets add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'Click2Copy');

//Set the function to allow for the shortcode
function Click2Copy($atts, $content) {
echo "<pre>\n";
echo "attr: [";
print_r($atts);
echo "]\n";
echo "content: [";
print_r($content);
echo "]";
echo "</pre>\n";
//$escaped_copytext = htmlspecialchars( $content );
$escaped_copytext = htmlspecialchars( $content );
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
