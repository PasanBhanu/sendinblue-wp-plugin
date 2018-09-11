<?php

    /**
    * @package SendinBlueWPPlugin
    */

namespace Inc\Base;

 class Deactivate
 {
	public static function deactivateplugin()
	{
		flush_rewrite_rules();
	}

 }