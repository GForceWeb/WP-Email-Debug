=== WP Email Debug ===
Contributors: dr_scythe, jarred-kennedy
Donate link: http://g-force.net/donate/
Tags: email, debug, debugging, mail
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Never accidentally send users emails from your testing sites again!

== Description ==

This plugin makes it safe and easy to work with email in your testing environments. When enabled the plugin catches any instance of wp_mail and redirects the email to your chosen email address.

Key Features

*   Set a custom email address target to redirect emails to
*   Emails intercepted will have [Debug] added to the subject line to make them identifyable in your inbox
*   Interception rules can be limited by plugin allowing you to debug a specific plugin on your live site without affecting other operations
*   Notice in the WP Admin Bar when enabled.


== Installation ==

1. Upload the wp-email-debug folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the Email Debug Settings page to enable specific features

== Frequently Asked Questions ==

= Will this intercept all emails sent from WordPress? =

Generally speaking, Yes, but. This plugin catches all emails sent using the wp_mail function. Best practice specifies that plugins should use this function to send email but it is possible that developers could send email using another method in which case this plugin won't catch it.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* Initial Release
* Added plugin specific filters
* Added Admin Bar Notification
* Added Plugin Meta / Icon / Banner

= 0.1 =
* Built core filter functionality





== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
