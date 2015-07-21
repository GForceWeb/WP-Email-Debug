# WP EMail Debug

This WordPress plugin makes it safe and easy to work with email in your testing environments. When enabled the plugin catches any instance of wp_mail and redirects the email to your chosen email address.

Key Features

*   Set a custom email address target to redirect emails to
*   Emails intercepted will have [Debug] added to the subject line to make them identifyable in your inbox
*   Interception rules can be limited by plugin allowing you to debug a specific plugin on your live site without affecting other operations
*   Notice in the WP Admin Bar when enabled.

## Installation

1. Upload the wp-email-debug folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the Email Debug Settings page to enable specific features

## FAQs

= Will this intercept all emails sent from WordPress? =

Generally speaking, Yes, but. This plugin catches all emails sent using the wp_mail function. Best practice specifies that plugins should use this function to send email but it is possible that developers could send email using another method in which case this plugin won't catch it.

## Credits

Original Plugin Designed and Developed by [Grant Derepas](http://g-force.net) & [Jarred Kennedy](https://www.freelancer.com/u/JarredKennedy.html)

## License

GLPv2
