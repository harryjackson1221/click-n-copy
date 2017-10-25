# Click2Copy
Basic [WordPress](https://wordpress.org/) [Shortcode](https://codex.wordpress.org/Shortcode) [Plugin](https://codex.wordpress.org/Plugins) to use [clipboard.js](https://clipboardjs.com) for copying content, such as HTML and CSS code snippets with the click of a button. 

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

1. Visit the 'Settings > click2copy' page, set your preferred CSS Classes for the pre and button class, type your preferred Button Text, and save the settings.
2. Insert your code with the surrounding tags in any page/post[c2c id="code1"]content[/c2c]

**Options:**
* **pclass:** This applies a custom class to the <pre> HTML tag for styling purposes
* **bclass:** This applies a custom CSS class to the <button> HTML tag for styling purposes
* **button-text:** This allows you to set the button text

## Usage
The shortcode can be applied in either the Page or Post Editor using the following syntax: [c2c]content[/c2c]

The shortcode can be applied in either the Page or Post Editor using the following syntax: [c2c id="uniqueID"]content[/c2c]. It is packaged with support for shortcode tag [c2c] which automatically converts all special characters to HTML entities.

**Attributes:**
* id: This identifies the code being copied, and needs to be unique for each code snippet if you have more than one instance on the page/post

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
