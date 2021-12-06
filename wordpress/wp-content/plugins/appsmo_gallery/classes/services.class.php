<?php

class Services{
    /**
     * Get Photos Based on Service
     *
     * @param [type] $service
     * @return void
     */
    public function getPhotos($service){
     return $this->getServicePhotoData($service);
    }

    /**
     * Get Service's Photos
     *
     * @param [type] $service
     * @return void
     */
    private function getServicePhotoData($service){
        $response = "";
        switch($service){
            case"unsplash":
                $headers = array(
                    'Authorization: Client-ID '.get_option("appsmo_unsplash_gallery_api_key")
                  );
            
                  $params = "";
                  $url = get_option("appsmo_gallery_unsplash_base_url").'photos';
                  $makeCall = $this->curlCall($url, $headers, $params);
                  print_r($makeCall); die;
                  return $makeCall;
            break;

        }
        return $response;
    }

    /**
     * Make Curl Call to Service API
     *
     * @param [type] $url
     * @param [type] $headers
     * @param [type] $params
     * @return void
     */
    private function curlCall($url, $headers, $params){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url."?".http_build_query($params),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }



    
}