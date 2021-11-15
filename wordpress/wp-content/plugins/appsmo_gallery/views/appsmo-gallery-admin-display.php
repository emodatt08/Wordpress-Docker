
<div class="wrap">
<h1>General Settings</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'appsmo-gallery-settings-group' ); ?>
    <?php do_settings_sections( 'appsmo-gallery-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Add Category</th>
        <td><input type="text" name="appsmo_gallery_category_dropdown_settings" /></td>
        </tr>

		<?php $options = get_option( 'appsmo_gallery_category_dropdown_settings' ); ?>
		<tr valign="top">
        <th scope="row">All categories</th>
        <td>
			<select name='dropdown_settings[select_field_0]'>
				<option value='animals' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 1 ); ?>>Animals</option>
				<option value='fashion' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 2 ); ?>>Fashion</option>
				<option value='film' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 4 ); ?>>Film</option>
				<option value='people' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 5 ); ?>>People</option>
				<option value='health' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 6 ); ?>>Health & Wellness</option>
				<option value='travel' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 7 ); ?>>Travel</option>
				<option value='nature' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 8 ); ?>>Nature</option>
				<option value='architecture' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 9 ); ?>>Architecture</option>
				<option value='foodanddrink' <?php selected( $options['appsmo_gallery_category_dropdown_0'], 10 ); ?>>Food & Drink</option>
			</select>
		</td>
        </tr>
		

         
        <tr valign="top">
        <th scope="row">Image count</th>
        <td><input type="number" id="image_count" name="appsmo_gallery_count" value="<?php echo esc_attr( get_option('appsmo_gallery_count') ); ?>" /></td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
