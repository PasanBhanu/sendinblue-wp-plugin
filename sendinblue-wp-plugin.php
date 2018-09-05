<?php
    /**
    * @package SendinBlueWPPlugin
    */

    /*
    Plugin Name: Sending Blue Tracker Plugin
    Plugin URI: https://www.softinklab.com
    Description: SendinBlue empowers businesses to build and grow relationships with their customers.
    Version: 1.0.0
    Author: Softink Lab
    Author URI: https://www.softinklab.com
    Licence: GPLv2 or later
    Text Domain: sendinblue-wp-plugin
    */

    // Security Enhancement
    if (!defined('ABSPATH')){
        die;
    }

    defined ('ABSPATH') or die();

    if (!function_exists('add_action')){
        die();
    }
