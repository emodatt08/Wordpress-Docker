<?php
require_once   WP_PLUGIN_DIR.'/appsmo_gallery/classes/services.class.php';
class Gallery{
    private $service;
    public function __construct(){
        $this->service = (new Services);
    }

    public function getService($service) {
        $unsplash = $this->service->getPhotos($service);
        return $unsplash;
    }

    public function downLoadImages($url){
        $unsplash = $this->service->downloadAndStore($url);
        return $unsplash;
    }
}

