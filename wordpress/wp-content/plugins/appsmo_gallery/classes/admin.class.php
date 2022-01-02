<?php

class GalleryAdmin{

    public $plugin_name;
    public $plugin_title;
    public $plugin_menu_title;

    public function __construct(){
        $this->plugin_menu_title = "Appsmo Gallery";
        $this->plugin_name = "AppsmoGallery";
        $this->plugin_title = "appsmo_gallery";
        add_action('admin_menu', array( $this, 'addGalleryPluginAdminMenu' ), 12);  
        //call register settings function
	    add_action( 'admin_init', array( $this, 'registerAppsmoGalleryPluginSettings' ) );

    }


    public function addGalleryPluginAdminMenu() : void{
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_menu_page(  $this->plugin_name, $this->plugin_menu_title , 'administrator', $this->plugin_name, array( $this, 'displayAppsMoGalleryPluginAdminDashboard' ), plugins_url() . '/appsmo_gallery/img/logo.png', 10 );
        //create new top-level menu
	    // add_menu_page($this->plugin_name, $this->plugin_menu_title, 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );
        //add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
        add_submenu_page( $this->plugin_name, 'Core Settings', 'Unsplash', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayAppsMoGalleryPluginAdminSettings' ));
        add_submenu_page( $this->plugin_name, 'Core Settings', 'Getty Images', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayAppsMoGalleryPluginAdminSettings' ));
        add_submenu_page( $this->plugin_name, 'Core Settings', 'Shutterstock', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayAppsMoGalleryPluginAdminSettings' ));
    }

    public function registerAppsmoGalleryPluginSettings() {
        //register our general settings
        register_setting( 'appsmo-gallery-settings-group', 'appsmo_gallery_url_path' );
        register_setting( 'appsmo-gallery-settings-group', 'appsmo_gallery_count' );
        register_setting( 'appsmo-gallery-settings-group', 'appsmo_gallery_overwrite_photo' );
        register_setting( 'appsmo-gallery-settings-group', 'appsmo_gallery_store_photo' );
        register_setting( 'appsmo-gallery-settings-group', 'appsmo_gallery_image_type_dropdown_settings' );
        //register our unsplash settings
        register_setting( 'appsmo-gallery-unsplash-settings-group', 'appsmo_unsplash_gallery_api_key' );
        register_setting( 'appsmo-gallery-unsplash-settings-group', 'appsmo_unsplash_gallery_secret_key' );
        register_setting( 'appsmo-gallery-unsplash-settings-group', 'appsmo_unsplash_gallery_categories' );
        register_setting( 'appsmo-gallery-unsplash-settings-group', 'appsmo_gallery_unsplash_base_url' );
      
        
        
    }
    
    public function displayAppsMoGalleryPluginAdminDashboard() : void {
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
        ?>
        <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <nav class="nav-tab-wrapper">
            <a href="?page=<?php echo $this->plugin_name; ?>" class="nav-tab <?php if($active_tab===null):?>nav-tab-active<?php endif; ?>"><?php echo __("General", $this->plugin_title); ?> </a>
            <a href="?page=<?php echo $this->plugin_name; ?>&tab=unsplash" class="nav-tab <?php if($active_tab==='unsplash'):?>nav-tab-active<?php endif; ?>"><?php echo __("Unsplash", $this->plugin_title); ?> </a>
            <a href="?page=<?php echo $this->plugin_name; ?>&tab=getty" class="nav-tab <?php if($active_tab==='getty'):?>nav-tab-active<?php endif; ?>"><?php echo __("Getty Images", $this->plugin_title); ?></a>
            <a href="?page=<?php echo $this->plugin_name; ?>&tab=shutter" class="nav-tab <?php if($active_tab==='shutter'):?>nav-tab-active<?php endif; ?>"><?php echo __("ShutterStock", $this->plugin_title); ?></a>
          
        </nav>
    
        <div class="tab-content">
        <?php switch($active_tab) :
            case 'unsplash':
                require_once   WP_PLUGIN_DIR.'/'.$this->plugin_title.'/views/appsmo-gallery-admin-unsplash.php';
            break;
            case 'getty':
                echo 'Getty';
            break;
            case 'shutter':
                echo 'Shutterstock';
            break;
            default:
                require_once   WP_PLUGIN_DIR.'/'.$this->plugin_title.'/views/appsmo-gallery-admin-display.php';
            break;
        endswitch; ?>
        </div>
        </div>
    <?php
		
  }

  public function displayAppsMoGalleryPluginAdminSettings() : void{
    // set this var to be used in the settings-display view
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
    if(isset($_GET['error_message'])){
        add_action('admin_notices', array($this,'appsMoGalleryPluginNameSettingsMessages'));
        do_action( 'admin_notices', $_GET['error_message'] );
    }
    require_once WP_PLUGIN_DIR.'/'.$this->plugin_title.'views/appsmo-gallery-admin-settings-display.php';
  }


}

$GalleryAdmin = (new GalleryAdmin);