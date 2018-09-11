<?php

  /**
    * @package SendinBlueWPPlugin
    */

namespace Inc;

    final class init
    {

    	public static function get_services()
        {
    		return [
    		Pages\AdminPage::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class
    		];

    	}


    	public static function register_services()
        {
		foreach (self::get_services() as $class) 
            {
			$service = self :: instantiate($class);
			if(method_exists($service, 'register'))
            {
				$service->register();
			}
		  }
    		
    	}

    	private static function instantiate($class)
        {
    		$service = new $class();
    		return $service;
    	}
    }


// use inc\Activate;
// use inc\Deactivate;
// use inc\Admin\adminpages;

// class SendinbluePlugin
// {

// public $pluginname;

// function __contruct(){
//     $this -> pluginname =  plugin_basename(__FILE__);
// }

//     function register(){
//         add_action( 'admin_enqueue_scripts',array($this,'enqueue') );

//        

//      echo $this->pluginname;
//      //   add_filter( "plugin_action_links_$this->pluginname",array($this,'settings_link') );
//     }

// function settings_link($links){
// $settings_link = '<a href="options-general.php?page=softinklab_dashboard">Settings</a>';
// array_push($links, $settings_link);
// return $links;
// }

//     function create_post_type(){
//         add_action( 'init', array($this,'custom_post_type') );
//     }

// 


// function custom_post_type(){
//     register_post_type( 'trackusers', ['public' => true, 'label'=>'Track Users']);
// }

// function enqueue(){
//     wp_enqueue_style( 'pluginstyle', plugins_url('/assets/mystyle.css',__FILE__));
//     wp_enqueue_script( 'pluginscript', plugins_url('/assets/myscript.js',__FILE__));
// }

// function activate(){
//   //  require_once plugin_dir_path( __FILE__ ).'inc/activate.php';
//     activate::activateplugin();
// }
// }


// if(class_exists('SendinbluePlugin')){

//     $plugin = new SendinbluePlugin();
//     $plugin -> register();
// }

// require_once plugin_dir_path( __FILE__ ).'inc/Activate.php';
// register_activation_hook( __FILE__, array('activate','activateplugin') );
// require_once plugin_dir_path( __FILE__ ).'inc/Deactivate.php';
// register_deactivation_hook( __FILE__, array('deactivate','deactivateplugin') );