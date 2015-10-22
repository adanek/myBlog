<?php

class HttpService
{
    /**
     * Sends a Bad Request response to the client
     */
    static public function return_bad_request(){
        http_response_code(400);
        exit();
    }

    /**
     * Sends a Not Found Response to the client
     */
    static public function return_not_found(){
        http_response_code(404);
        exit();
    }
    
    /**
     * Sends a Service Unavailable Response to the client
     */
    static public function return_service_unavailable(){
    	http_response_code(503);
    	exit();
    }

    /**
     * Redirects the client to the given url
     * @param $url string the target of the redirection
     */
    static public function redirect_to($url) {

        header('Location: '.$url);
        exit();
    }
}
?>