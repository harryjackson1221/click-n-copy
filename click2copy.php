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
?>

// Protections
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//enqueue clipboard.js
wp_enqueue_script( 'clipboardjs', get_stylesheet_directory_uri() . 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js',false,'1.7.1','all');

//lets add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'Click2Copy');

//Set the function to allow for the shortcode
function Click2Copy($atts, $content) {
 return'<button id="' . $atts['id'] . '" class="' . $atts['class'] . '" data-clipboard-text="' . $atts['content'] . '">
    ' . $atts['button-text'] . '
</button>'
    <script>
    var btn = document.getElementById(\'' . $atts['id'] . '\');
    var clipboard = new Clipboard(code1);
    clipboard.on(\'success\', function(e) {
        console.log(e);
    });
    clipboard.on(\'error\', function(e) {
        console.log(e);
    });
    </script>;
}

//usage
//[c2c id="code1" class="css-custom-class" content="testing"]
