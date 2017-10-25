# click2copy

click2copy is a [WordPress](https://wordpress.org/) [shortcode](https://codex.wordpress.org/Shortcode) [plugin](https://codex.wordpress.org/Plugins) that uses [clipboard.js](https://clipboardjs.com/) for copying HTML, PHP, JavaScript, CSS or any other programming language code snippets to your clipboard with the click of a button. 

## Screenshot
![ScreenShot](/screenshot.png?raw=true "ScreenShot")

## Prerequisites

[WordPress](https://wordpress.org/) should be installed on your website, then you can grab the latest copy from [our GitHub release page](https://github.com/harryjackson1221/click2copy/releases/)


## Installing 

Download the [latest release](https://github.com/harryjackson1221/click2copy/releases/)

Install the plugin using the [following guide](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation) for installing a WordPress plugin manually.

Activate the plugin

## Once Activated

1. Visit the 'Settings > click2copy' page, set your preferred CSS Classes for the pre and button class, and your preferred Button Text, then save the settings.
2. Insert your code content with the opening and closing tags in any Page or Post: [c2c id="code1"]content[/c2c]

**Options:**
* **pclass:** This applies a custom class to the &lt;pre&gt; HTML tag for styling purposes (default: c2cpre)
* **bclass:** This applies a custom CSS class to the &lt;button&gt; HTML tag for styling purposes (default: button-c2c)
* **button-text:** This allows you to set the button text label (default: Copy)

## Usage
The shortcode can be applied multiple times in either the Page or Post Editor using the following syntax: 
[c2c id="uniqueID"]content[/c2c]. 

**Attributes:**
* id: This identifies the code being copied, and needs to be unique for each code snippet if you have more than one instance on the Page or Post. 

### *Example Use*
```
[c2c id="code1"]
<div class="row">
<div class="col-md-9 col-xs-12 col-sm-12">
<div class="mod-blockquote">
A blockquote highlights &quot; important information, " which may or may not be an actual quote. A blockquote highlights &quot; important information, " which may or may not be an actual quote.  A blockquote highlights &quot; important information, " which may or may not be an actual quote. 
It uses distinct styling to set it apart from other content on the page
</div>
</div>
</div>
[/c2c]
```

# Built With
* [clipboard.js](https://clipboardjs.com) - The Javascript Library | [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
* [PHP](http://php.net/) - The Language
* [WordPress](https://wp.org/) - The CMS
* [HarryJ.us](http://harryj.us/) - The Person
* [Coffee](https://en.wikipedia.org/wiki/Coffee) - The Fuel
