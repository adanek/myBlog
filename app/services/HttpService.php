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
}