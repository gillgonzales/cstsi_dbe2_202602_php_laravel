<?php

namespace CSTSI\Dbe2\controllers;

use CSTSI\Dbe2\views\View;
use CSTSI\Dbe2\interfaces\iDAO;
use CSTSI\Dbe2\models\Model;

abstract class Controller {

    protected iDAO | Model $model;
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public abstract function index();

    // public static function ola(){
    //     echo "Olá Mundo!!!";
    // }

}