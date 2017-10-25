=== click2copy ===
Contributors: harryjackson1221
Tags: clipboard, copy, click, code, snippet
Requires at least: 2.5
Tested up to: 4.9
Stable tag: 1.0
License: GPLv2 or later

click2copy is a WordPress shortcode plugin that uses clipboard.js for copying HTML, PHP, JavaScript, CSS or any other programming language code snippets to your clipboard with the click of a button. 

== Description ==

The shortcode can be applied in either the Page or Post Editor using the following syntax: [c2c id="uniqueID"]content[/c2c]. It is packaged with support for shortcode tag [c2c] which automatically converts all special characters to HTML entities.

== Installation ==

= From your WordPress Dashboard =

1. Go to 'Plugins > Add New'
2. Search for 'CC-Syntax-Highlight'
3. Activate the plugin from the Plugin section on your WordPress Dashboard.

= From WordPress.org =

1. Download 'click2copy'.
2. Upload the 'cc-syntax-highlight' directory to your '/wp-content/plugins/' directory using your favorite method (ftp, sftp, scp, etc...)
3. Activate the plugin from the Plugin section in your WordPress Dashboard.

= Once Activated =

1. Visit the 'Settings > click2copy' page, set your preferred CSS Classes for the pre and button class, type your preferred Button Text, and save the settings.
2. Insert your code with the following shortcode tags in any page/post[c2c id="code1"]content[/c2c]

**Options:**
* pclass: This applies a custom class to the <pre> HTML tag for styling purposes
* bclass: This applies a custom CSS class to the <button> HTML tag for styling purposes
* button-text: This allows you to set the button text

**Shortcode Attributes:**
* id: This identifies the relationship between the code being copied and the button that triggers the event. The id needs to be unique for each code snippet if you have more than one instance on the Page or Post.

= Example Usage =
[c2c id="code1"]
<div class="row">
<div class="col-md-9 col-xs-12 col-sm-12">
<div class="mod-blockquote">
A blockquote highlights &quot; important information, " which may or may not be an actual quote.
</div>
</div>
</div>
[/c2c]

== Changelog ==

= 1.0 =
*Release Date - TBD (Soon)*

* Added constants for options with defaults if not set
* Added styling for default options
* 

= 0.3 =
*Release Date - 01 October 2017*

* Fixed Admin Settings Page format
* Added Settings link to plugin page
* Added icon and logo
* Added license.txt with GPL
* Added readme.txt 

= 0.2 =
*Release Date - 01 September 2017*

* Fixed some problems with double quotes being converted to curly quotes by autotexturize
* Added custom CSS classes for pre and button tag


= 0.1 =
*Release Date - 08 August 2017*

* Initial Release
