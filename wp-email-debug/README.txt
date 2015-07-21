=== WP Email Debug ===
Contributors: dr_scythe, jarred-kennedy
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=56VAQGWSU2VRL
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

= For Bugs Reports or to contribute =

Please visit our public [GitHub Repo](https://github.com/GForceWeb/WP-Email-Debug/)


== Installation ==

1. Upload the wp-email-debug folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the Email Debug Settings page to enable specific features

== Frequently Asked Questions ==

= Will this intercept all emails sent from WordPress? =

Generally speaking, Yes, but. This plugin catches all emails sent using the wp_mail function. Best practice specifies that plugins should use this function to send email but it is possible that developers could send email using another method in which case this plugin won't catch it.

== Screenshots ==

1. WP EMail Debug Settings Screen

== Changelog ==

= 1.0 =
* Initial Release
* Added plugin specific filters
* Added Admin Bar Notification
* Added Plugin Meta / Icon / Banner

= 0.1 =
* Built core filter functionality
