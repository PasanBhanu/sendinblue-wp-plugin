<?php
    /**
    * @package SendinBlueWPPlugin
    */

    /*
    Plugin Name: SendinBlue Tracker Plugin
    Plugin URI: https://www.softinklab.com
    Description: Track your customers behaviours on the website for SendinBlue Automation
    Version: 1.0.0
    Author: Softink Lab
    Author URI: https://www.softinklab.com
    Licence: GPLv2 or later
    Text Domain: sendinblue-wp-plugin
    */


    /*
    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

    Copyright 2005-2015 Automattic, Inc.
    */

    // Security Enhancement
    if (!defined('ABSPATH')){
        die;
    }

    defined ('ABSPATH') or die();

    if (!function_exists('add_action')){
        die();
    }

    // Plugin Start
    if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')){
        require_once dirname(__FILE__) . '/vendor/autoload.php';
    }

    // Procedural Activation
    function activate_sbwp_plugin(){
        Inc\Base\Activate::activate();
    }
    register_activation_hook( __FILE__, 'activate_sbwp_plugin' );

    function deactivate_sbwp_plugin(){
        Inc\Base\Deactivate::deactivate();
    }
    register_deactivation_hook( __FILE__, 'deactivate_sbwp_plugin' );

    // Register Services
    if (class_exists('Inc\\Init')){
        Inc\Init::register_services();
    }