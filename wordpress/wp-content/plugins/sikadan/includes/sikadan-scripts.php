<?php
//if admin add scripts
if(is_admin()){
    function sikadan_admin_add_scripts(){
            wp_enqueue_script('sikadan_admin-main-script', plugins_url().'/sikadan/js/scripts.js', array('jquery'));
            wp_enqueue_style('sikadan_admin-main-style', plugins_url().'/sikadan/css/adminstyles.css');
        }
        add_action('admin_init','sikadan_admin_add_scripts');
    }
    
    //Add scripts
    function sikadan_add_scripts(){
        wp_enqueue_script('sikadan_main-script', plugins_url().'/sikadan/js/scripts.js', array('jquery'));
        wp_enqueue_style('sikadan_main-style', plugins_url().'/sikadan/css/style.css');
    }
    add_action('wp_enqueue_scripts','sikadan_add_scripts');