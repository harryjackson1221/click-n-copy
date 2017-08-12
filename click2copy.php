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

wp_register_script( 'clipboardjs', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js' , array() , '1.7', 'all' );
wp_enqueue_script('clipboardjs');
wp_register_script('copyjs', plugins_url('/js/copy.js', __FILE__), false, '1.0', 'all');
wp_enqueue_script( 'copyjs');
wp_register_style('click2copy', plugins_url('/css/copy.css', __FILE__), false, '1.0', 'all');
wp_enqueue_style( 'click2copy');

/** Add the admin menu, using my function */
add_action( 'admin_menu', 'my_plugin_menu' );
/** Function to set my options */
function my_plugin_menu() {
        add_menu_page( 'Click2Copy Options', 'Click2Copy', 'manage_options', 'click2copy', 'my_plugin_options', '', '10' );
}
/** The page to add forms for setting the things */
function my_plugin_options() {
        if ( !current_user_can( 'manage_options' ) )  {
                wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        echo '<div class="wrap">';
        echo '<h2>Click2Copy Options</h2>';
        echo '<img src="https://www.boldgrid.com/assets/logos/boldgrid-logo-horizontal-black-lg.png" width="50%">';
        echo'<p>Here is where the form would go if I actually had options.</p>';
        echo '</div>';
}

function append2_footer_admin () {
echo '<i class="footer-custom">| Made awesome by <a href="//harryj.us" target="_blank">Harry</a>.</i>';
}
add_filter('admin_footer_text', 'append2_footer_admin');



//lets add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'Click2Copy');

//Set the function to allow for the shortcode
function Click2Copy($atts, $content) {
//echo "<pre>\n";
//echo "attr: [";
//print_r($content, ENT_NOQUOTES);
//echo "]\n";
//echo "content: [";
//print_r($content);
//echo "]";
//echo "</pre>\n";
$escaped_copytext = htmlentities( $content );
$escaped_copytext2 = htmlspecialchars( $content );
//$unescaped_copytext = html_entity_decode( $content );
return '<pre id="' . $atts['id'] . '" class="' . $atts['pclass'] . '">' . $escaped_copytext2 . '</pre><br/><center>
<button style="text-align: center;" class="' . $atts['bclass'] . '" data-clipboard-target="pre#' . $atts['id'] . '">
    ' . $atts['button-text'] . '
</button></center>';
}
