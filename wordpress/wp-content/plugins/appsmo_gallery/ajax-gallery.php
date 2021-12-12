<?php 



// Same handler function...
add_action( 'wp_ajax_appsmo_gallery_action', 'appsmo_gallery_action' );
add_action( "wp_ajax_nopriv_appsmo_gallery_action", "appsmo_gallery_action" );

function appsmo_gallery_action() {
	$gallery = new Gallery();
	$service_type = $_POST['service'];
	$service = $gallery->getService($service_type);
	header("Content-Type:application/json");
	echo json_encode($service);
	wp_die();
}

 
?>