<?php

 /**
 * @package SendinBlueWPPlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi

    class AdminPage extends BaseController
    {
        public $settings;

        public $pages = array();

    	function __construct(){
            $this->settings = new SettingsApi();

            $this->pages = array(
            array(
                'page_title' => 'SoftinkLab Plugin', 
                'menu_title' => 'SoftinkLab', 
                'capability' => 'manage_options', 
                'menu_slug' => 'softinklab_dashboard', 
                'callback' => function() { echo '<h1>Track User Plugin</h1>'; }, 
                'icon_url' => 'dashicons-store', 
                'position' => 110
            )
        );

    	}

        public function register()
        {
            $this->settings->addPages($this->pages)->register();
        }



// public function register(){
// 	 add_action( 'admin_menu', array($this, 'add_admin_pages'));
// }

  //   	public function add_admin_pages(){
  //   		 add_menu_page( 'softinklab Dashboard', 'softinklab', 'manage_options', 'softinklab_dashboard', array($this,'admin_index'), 'dashicons-store', 110);
		// }

 	// 	function admin_index(){
  // 			require_once PLUGIN_PATH.'templates/dashboard.php';
		// }
    }