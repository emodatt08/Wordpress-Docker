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
        add_action('admin_init', array( $this, 'registerAndBuildGalleryFields' ));  
    }


    public function addGalleryPluginAdminMenu() : void{
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_menu_page(  $this->plugin_name, $this->plugin_menu_title , 'administrator', $this->plugin_name, array( $this, 'displayAppsMoGalleryPluginAdminDashboard' ), plugins_url() . '/appsmo_gallery/img/logo.png', 10 );
        
        //add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
        add_submenu_page( $this->plugin_name, 'Core Settings', 'Unsplash', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayAppsMoGalleryPluginAdminSettings' ));
        add_submenu_page( $this->plugin_name, 'Core Settings', 'Getty Images', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayAppsMoGalleryPluginAdminSettings' ));
        add_submenu_page( $this->plugin_name, 'Core Settings', 'Shutterstock', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayAppsMoGalleryPluginAdminSettings' ));
    }

    public function displayAppsMoGalleryPluginAdminDashboard() : void {
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
        ?>
        <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <nav class="nav-tab-wrapper">
            <a href="?page=<?php echo $this->plugin_name; ?>" class="nav-tab <?php if($active_tab===null):?>nav-tab-active<?php endif; ?>">General</a>
            <a href="?page=<?php echo $this->plugin_name; ?>&tab=unsplash" class="nav-tab <?php if($active_tab==='unsplash'):?>nav-tab-active<?php endif; ?>">Unsplash</a>
            <a href="?page=<?php echo $this->plugin_name; ?>&tab=getty" class="nav-tab <?php if($active_tab==='getty'):?>nav-tab-active<?php endif; ?>">Getty Images</a>
            <a href="?page=<?php echo $this->plugin_name; ?>&tab=shutter" class="nav-tab <?php if($active_tab==='shutter'):?>nav-tab-active<?php endif; ?>">ShutterStock</a>
          
        </nav>
    
        <div class="tab-content">
        <?php switch($active_tab) :
            case 'unsplash':
                echo 'Unsplash'; 
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


  public function appsMoGalleryPluginNameSettingsMessages($error_message) : void {
        switch ($error_message) {
            case '1':
                $message = __( 'There was an error adding AppsMo Gallery setting. Please try again.  If this persists, shoot us an email.', 'appsmo-gallery' );                 
                $err_code = esc_attr( $this->plugin_menu_title );                 
                $setting_field = $this->plugin_menu_title;                 
                break;
        }
        $type = 'error';
        add_settings_error(
            $setting_field,
            $err_code,
            $message,
            $type
        );
    }

public function registerAndBuildGalleryFields() : void {
        /**
       * First, we add_settings_section. This is necessary since all future settings must belong to one.
       * Second, add_settings_field
       * Third, register_setting
       */     
        add_settings_section(
            // ID used to identify this section and with which to register options
            $this->plugin_title.'_general_section', 
            // Title to be displayed on the administration page
            '',  
            // Callback used to render the description of the section
            array( $this,  $this->plugin_title.'_display_general_account' ),    
            // Page on which to add this section of options
            $this->plugin_title.'_general_settings'                   
        );
        unset($args);
        $args = array (
                    'type'      => 'input',
                    'subtype'   => 'text',
                    'id'    =>  $this->plugin_title.'_setting',
                    'name'      =>  $this->plugin_title.'_setting',
                    'required' => 'true',
                    'get_options_list' => '',
                    'value_type'=>'normal',
                    'wp_data' => 'option'
                );
        add_settings_field(
            $this->plugin_title.'_setting',
            'Unsplash key',
            array( $this,  $this->plugin_title.'_render_settings_field' ),
            $this->plugin_title.'_general_settings',
            $this->plugin_title.'_general_section',
            $args
        );


        register_setting(
            $this->plugin_title.'_general_settings',
            $this->plugin_title.'_example_setting'
                );

}
    
public function appsmo_gallery_display_general_account() : void {
        echo '<p>These settings apply to all AppsMo Gallery functionality.</p>';
}



public function appsmo_gallery_render_settings_field($args) : void {
    /* EXAMPLE INPUT
              'type'      => 'input',
              'subtype'   => '',
              'id'    => $this->plugin_name.'_example_setting',
              'name'      => $this->plugin_name.'_example_setting',
              'required' => 'required="required"',
              'get_option_list' => "",
                'value_type' = serialized OR normal,
    'wp_data'=>(option or post_meta),
    'post_id' =>
    */     
        if($args['wp_data'] == 'option'){
            $wp_data_value = get_option($args['name']);
        } elseif($args['wp_data'] == 'post_meta'){
            $wp_data_value = get_post_meta($args['post_id'], $args['name'], true );
        }

        switch ($args['type']) {

        case 'input':
            $value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
            if($args['subtype'] != 'checkbox'){
                $prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.$args['prepend_value'].'</span>' : '';
                $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
                $step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
                $min = (isset($args['min'])) ? 'min="'.$args['min'].'"' : '';
                $max = (isset($args['max'])) ? 'max="'.$args['max'].'"' : '';
                if(isset($args['disabled'])){
                    // hide the actual input bc if it was just a disabled input the informaiton saved in the database would be wrong - bc it would pass empty values and wipe the actual information
                    echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'_disabled" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'_disabled" size="40" disabled value="' . esc_attr($value) . '" /><input type="hidden" id="'.$args['id'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
                } else {
                    echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
                }
                /*<input required="required" '.$disabled.' type="number" step="any" id="'.$this->plugin_name.'_cost2" name="'.$this->plugin_name.'_cost2" value="' . esc_attr( $cost ) . '" size="25" /><input type="hidden" id="'.$this->plugin_name.'_cost" step="any" name="'.$this->plugin_name.'_cost" value="' . esc_attr( $cost ) . '" />*/

            } else {
                $checked = ($value) ? 'checked' : '';
                echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
            }
            break;
        default:
            # code...
            break;
        }
}



}

$GalleryAdmin = (new GalleryAdmin);