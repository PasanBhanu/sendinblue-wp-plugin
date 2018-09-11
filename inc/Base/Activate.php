<?php

    /**
    * @package SendinBlueWPPlugin
    */

namespace Inc\Base;

 class Activate
 {
	public static function activateplugin()
	{
		flush_rewrite_rules();
	}

 }