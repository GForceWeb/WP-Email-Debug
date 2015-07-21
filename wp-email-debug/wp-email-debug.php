<?php
/**
 * Plugin Name: WP E-Mail Debug
 * Description: Never accidentally send users emails from your testing sites again!
 * Version: 1.0.0
 * Author: Grant Derepas
 * Author URI: https://www.g-force.net
 */

if( !defined( 'ABSPATH' ) ) {
  exit();
}

if( !class_exists( 'WPMailDebugger' ) ) {

  final class WPMailDebugger {

    private static $instance;

    public static function instantiate() {
  		if( !isset( self::$instance ) && !self::$instance instanceof WPMailDebugger ) {
  			self::$instance = new WPMailDebugger;
  			self::$instance->includes();
  		}
  		return self::$instance;
    }

    public function includes() {

      if( !defined( 'WPMDBUG_PATH' ) ) {
			  define( 'WPMDBUG_PATH', plugin_dir_path( __FILE__ ) );
		  }

      require_once WPMDBUG_PATH . 'hooks.php';
    }

    /**
     *Returns true if the debugger is enabled in the plugin's settings.
     *@since 1.0.0
     *@return boolean
     */
    public static function doEnforce() {
      $enforce = get_option('WPMDBUG_enabled', FALSE);
      if ($enforce) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

    /**
     *Returns true if a switch of the email address should be performed, else false.
     *@since 1.0.0
     *@return boolean
     */
    public static function contextualSwitch() {
      $scope = get_option("WPMDBUG_plugins", array());

      if (is_array($scope) && count($scope) > 0) {
        // A switch depends on selected plugins
        $trace = debug_backtrace();

        foreach($scope as $sco) {
          $plugin_filename = str_replace('\\', '/', WP_PLUGIN_DIR . '/' . $sco);

          foreach($trace as $call) {
            if (isset($call['file'])) {
              if ($plugin_filename == str_replace('\\', '/', $call['file']) || stripos($call['file'], dirname($plugin_filename)) !== FALSE) {
                return TRUE;
              }
            }
          }
        }
        return FALSE;
      } else {
        return TRUE;
      }
    }

    public static function filterEmail( $args ) {
      $to_address = get_option('WPMDBUG_email', get_bloginfo('admin_email'));
      $original = $args['to'];

      if (self::contextualSwitch()) {
        $args['to'] = $to_address;
        $args['subject'] = '[DEBUG] ' . $args['subject'];
        $args['message'] = "Originally intended to be sent to " . $original . "\n" . $args['message'];
      }

      return $args;
    }

  }

  function WPMDBUG_start() {
    return WPMailDebugger::instantiate();
  }

  WPMDBUG_start();

}
