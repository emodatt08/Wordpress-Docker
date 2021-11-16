
<div class="wrap">
<h1>Unsplash</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'appsmo-gallery-unsplash-settings-group' ); ?>
    <?php do_settings_sections( 'appsmo-gallery-unsplash-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo __("Access Key", $this->plugin_title); ?></th>
        <td><input type="text" id="appsmo-unsplash-id" name="appsmo_unsplash_gallery_api_key" value="<?php echo esc_attr( get_option('appsmo_unsplash_gallery_api_key') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row"><?php echo __("Secret Key", $this->plugin_title); ?></th>
        <td><input type="text" id="appsmo-unsplash-id" name="appsmo_unsplash_gallery_secret_key" value="<?php echo esc_attr( get_option('appsmo_unsplash_gallery_secret_key') ); ?>" /></td>
        </tr>

        <?php $options = get_option( 'appsmo_gallery_category_dropdown_settings' ); ?>
		<tr valign="top">
        <th scope="row">All categories</th>
        <td>
			<select name='dropdown_settings[select_field_0]'>
				<option value='animals' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 1 ); ?>><?php echo __("Animals", $this->plugin_title); ?></option>
				<option value='fashion' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 2 ); ?>><?php echo __("Fashion", $this->plugin_title); ?></option>
				<option value='film' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 4 ); ?>><?php echo __("Film", $this->plugin_title); ?> </option>
				<option value='people' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 5 ); ?>><?php echo __("People", $this->plugin_title); ?> </option>
				<option value='health' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 6 ); ?>><?php echo __("Health & Wellness", $this->plugin_title); ?></option>
				<option value='travel' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 7 ); ?>><?php echo __("Travel", $this->plugin_title); ?></option>
				<option value='nature' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 8 ); ?>><?php echo __("Nature", $this->plugin_title); ?></option>
				<option value='architecture' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 9 ); ?>><?php echo __("Architecture", $this->plugin_title); ?></option>
				<option value='foodanddrink' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 10 ); ?>><?php echo __("Food & Drink", $this->plugin_title); ?></option>
			</select>
		</td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>
</div>