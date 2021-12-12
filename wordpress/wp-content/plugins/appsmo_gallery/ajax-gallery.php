<?php 

add_action( 'admin_enqueue_scripts', 'appsmo_gallery_enqueue' );
function appsmo_gallery_enqueue($hook) {
    if( 'index.php' != $hook ) {
	// Only applies to dashboard panel
	return;
    }
        
	wp_enqueue_script( 'ajax-script', plugins_url( '/js/appsmo-gallery-ajax.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );
}

// Same handler function...
add_action( 'wp_ajax_my_action', 'appsmo_gallery_action' );
function appsmo_gallery_action() {
	$gallery = new Gallery();
	$service_type = intval( $_POST['service'] );
	$service = $gallery->getService($service_type);
        echo $service;
	wp_die();
}

 
?>