<?php

namespace CSTSI\Dbe2\controllers;

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
        $produtos = $this->model->read();
        $this->view->load('produtos/index',['produtos'=>$produtos]);
    }

    public function show(int $id){
        //  echo "<br>Mostrar os dados do produto de id:$id";
        //  echo "<pre>";
         try{
             $this->view->load('produtos/show',['produto'=>$this->model->read($id)]);
         }catch(Exception $error){
            echo "Produto de id $id não encontrado";
         } 
    }

    public function create(){
        // echo "Mostrar um formulário";
         $this->view->load('produtos/create');
    }

    public function store(){
        $produto = new Produto( null,
            $_POST['nome'],
            $_POST['descricao'],
            $_POST['qtd_estoque'],
            $_POST['preco'],
        );
        // echo $produto->nome."<pre>";
        // var_dump($produto);die;
        
        if(isset($_POST['importado']))
            $produto->setImportado(true);

        if($this->model->create($produto))
            header('Location:/produtos');
        else echo "Erro ao criar produto!!!";
    }

    public function edit(int $id){
        // echo "Mostrar o formulário de edição com os dados do produto de ID: $id!!";
         try{
             $produto = $this->model->read($id);
             $this->view->load('produtos/edit',['produto'=>$produto]);
         }catch(Exception $error){
            echo "Produto de id $id não encontrado";
         } 
    }

    public function update(int $id){
        $produto = new Produto( $id,
            $_POST['nome'],
            $_POST['descricao'],
            $_POST['qtd_estoque'],
            $_POST['preco'],
        );
        
        if(isset($_POST['importado']))
            $produto->setImportado(true);
        
        if($this->model->update($produto))
            header('Location:/produtos');
        else echo "Erro ao atualizar o produto!!!";

    }

    public function delete(int $id){
        echo "Mostrar um formulário de remoção com os dados do produto de ID:$id";
    }

    public function remove(){
        echo "Receber a comnfirmação de remoção e remover do banco";
    }
    
}