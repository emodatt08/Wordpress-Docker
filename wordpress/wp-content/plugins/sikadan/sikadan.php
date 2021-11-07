<?php
/**
 * Plugin Name:       Sikadan Home Plugin
 * Plugin URI:        https://sikadan.com/
 * Description:       Administration of Sikadan website .
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sadat Hillary Kollan
 * Author URI:        http://appsmo.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sikadan-admin-plugin
 * Domain Path:       /languages
 */

  //Exit if accessed directly
  if(!defined('ABSPATH')){
    exit;
}


 //Load js and css scripts
 require_once(plugin_dir_path(__FILE__).'/includes/sikadan-scripts.php');
 //load shortcode
 //require_once(plugin_dir_path(__FILE__).'/includes/sikadan-shortcode.php');
//import models
require_once(plugin_dir_path(__FILE__).'/includes/sikadan-model.php');
require_once(plugin_dir_path(__FILE__).'/includes/sikadan-admin.php');




