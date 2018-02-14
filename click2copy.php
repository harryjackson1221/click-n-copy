<?php
/*
Plugin Name: click2copy
Plugin URI: https://github.com/harryjackson1221/click2copy
Description: One Plugin to Rule Them All! and it also adds clipboard.js functionality to WordPress, to copy code snippets and create smiles :-)
Version: 1.0
Author: Harry Jackson
Author URI: http://harryj.us
License: GPL2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Protections
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//add the scripts and fallback styles for pre box and button
wp_register_script( 'clipboardjs', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js' , array() , '1.7', 'all' );
wp_enqueue_script('clipboardjs');

wp_register_script('copyjs', plugins_url('/js/copy.js', __FILE__), false, '0.4', 'all');
wp_enqueue_script( 'copyjs');

wp_register_style('click2copy', plugins_url('/css/copy.css', __FILE__), false, '0.4', 'all');
wp_enqueue_style( 'click2copy');


function c2c_custom_option_logo() {
    echo '<style type="text/css">.c2c:before {content: url(' . plugins_url( 'images/logo-small.png', __FILE__ ) . ') !important;background-repeat: no-repeat;position:relative;top:5px;}</style>';
}

//hook into the administrative header output, so we can add the logo :before
add_action('wp_before_admin_bar_render', 'c2c_custom_option_logo');

/** add plugin settings page **/
add_action( 'admin_menu', 'c2c__add_admin_menu' );
add_action( 'admin_init', 'c2c__settings_init' );


function c2c__add_admin_menu(  ) { 
    add_options_page( 'click2copy', 'click2copy', 'manage_options', 'click2copy', 'c2c__options_page' );
}

function c2c__settings_init(  ) { 

    register_setting( 'pluginPage', 'c2c__settings');

    add_settings_section(
        'c2c__pluginPage_section', 
        __( 'click2copy Options', 'click2copy' ), 
        'c2c__settings_section_callback', 
        'pluginPage'
    );

    add_settings_field( 
        'c2c__text_field_0', 
        __( '&lt;pre&gt; CSS class', 'click2copy' ), 
        'c2c__text_field_0_render', 
        'pluginPage', 
        'c2c__pluginPage_section' 
    );

    add_settings_field( 
        'c2c__text_field_1', 
        __( '&lt;button&gt; CSS Class', 'click2copy' ), 
        'c2c__text_field_1_render', 
        'pluginPage', 
        'c2c__pluginPage_section' 
    );

    add_settings_field( 
        'c2c__text_field_2', 
        __( '&lt;button&gt; Text', 'click2copy' ), 
        'c2c__text_field_2_render', 
        'pluginPage', 
        'c2c__pluginPage_section' 
    );
}

function c2c__text_field_0_render(  ) { 

    $options = get_option( 'c2c__settings' );

    ?>
    <input type='text' name='c2c__settings[c2c__text_field_0]' placeholder="c2cpre" value='<?php echo $options['c2c__text_field_0']; ?>'>
    <?php
}

function c2c__text_field_1_render(  ) { 

    $options = get_option( 'c2c__settings'  );
    ?>
    <input type='text' name='c2c__settings[c2c__text_field_1]' placeholder="button-primary" value='<?php echo $options['c2c__text_field_1']; ?>'>
    <?php
}

function c2c__text_field_2_render(  ) { 

    $options = get_option( 'c2c__settings'  );

    ?>
    <input type='text' name='c2c__settings[c2c__text_field_2]' placeholder="Copy" value='<?php echo $options['c2c__text_field_2']; ?>'>
    <?php
}

function c2c__settings_section_callback(  ) { 

    echo __( '<p><ul><li><b>id:</b> This identifies the code being copied, and needs to be unique for each snippet you have on the page/post. This is set within the shortcode as id="unique ID" and allows the button to target the correct element</li><li><b>pclass:</b> This applies a custom CSS class to the &lt;pre&gt; HTML tag for styling purposes</li><li><b>bclass:</b> This applies a custom CSS class to the &lt;button&gt; HTML tag for styling purposes</li><li><b>button-text:</b> This allows you to set the button text</li></ul></p>' , 'click2copy' );
}

// Create the settings page content
function c2c__options_page(  ) { 
        if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    ?>
    <form action='options.php' method='post'>

        <?php  echo __('<h1 class="c2c"> click2copy</h1><p><h2>Usage</h2><p>The shortcode can be applied in either the Page or  Post Editor using the following syntax: [c2c id="unique-ID"]content[/c2c]</p>');

        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>

    </form>

        <?php  echo __('<h2>Example Use</h2><p>[c2c id=&quot;code1&quot;]<br/>&lt;html&gt;&lt;/html&gt; <br/>&lt;?php ?&gt; <br/>.css { display:code; }<br/>[/c2c]<br/></p>     
        <h2>Built With</h2><ul><li><a href="https://clipboardjs.com/" target="_blank">clipboard.js</a> - the JavaScript (thanks!)</li><li><a href="http://harryj.us/" target="_blank">harryj.us</a> - the person</li><li><a href="https://github.com/harryjackson1221/click2copy" target="_blank">click2copy</a> - the project</li></ul></p>');
} 

// stop the curly quotes in the shortcode c2c
add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );

function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
    $shortcodes[] = 'c2c';
    return $shortcodes;
}

//autop adds some line breaks so remove it, add it back with a higher priority 
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );
//add_filter('the_content', 'wpautop','99');

// add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'click2copy');


function copter_remove_crappy_markup( $string )
{
    $patterns = array(
        '#^\s*</p>#',
        '#<p>\s*$#',
        '/<br \/>/iU'
    );
    return preg_replace($patterns, '', $string);
}
// set the function for the shortcode
function click2copy($atts, $content) {
// Create default options for the array, in case someone doesnt set an option


    $c2c_options = get_option('c2c__settings');


    //set constants for options, and defaults for empty fields
    $c2c_pre = $c2c_options['c2c__text_field_0'];
    if ( empty($c2c_pre) ) $c2c_pre = 'c2cpre';

    $c2c_button = $c2c_options['c2c__text_field_1'];
    if ( empty($c2c_button) ) $c2c_button = 'button-c2c';

    $c2c_btn_text = $c2c_options['c2c__text_field_2'];
    if ( empty($c2c_btn_text) ) $c2c_btn_text = '<img src="' . plugins_url( 'images/logo-small.png', __FILE__ ) . '" width="23px">';
    $clean = copter_remove_crappy_markup( $content );
    $escaped_copytext = htmlspecialchars( "$clean" );
    

// Testing stuffs
// echo '<pre>';
//    var_dump( $content );
// echo '</pre>';

// Return the content    
    return '<div class="c2c-wrapper"><pre id="' . $atts['id'] . '" class="' . $c2c_pre . '">' . $escaped_copytext . '</pre><button data-toggle="tooltip" class="' . $c2c_button . '" data-clipboard-target="pre#' . $atts['id'] . '">' . $c2c_btn_text . '</button></div>';
}

?>
