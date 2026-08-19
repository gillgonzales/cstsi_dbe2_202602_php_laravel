<?php

namespace CSTSI\Dbe2\controllers;

use CSTSI\Dbe2\models\ProdutoModel;
use Exception;

class ProdutoController extends Controller{

    public function __construct(){
        try{
            $this->model = new ProdutoModel();
        }catch(Exception $error){
            throw $error;
        }
    }

    public function index(){
        // echo "<br>Listar Produtos<pre>";
        // // print_r($this->model->read());
        // header("Content-Type:application/json");
        // header("Access-Control-Allow-Origin:*");//CORS
        //MVC -> Model
        echo json_encode($this->model->read());
        //MVC -> View
    }

    public function show(int $id){
         echo "<br>Mostrar os dados do produto de id:$id";
         echo "<pre>";
         try{
            print_r($this->model->read($id));
         }catch(Exception $error){
            echo "Produto de id $id não encontrado";
         } 
    }

    public function create(){
        echo "Mostrar um formulário";
    }

    public function store(){
        echo "Recebe os dados do formulário e guarda no banco";
    }

    public function edit(int $id){
        echo "Mostrar o formulário de edição com os dados do produto de ID: $id!!";
    }

    public function update(int $id){
        echo "Recebe dados e atualiza no banco o produto de ID: $id";
    }

    public function delete(int $id){
        echo "Mostrar um formulário de remoção com os dados do produto de ID:$id";
    }

    public function remove(){
        echo "Receber a comnfirmação de remoção e remover do banco";
    }
    
}