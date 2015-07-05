<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://g-force.net
 * @since      1.0.0
 *
 * @package    WP_Email_Debug
 * @subpackage WP_Email_Debug/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Email_Debug
 * @subpackage WP_Email_Debug/public
 * @author     Grant Derepas <grant@g-force.net>
 */
class WP_Email_Debug_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp_email_debug    The ID of this plugin.
	 */
	private $wp_email_debug;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wp_email_debug       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wp_email_debug, $version ) {

		$this->wp_email_debug = $wp_email_debug;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Email_Debug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Email_Debug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wp_email_debug, plugin_dir_url( __FILE__ ) . 'css/wp-email-debug-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Email_Debug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Email_Debug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->wp_email_debug, plugin_dir_url( __FILE__ ) . 'js/wp-email-debug-public.js', array( 'jquery' ), $this->version, false );

	}

}
