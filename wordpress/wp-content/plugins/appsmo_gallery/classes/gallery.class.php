<?php
require_once   WP_PLUGIN_DIR.'/appsmo_gallery/classes/services.class.php';
class Gallery{
    private $service;
    public function __construct(){
        $this->service = (new Services);
    }

    public function unsplash() : string {
        return "";
    }

    private function shutterstock($key, $number, $category=null) : string {
        return "";
    }


    private function gettyImages($key, $number, $category=null):string{
        return "";
    }

    private function downLoadImages(){
        
    }
}