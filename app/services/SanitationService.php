<?php

class SanitationService
{
    static public function convertHtml($string){
        return htmlentities($string);
    }
}