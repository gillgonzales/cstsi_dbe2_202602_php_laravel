<?php

namespace CSTSI\Dbe2\controllers\api;

use CSTSI\Dbe2\controllers\Controller as BaseController;

abstract class Controller extends BaseController {

    public function __construct()
    {
        header("Content-Type:application/json");
        header("Access-Control-Allow-Origin:*");//CORS 
    }
}