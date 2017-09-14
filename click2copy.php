<?php
   /*
   Plugin Name: Click2Copy
   Plugin URI: https://github.com/harryjackson1221/click2copy
   Description: A plugin to add clipboard.js functionality to WordPress with a shortcode
   Version: 0.9
   Author: Harry Jackson (BoldGrid)
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

/** Add the admin menu help / instruction page right below pages menu item, using a function */
add_action( 'admin_menu', 'my_plugin_menu' );
/** Function to display help page  */
function my_plugin_menu() {
	add_menu_page( 'Click2Copy Options', 'Click2Copy Help', 'manage_options', 'click2copy', 'my_plugin_options', 'dashicons-screenoptions', '12' );
}
/** The page to add instructions on using */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<h2>Click2Copy Instructions</h2>';
	echo'<p><h2>Usage</h2><p>The shortcode can be applied in either the Page or Post Editor using the following syntax: [c2c id="" pclass="" button-text="Text"]content[/c2c]</p>
	<p>The options are as follows
    <ul>
    <li><b>id:</b> This identifies the code being copied, and only needs to be used if you have more than one instance on the page/post</li> 
    <li><b>pclass:</b> This applies a custom class to the &lt;pre&gt; HTML tag for styling purposes</li> 
    <li><b>bclass:</b> This applies a custom CSS class to the &lt;button&gt; HTML tag for styling purposes</li> 
    <li><b>button-text:</b> This allows you to set the button text</li> 
    </ul></p>
    <h2>Example Use</h2>
    <p>
    [c2c id=&quot;code1&quot; pclass=&quot;pre2&quot; bclass=&quot;btn&quot; button-text=&quot;Copy&quot;]<br/>
    &lt;html&gt;&lt;/html&gt; <br/>
    &lt;?php ?&gt; <br/>
    .css { display:code; }<br/>
    [/c2c]<br/>
    </p>
    <h2>Built With</h2>
    <ul>
    <li>clipboard.js - The Javascript Library</li>
    <li>PHP - The Language</li>
    <li>WordPress - The CMS</li>
    <li>HarryJ.us - The Person</li>
    <li><a href="#" target="_blank">Click2Copy</a> - The Project</li>
    </ul>
    </p>';
	echo '</div>';
}

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
