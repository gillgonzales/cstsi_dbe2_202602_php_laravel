<?php

namespace CSTSI\Dbe2\views;

class View{

    public static function load(string $page , array | null $data =null) : void {
        $data && extract($data);//[$key=>$value]
        // var_dump(__DIR__);
        require_once __DIR__."/templates/$page.phtml";
    }

    public static function pageNotFound(){
       header('HTTP/1.0 404 Not Found');
    }
}