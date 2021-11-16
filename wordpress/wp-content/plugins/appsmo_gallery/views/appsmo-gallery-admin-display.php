
<div class="wrap">
<h1>General Settings</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'appsmo-gallery-settings-group' ); ?>
    <?php do_settings_sections( 'appsmo-gallery-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo __("Add Category", $this->plugin_title); ?> </th>
        <td><input type="text" name="appsmo_gallery_category_dropdown_settings" /></td>
        </tr> 
        <tr valign="top">
        <th scope="row"><?php echo __("Image count", $this->plugin_title); ?></th>
        <td><input type="number" id="image_count" name="appsmo_gallery_count" value="<?php echo esc_attr( get_option('appsmo_gallery_count') ); ?>" /></td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
