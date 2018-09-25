<?php 
/**
 * @package  SendinBlueWPPlugin
 */
namespace Inc\Api\Callbacks;
use Inc\Base\BaseController;

class AdminCallbacks extends BaseController{
	// Load Pages
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}
	// Admin Settings
	public function sbwpOptionsGroup( $input )
	{
		return $input;
	}
	public function sbwpAdminSection()
	{
		echo 'Please enter your automation key here.';
	}
	public function sbwpApiKeySet()
	{
		$value = esc_attr( get_option( 'sbwp_api_key' ) );
		echo '<input type="text" class="regular-text" name="sbwp_api_key" value="' . $value . '" placeholder="">';
	}
}