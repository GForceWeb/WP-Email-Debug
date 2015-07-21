<?php
$WPMDBUGerror;
if ( WPMailDebugger::doEnforce() ) {
  add_filter( 'wp_mail', array('WPMailDebugger', 'filterEmail') );
}

add_action('admin_menu', 'WPMDBUG_settings_menu');
add_action('admin_init', 'WPMDBUG_handle_settings');
add_action('admin_notices', 'WPMDBUG_admin_notices');
add_action('admin_bar_menu', 'WPMDBUG_toolbar_link', 999);
add_action('admin_print_scripts', 'WPMDBUG_css');

function WPMDBUG_css(){
	?>
  <style type="text/css">
  #wp-admin-bar-WPMDBUG-toolbar .ab-item {color:red !important;}
  </style>
  <?php
}


function WPMDBUG_toolbar_link( $wp_admin_bar ) {
  if (WPMailDebugger::doEnforce()) {
  	$args = array(
  		'id'    => 'WPMDBUG-toolbar',
  		'title' => 'Email Debug ON',
  		'href'  => get_admin_url(NULL, 'options-general.php?page=wpmdbug')
  	);
  	$wp_admin_bar->add_node( $args );
  }
}

function WPMDBUG_settings_menu() {
	add_options_page('E-Mail Debugger', 'E-Mail Debugger', 'manage_options', 'wpmdbug', 'WPMDBUG_settings_page');
}

function WPMDBUG_settings_page() {
  require_once WPMDBUG_PATH . 'settings.php';
}

function WPMDBUG_handle_settings() {
  global $WPMDBUGerror;
  if (isset($_POST['wpmdbug_submit'])) {

    if (isset($_POST['wpmdbug_enabled'])) {
      update_option('WPMDBUG_enabled', TRUE);
    } else {
      update_option('WPMDBUG_enabled', FALSE);
    }

    $newEmail = $_POST['wpmdbug_sendto'];
    $newEmail = filter_var($newEmail, FILTER_VALIDATE_EMAIL);

    if ($newEmail === FALSE) {
      $WPMDBUGerror = "Invalid Email Address";
    } else {
      update_option('WPMDBUG_email', $newEmail);
    }

    $debug_scope = $_POST['wpmdbug_scope'];

    if ($debug_scope == 2) {
      if (isset($_POST['targetplugins']) && is_array($_POST['targetplugins']) && count($_POST['targetplugins']) > 0) {
        update_option('WPMDBUG_plugins', $_POST['targetplugins']);
      } else {
        $WPMDBUGerror = "You need to select at least one plugin for the plugin-specific redirect";
      }
    } else {
      update_option('WPMDBUG_plugins', array());
    }

  }
}

function WPMDBUG_admin_notices() {
  global $WPMDBUGerror;
  if (!empty($WPMDBUGerror)) {
    ?>
    <div class="error">
      <p><?php echo $WPMDBUGerror; ?></p>
    </div>
    <?php
  }
}
