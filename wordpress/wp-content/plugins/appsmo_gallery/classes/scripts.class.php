<?php


class Scripts{

    public function __construct(){
        add_action('wp_enqueue_scripts', array($this, 'ag_add_scripts'));
         //if admin add scripts
        if(is_admin()){
            add_action('admin_init',array($this, 'ag_admin_add_scripts'));
        }
    }

   

    public function ag_admin_add_scripts():void{
            wp_enqueue_script('ag-admin-main-script', plugins_url().'appsmo_gallery/js/appsmo-gallery.js', array('jquery'), '', true);
            wp_enqueue_style('ag-admin-main-style', plugins_url().'appsmo_gallery/css/styleAdmin.css');
    }
    

    public function ag_add_scripts():void{
        wp_enqueue_script('ag-main-script', plugins_url().'appsmo_gallery/js/appsmo-gallery.js', array('jquery'), '', true);
        wp_enqueue_style('ag-main-style', plugins_url().'appsmo_gallery/css/style.css');
    }
    

}

//bootstrap
$scripts = (new Scripts);