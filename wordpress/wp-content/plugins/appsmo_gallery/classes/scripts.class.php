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
            wp_enqueue_script('ag-admin-main-script', plugins_url().'/appsmo_gallery/js/appsmo-gallery.js', array('jquery'), '', true);
            wp_enqueue_script('ag-admin-ionicon-script', 'https://unpkg.com/ionicons@5.4.0/dist/ionicons.js');
            wp_enqueue_style('ag-admin-download-button-font-awesome-script', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
            
            wp_enqueue_style('ag-admin-main-style', plugins_url().'/appsmo_gallery/css/styleAdmin.css');
            wp_enqueue_script( 'appsmo-gallery-ajax-script', plugins_url( '/appsmo_gallery/js/appsmo-gallery-ajax.js'), array('jquery') );
            // in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
            wp_localize_script( 'appsmo-gallery-ajax-script', 'ajax_object',
                    array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
    

    public function ag_add_scripts():void{
        wp_enqueue_script('ag-main-script', plugins_url().'/appsmo_gallery/js/appsmo-gallery.js', array('jquery'), '', true);
        wp_enqueue_style('ag-main-style', plugins_url().'/appsmo_gallery/css/style.css');
    }
    

}

//bootstrap
$scripts = (new Scripts);