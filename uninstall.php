<?php
    /**
    * @package SendinBlueWPPlugin
    */

    if(! defined('WP_UNINSTALL_PLUGIN')){
    	die;
    }

    $users = get_posts(array('post_type' => 'trackusers', 'numberposts' => -1));

    foreach ($user as $users) {
    	wp_delete_post($uesr->ID,true);
    }