<?php

/**
 * Plugin Name: AppsMo Gallery
 * Description: Gets images from different service providers
 * Version: 1.5
 * Author: Sadat Hillary Kollan
 * Company: AppsMo Ventures
 */

 //Exit if accessed directly
 if(!defined('ABSPATH')){
     exit;
 }

  //Global options variable
  $ffl_options = get_option('ffl_settings');
  //Load Scripts
 require_once(plugin_dir_path(__DIR__).'/appsmo_gallery/classes/scripts.class.php');


 require_once(plugin_dir_path(__DIR__).'/appsmo_gallery/classes/gallery.class.php');

 if(is_admin()){
  //Load Admin
  require_once(plugin_dir_path(__DIR__).'/appsmo_gallery/classes/admin.class.php');
  //Load Admin Ajax
  require_once(plugin_dir_path(__DIR__).'/appsmo_gallery/ajax-gallery.php');
 }


 