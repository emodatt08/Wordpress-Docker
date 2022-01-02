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
   
        switch($service){
            case"unsplash":
                $headers = array(
                    'Authorization: Client-ID '.get_option("appsmo_unsplash_gallery_api_key")
                  );
            
                  $params = "";
                  $url = get_option("appsmo_gallery_unsplash_base_url").'photos';
                  $makeCall = $this->curlCall($url, $headers, $params);
                  $response = json_decode($makeCall);
                  if(isset($response[0]->id))
                    return $this->prepareResponse($service, $response);
                else
                    return $this->prepareResponse("", "");
            break;

        }
    }

    /**
     * Make Curl Call to Service API
     *
     * @param [type] $url
     * @param [type] $headers
     * @param [type] $params
     * @return string
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


    private function prepareResponse($service, $response):array{
        switch($service){
            case "unsplash":
                return [
                    'responseCode' => '200',
                    'responseMessage' => 'Successful',
                    'data' => $this->getPhotoDataSet('unsplash', $response)
                ];
            break;
            default:
            return [
                'responseCode' => '403',
                'responseMessage' => 'failure'
            ];
        }
    }

    private function prepareDownloadResponse($service, $response):array{
        switch($service){
            case "unsplash":
                return [
                    'responseCode' => '200',
                    'responseMessage' => 'Successful',
                    'data' => $response
                ];
            break;
            default:
            return [
                'responseCode' => '403',
                'responseMessage' => 'failure'
            ];
        }
    }


    private function getPhotoDataSet($service, $response){
        $photoData = [];
        switch($service){
            case 'unsplash':
                foreach($response as $data){
                    $photoData[] =    
                    [
                        'show' => $data->urls->regular,
                        'download' => $data->links->download,
                        'alt' => $data->description,
                        'id' => $data->id
                    ];
                }
            break;
        }

        return $photoData;
    }

    public function downloadAndStore($image_url){
        $download = "";
        if( ini_get('allow_url_fopen') ) {
            $download = $this->useFOpen($image_url);
         }else{
            $download = $this->useCurl($image_url);
         }
         return $download;
    }

    private function useFOpen($image_url){
        // Fetch all headers from URL
        $data = get_headers($image_url, true);
        $options  = array('http' => array('user_agent' =>  "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36"));
        $context  = stream_context_create($options);
       
        // Check if content encoding is set
        $content_encoding = isset($data['Content-Encoding']) ? $data['Content-Encoding'] : null;

        
        $dest_path= $this->getDestPath();

        // Set gzip decode flag
        $gzip_decode = ($content_encoding == 'gzip') ? true : false;
       
        //make directory
        mkdir('./'.$dest_path,0777,true);
        
        $dest_path = $dest_path.'/appsmo_gallery_'.date('YmdHis').'.'.$this->getExtension();
        
        if ($gzip_decode)
        {
            // Get contents and use gzdecode to "unzip" data
            $response =  file_put_contents($dest_path, gzdecode( file_get_contents($dest_path, false, $context)));
        }else{
            // Use copy method
            $response =  copy($image_url, $dest_path);
        }

        if(isset($response)){
            $response = ['response' => $response, 'url_path' => $dest_path];
            $response =  $this->prepareDownloadResponse("unsplash", $response);
        }else{
            $response = $this->prepareDownloadResponse("", "");
        }
            


        return $response;
    }
    

    private function useCurl($image_url){
        $dest_path = $this->getDestPath();
        $agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36";
 
        // Handle compression & redirection automatically
        $ch = curl_init($image_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        // Exclude header data
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // Follow redirected location
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // Auto detect decoding of the response | identity, deflate, & gzip
        curl_setopt($ch, CURLOPT_ENCODING, '');
        //set user agent
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        $response = curl_exec($ch);
        print_r('curl  method'); 
        mkdir('./'.$dest_path,0777,true);
        $dest_path = $dest_path.'/appsmo_gallery_'.date('YmdHis').'.'.$this->getExtension();
        $fp = fopen($dest_path,'w');
        fwrite($fp,  $response);
        fclose($fp);
        if(isset($response)){
            $response = ['response' => $response, 'url_path' => $dest_path];
            $response =  $this->prepareDownloadResponse("unsplash", $response);
        }else{
            $response = $this->prepareDownloadResponse("", "");
        }

        curl_close($ch);
        fclose($fp);

        return $response;
    }

    private function getDestPath(){
        $dest_path = wp_get_upload_dir()['path'];
    
        return $dest_path;
    }

    private function getExtension(){
        $extension = get_option('appsmo_gallery_image_type_dropdown_settings')['select_field_0'];
        return (!isset($extension)) ? $extension : 'jpeg';
    }


    private function getImageAttributes($imagename){
        $overwrite = get_option('appsmo_gallery_overwrite_photo');
        if($overwrite){
            $name = '/appsmo_gallery_'.$imagename.'.'.$this->getExtension();
        }else{
            $name = '/appsmo_gallery_'.date('YmdHis').'.'.$this->getExtension();
        }

        $attributes = ['name'=> $name];
        return $attributes;
    }

    private function fileExists($filename){

        if(file_exists(($filename))){
            return true;
        }else{
            return false;
        }
    }
   
}