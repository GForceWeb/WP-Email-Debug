<?php
/**
 * Plugin Name: WP E-Mail Debug
 * Plugin URI: https://wordpress.org/plugins/wp-email-debug
 * Description: Never accidentally send users emails from your testing sites again!
 * Version: 1.2.0
 * Author: Grant Derepas
 * Author URI: https://www.g-force.net
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'WPMailDebugger' ) ) {

	final class WPMailDebugger {

		private static $instance;

		public static function instantiate() {
			if ( ! isset( self::$instance ) && ! self::$instance instanceof WPMailDebugger ) {
				self::$instance = new WPMailDebugger;
				self::$instance->includes();
			}
			return self::$instance;
		}

		public function includes() {

			if ( ! defined( 'WPMDBUG_PATH' ) ) {
				define( 'WPMDBUG_PATH', plugin_dir_path( __FILE__ ) );
			}

			require_once WPMDBUG_PATH . 'hooks.php';
		}

		/**
		 * Returns true if the debugger is enabled in the plugin's settings.
		 *
		 * @since 1.0.0
		 * @return boolean
		 */
		public static function doEnforce() {
			return apply_filters( 'wp_email_debug_enabled', get_option( 'WPMDBUG_enabled', false ) );
		}

		/**
		 * Returns true if a switch of the email address should be performed, else false.
		 *
		 * @since 1.0.0
		 * @return boolean
		 */
		public static function contextualSwitch() {

			$scope = get_option( 'WPMDBUG_plugins', array() );

			if ( is_array( $scope ) && count( $scope ) > 0 ) {

				// A switch depends on selected plugins
				$trace = debug_backtrace();

				foreach ( $scope as $sco ) {
					$plugin_filename = str_replace( '\\', '/', WP_PLUGIN_DIR . '/' . $sco );

					foreach ( $trace as $call ) {
						if ( isset( $call[ 'file' ] ) ) {
							if ( $plugin_filename == str_replace( '\\', '/', $call[ 'file' ] ) || stripos( $call[ 'file' ], dirname( $plugin_filename ) ) !== false ) {
								return true;
							}
						}
					}
				}

				return false;
			}

			return true;
		}

		public static function filterEmail( $args ) {
			$isHtml  = isset( $args[ 'html' ] );
			$prefix  = '';
			$message = $isHtml ? $args[ 'html' ] : $args[ 'message' ];

			if ( self::contextualSwitch() ) {

				// Prefix message
				$prefix = sprintf(
					__( 'Originally intended to be sent to %s', 'wp-email-debug' ),
					$args[ 'to' ]
				);

				if ( ! empty( $prefix ) ) {
					$prefix = $prefix . ( $isHtml ? '<br>' : '\n' );
				}

				// Update email to address
				$args[ 'to' ] = get_option( 'WPMDBUG_email', get_bloginfo( 'admin_email' ) );

				// Update email subject
				$args[ 'subject' ] = sprintf(
					__( '[DEBUG] %s', 'wp-email-debug' ),
					$args[ 'subject' ]
				);

			}

			$message = $prefix . $message;

			if ( $isHtml ) {
				$args[ 'html' ] = $message;
			}
			else {
				$args[ 'message' ] = $message;
			}

			return $args;
		}

	}

	function WPMDBUG_start() {
		return WPMailDebugger::instantiate();
	}

	WPMDBUG_start();

}
