<?php

/**
 * Provides an admin area view for the AppsMo Gallery Plugin
 *
 * This file is used to markup the admin-facing aspects of the AppsMo Gallery Plugin.
 *
 * @link       appsmo.com/team
 * @since      1.0.0
 *
 * @package    appsmo_gallery
 * @subpackage appsmo_gallery/classes/views
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
		        <div id="icon-themes" class="icon32"></div>  
		        <h2>General Settings</h2>  
		         <!--NEED THE settings_errors below so that the errors/success messages are shown after submission - wasn't working once we started using add_menu_page and stopped using add_options_page so needed this-->
				<?php settings_errors(); ?>  
		        <form method="POST" action="options.php">  
		            <?php 
		                settings_fields( 'appsmo_gallery_general_settings' );
		                do_settings_sections( 'appsmo_gallery_general_settings' ); 
		            ?>             
					<p class="submit">
						<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
						<input type="button" id="pull-image" name="pull" class="button button-primary" value="Pull Images">
				   </p>
		        </form> 
</div>