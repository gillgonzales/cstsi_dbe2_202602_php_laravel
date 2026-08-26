<?php

use CSTSI\Dbe2\controllers\ProdutoController;
use CSTSI\Dbe2\controllers\api\ProdutoController as ApiProdutoController;

$routes = [
    'produtos'=> ProdutoController::class,
    'api/produtos'=> ApiProdutoController::class
];