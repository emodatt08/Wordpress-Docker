<?php


class Scripts{

    public function __construct(){
        add_action('wp_enqueue_scripts', array($this, 'ag_add_scripts'));
         //if admin add scripts
        if(is_admin()){
            add_action('admin_init',array($this, 'ag_admin_add_scripts'));
            add_action( 'admin_enqueue_scripts',array($this, 'appsmo_gallery_enqueue')  );
        }
    }

   
    public function appsmo_gallery_enqueue($hook) {
        if( 'index.php' != $hook ) {
        // Only applies to dashboard panel
        return;
        }
            
        wp_enqueue_script( 'appsmo-gallery-ajax-script', plugins_url( '/js/appsmo-gallery-ajax.js', __FILE__ ), array('jquery') );
    
        // in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
        wp_localize_script( 'appsmo-gallery-ajax-script', 'ajax_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );
    }

    public function ag_admin_add_scripts():void{
            wp_enqueue_script('ag-admin-main-script', plugins_url().'/appsmo_gallery/js/appsmo-gallery.js', array('jquery'), '', true);
            wp_enqueue_script('ag-admin-main-ajax-script', plugins_url().'/appsmo_gallery/js/appsmo-gallery-ajax.js','', '', true);
            wp_enqueue_script('ag-admin-ionicon-script', 'https://unpkg.com/ionicons@5.4.0/dist/ionicons.js');
            wp_enqueue_style('ag-admin-main-style', plugins_url().'/appsmo_gallery/css/styleAdmin.css');
    }
    

    public function ag_add_scripts():void{
        wp_enqueue_script('ag-main-script', plugins_url().'/appsmo_gallery/js/appsmo-gallery.js', array('jquery'), '', true);
        wp_enqueue_style('ag-main-style', plugins_url().'/appsmo_gallery/css/style.css');
    }
    

}

//bootstrap
$scripts = (new Scripts);