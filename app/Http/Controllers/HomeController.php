<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    function index() {
        echo "Olá Mundo !!!";
        // dd($this);
    }

}
