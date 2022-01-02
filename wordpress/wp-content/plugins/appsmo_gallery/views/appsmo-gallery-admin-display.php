
<div class="wrap">
<h1>General Settings</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'appsmo-gallery-settings-group' ); ?>
    <?php do_settings_sections( 'appsmo-gallery-settings-group' ); ?>
    <?php 
            $gallery_path = wp_get_upload_dir()['path'];
    ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo __("Image Path", $this->plugin_title); ?> </th>
        <td><input type="text" id="appsmo-gallery-image-path" name="appsmo_gallery_url_path" readonly value="<?php echo 
 esc_attr($gallery_path); ?>"/></td>
        </tr> 

        <tr valign="top">
        <th scope="row"><?php echo __("Image count", $this->plugin_title); ?></th>
        <td><input type="number" id="image_count" name="appsmo_gallery_count" value="<?php echo esc_attr( get_option('appsmo_gallery_count') ); ?>" /></td>
        </tr>

        <?php $options = get_option( 'appsmo_gallery_image_type_dropdown_settings' ); ?>
		
        <tr valign="top" id="appsmo-gallery-image-type-category">
        <th scope="row"><?php echo __("Store Image as ", $this->plugin_title); ?></th>
        <td>
			<select name='appsmo_gallery_image_type_dropdown_settings[select_field_0]'>
				<option value='jpeg' <?php  selected( $options['select_field_0'], 'jpeg'); ?>><?php echo __("JPEG", $this->plugin_title); ?></option>
				<option value='png' <?php  selected( $options['select_field_0'], 'png'); ?>><?php echo __("PNG", $this->plugin_title); ?></option>
			</select>
		</td>
        </tr>


        <tr valign="top" id="appsmo-gallery-store-photo">
        <th scope="row"><?php echo __("Store Photos", $this->plugin_title); ?></th>
        <td>
            <input name="appsmo_gallery_store_photo" class="appsmo-gallery-store-photo" type="checkbox" value="1" <?php checked( '1', get_option( 'appsmo_gallery_store_photo' ) ); ?> />
        </td>
        </tr>

        <tr valign="top" id="appsmo-gallery-overwrite-photo">
        <th scope="row"><?php echo __("Overwrite existing photos", $this->plugin_title); ?></th>
        <td>
            <input name="appsmo_gallery_overwrite_photo" type="checkbox" value="1" <?php checked( '1', get_option( 'appsmo_gallery_overwrite_photo' ) ); ?> />
        </td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
