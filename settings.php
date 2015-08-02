<?php
$scopes = get_option('WPMDBUG_plugins', array());
$scope = (is_array($scopes) && count($scopes) > 0);

if (!function_exists('get_plugins')) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$plugins = get_plugins();
?>
<div class="wrap">
  <h2>E-Mail Debugger Settings</h2>
  <form action="options-general.php?page=wpmdbug" method="post">
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">Enable E-Mail Debugging</strong></th>
          <td>
            <label>
              <input type="checkbox" value="1" name="wpmdbug_enabled" <?php echo (WPMailDebugger::doEnforce()) ? 'checked="checked"': ''; ?>/>
            </label>
          </td>
        </tr>
        <tr>
          <th scope="row">Redirect E-Mails To</strong></th>
          <td>
            <label>
              <input type="text" size="40" value="<?php echo get_option('WPMDBUG_email', get_bloginfo('admin_email')); ?>" name="wpmdbug_sendto"/>
            </label>
          </td>
        </tr>
        <tr>
          <th scope="row">&nbsp;</strong></th>
          <td>
            <label>
              <input type="radio" value="1" name="wpmdbug_scope" <?php echo ($scope) ? '': 'checked="checked"'; ?>/>
              &nbsp;Redirect all e-mails sent through WordPress
            </label>
            <br/>
            <label>
              <input type="radio" value="2" name="wpmdbug_scope" <?php echo ($scope) ? 'checked="checked"': ''; ?>/>
              &nbsp;Limit to specific plugins
            </label>
          </td>
        </tr>
        <tr style="display:<?php echo ($scope) ? 'table-row': 'none'; ?>;" id="pluginlist">
          <th scope="row">Select Plugins</th>
          <td>
            <table>
              <tbody>
                <tr>
                  <th colspan="2">
                    <input type="checkbox" id="selall" <?php echo (count($scopes) === count($plugins)) ? 'checked="checked"': ''; ?>/> Select All
                  </th>
                </tr>
                <?php foreach ($plugins as $plugin => $pdata): if (stripos($plugin, 'wp-mail-debugger.php') !== FALSE) {continue;} ?>
                  <tr>
                    <td style="padding-top: 5px; padding-bottom: 5px;"><input type="checkbox" name="targetplugins[]" value="<?php echo $plugin; ?>" <?php echo ($scope && in_array($plugin, $scopes)) ? 'checked="checked"': ''; ?>/></td>
                    <td style="padding-top: 5px; padding-bottom: 5px;"><?php echo $pdata['Name']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <p><input type="submit" name="wpmdbug_submit" value="Save Settings" class="button-primary"/></p>
  </form>
</div>
<script type="text/javascript">
  (function($) {
    $("input[name='wpmdbug_scope']").on("click", function() {
      var target = $("input[name='wpmdbug_scope']:checked").val();
      if (target == 2) {
        $("#pluginlist").show();
      } else {
        $("#pluginlist").hide();
      }
    });
    $("#selall").on("click", function() {
      $("input[name='targetplugins[]']").prop("checked", $(this).prop("checked"));
    });
  })(jQuery);
</script>
