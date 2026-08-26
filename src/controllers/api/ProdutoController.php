<?php

namespace CSTSI\Dbe2\controllers\api;

use CSTSI\Dbe2\models\Produto;
use CSTSI\Dbe2\models\ProdutoModel;
use Exception;

class ProdutoController extends Controller{

    public function __construct(){
        try{
            parent::__construct();
            $this->model = new ProdutoModel();
        }catch(Exception $error){
            throw $error;
        }
    }

    public function index(){
        echo json_encode($this->model->read());
    }

    public function show(int $id){
         try{
             echo json_encode($this->model->read($id));
         }catch(Exception $error){
            header('HTTP/1.0 404');
            echo json_encode(["message"=>"Produto não encontrado!"]);
         } 
    }


    public function store(){
        $produto = new Produto( null,
            $_POST['nome'],
            $_POST['descricao'],
            $_POST['qtd_estoque'],
            $_POST['preco'],
        );
        if($this->model->create($produto)){
            header('HTTP/1.0 204');
            echo json_encode(['data'=>(array)$produto]);
        }else {
            header('HTTP/1.0 404');
            echo json_encode(["message"=>"Erro ao criar produto!!!"]);
        }
    }

    public function update(int $id){
        echo "Recebe dados e atualiza no banco o produto de ID: $id";
    }

    public function remove(int $id){
        echo "Receber a comnfirmação de remoção e remover do banco";
    }
    
}