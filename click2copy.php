<?php
/*
Plugin Name: click2copy
Plugin URI: https://github.com/harryjackson1221/click2copy
Description: One Plugin to Rule Them All! and it also adds clipboard.js functionality to WordPress, to copy code snippets and create smiles :-)
Version: 0.3
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

//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'c2c_custom_option_logo');

/** add plugin settings */
add_action( 'admin_menu', 'c2c__add_admin_menu' );
add_action( 'admin_init', 'c2c__settings_init' );


function c2c__add_admin_menu(  ) { 
    add_options_page( 'click2copy', 'click2copy', 'manage_options', 'click2copy', 'c2c__options_page' );
}


function c2c__settings_init(  ) { 

    register_setting( 'pluginPage', 'c2c__settings' );

    add_settings_section(
        'c2c__pluginPage_section', 
        __( 'Global Options', 'click2copy' ), 
        'c2c__settings_section_callback', 
        'pluginPage'
    );

    add_settings_field( 
        'c2c__text_field_0', 
        __( '&lt;pre&gt; css class', 'click2copy' ), 
        'c2c__text_field_0_render', 
        'pluginPage', 
        'c2c__pluginPage_section' 
    );

    add_settings_field( 
        'c2c__text_field_1', 
        __( 'Button CSS Class', 'click2copy' ), 
        'c2c__text_field_1_render', 
        'pluginPage', 
        'c2c__pluginPage_section' 
    );

    add_settings_field( 
        'c2c__text_field_2', 
        __( 'Button text', 'click2copy' ), 
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

    $options = get_option( 'c2c__settings' );
    ?>
    <input type='text' name='c2c__settings[c2c__text_field_1]' placeholder="button-primary" value='<?php echo $options['c2c__text_field_1']; ?>'>
    <?php

}


function c2c__text_field_2_render(  ) { 

    $options = get_option( 'c2c__settings' );
    ?>
    <input type='text' name='c2c__settings[c2c__text_field_2]' placeholder="Copy" value='<?php echo $options['c2c__text_field_2']; ?>'>
    <?php

}


function c2c__settings_section_callback(  ) { 

    echo __( 'This section description', 'click2copy' );

}


function c2c__options_page(  ) { 
        if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    ?>
    <form action='options.php' method='post'>

        <?php    echo '<h1 class="c2c"> click2copy</h1>
        <p><h2>Usage</h2><p>The shortcode can be applied in either the Page or  Post Editor using the following syntax: [c2c id="" pclass="" button-text="Text"]content[/c2c]</p>
        <h2>Options</h2>
        <p><ul>
        <li><b>id:</b> This identifies the code being copied, and only needs to be unique for each snippet if you have more than one instance on the page/post</li> 
        <li><b>pclass:</b> This applies a custom class to the &lt;pre&gt; HTML tag for styling purposes</li> 
        <li><b>bclass:</b> This applies a custom CSS class to the &lt;button&gt; HTML tag for styling purposes</li> 
        <li><b>button-text:</b> This allows you to set the button text</li> 
        </ul></p>';

        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>

    </form>


    <?php
     echo '<h2>Example Use</h2>
        <p>[c2c id=&quot;code1&quot;]<br/>
        &lt;html&gt;&lt;/html&gt; <br/>
        &lt;?php ?&gt; <br/>
        .css { display:code; }<br/>
        [/c2c]<br/>
        </p>';
        
    echo '<h2>Built With</h2>
        <ul>
        <li><a href="https://clipboardjs.com/" target="_blank">clipboard.js</a> - the JavaScript (thanks!)</li>
        <li><a href="http://harryj.us/" target="_blank">harryj.us</a> - the person</li>
        <li><a href="https://github.com/harryjackson1221/click2copy" target="_blank">click2copy</a> - the project</li>
        </ul>
        </p>';
    
    echo '';
}
 
 

// stop the curly quotes in the shortcode c2c
add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );

function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
    $shortcodes[] = 'c2c';
    return $shortcodes;
}

// add a shortcode to echo and copy the content tag in a shortcode
add_shortcode('c2c', 'click2copy');

// set the function for the shortcode
function click2copy($atts, $content) {

    $escaped_copytext = htmlspecialchars( "$content" );

    $c2c_options = get_option( 'c2c__settings' );

    return '<pre id="' . $atts['id'] . '" class="' . $c2c_options['c2c__text_field_0'] . '">' . $escaped_copytext . '</pre><button class="' . $c2c_options['c2c__text_field_1'] . '" data-clipboard-target="pre#' . $atts['id'] . '">' . $c2c_options['c2c__text_field_2'] . '</button>';
}


?>
