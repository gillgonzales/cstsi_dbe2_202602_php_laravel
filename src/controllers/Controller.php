<?php

namespace CSTSI\Dbe2\controllers;

use CSTSI\Dbe2\interfaces\iDAO;
use CSTSI\Dbe2\models\Model;

abstract class Controller {

    protected iDAO | Model $model;
    //protected View $view;

    public abstract function index();

    // public static function ola(){
    //     echo "Olá Mundo!!!";
    // }

}