<?php

/**
 * @package  SendinBlueWPPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController{

	public $settings;
	public $callbacks;
	public $pages = array();
    public $subpages = array();
    
	public function register() {
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->setPages();
		$this->setSettings();
		$this->setSections();
		$this->setFields();
		$this->settings->addPages( $this->pages )->register();
    }
    
	public function setPages() {
		$this->pages = array(
			array(
				'page_title' => 'SendinBlue Tracker', 
				'menu_title' => 'SendinBlue Tracker', 
				'capability' => 'manage_options', 
				'menu_slug' => 'sendinblue-wp-plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-email-alt', 
				'position' => 110
			)
		);
    }

	public function setSettings(){
		$args = array(
			array(
				'option_group' => 'sbwp_settings_group',
				'option_name' => 'sbwp_api_key',
				'callback' => array( $this->callbacks, 'sbwpOptionsGroup' )
			)
		);
		$this->settings->setSettings( $args );
	}

	public function setSections(){
		$args = array(
			array(
				'id' => 'sbwp_admin_index',
				'title' => 'API Key',
				'callback' => array( $this->callbacks, 'sbwpAdminSection' ),
				'page' => 'sendinblue-wp-plugin'
			)
		);
		$this->settings->setSections( $args );
	}
	
	public function setFields(){
		$args = array(
			array(
				'id' => 'sbwp_api_key',
				'title' => 'API Key',
				'callback' => array( $this->callbacks, 'sbwpApiKeySet' ),
				'page' => 'sendinblue-wp-plugin',
				'section' => 'sbwp_admin_index',
				'args' => array(
					'label_for' => 'sbwp_api_key',
					'class' => 'example-class'
				)
			)
		);
		$this->settings->setFields( $args );
	}
}