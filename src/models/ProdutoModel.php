<?php

namespace CSTSI\Dbe2\models;

use CSTSI\Dbe2\interfaces\iDAO;
use Exception;

class ProdutoModel extends Model implements iDAO
{
    public function __construct()
    {
        try {
            parent::__construct(); //super (Model)
            $this->table = 'produtos';
            $this->primaryKey = 'id_prod';
        } catch (Exception $error) {
            throw $error;
        }
    }

    public function create(object $produto): bool
    {
        try {
            $this->setValues($produto);
            $this->values[":importado"] = $produto->importado ? 1 : 0;
            if (!$this->insert())
                throw new Exception("Erro ao inserir em $this->table!!");
            return true;
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error->getMessage(), TRUE));
            $this->prepStmt ?? $this->dumpQuery($this->prepStmt);
            var_dump($error);
            var_dump($this->prepStmt);
            return false;
        } finally {
            $this->dumpQuery($this->prepStmt);
        }
    }

    public function read(int | null $id = null): array | bool
    {
        try {
            if (!$id)  $result  = $this->selectAll();
            else  $result  = $this->selectById($id);
            return $result;
        } catch (Exception $error) {
            throw $error;
        }
    }

    public function update(object $produto): bool
    {
        try {
            $this->setValues($produto);
            $this->values[":importado"] = $produto->importado ? 1 : 0;
            $this->values[":id"] = $produto->id_prod;
            if (!$this->updates())
                throw new Exception("Erro ao atualizar em $this->table!!");
            return true;
        } catch (\Exception $error) {
            echo "<pre>";
            error_log("ERRO: " . print_r($error->getMessage(), TRUE));
            $this->prepStmt ?? $this->dumpQuery($this->prepStmt);
            var_dump($error);
            var_dump($this->prepStmt);
            return false;
        } finally {
            $this->dumpQuery($this->prepStmt);
        }
    }
    public function delete(int $id): bool
    {
        try {
            $this->values[":id"] = $id;
            if (!$this->destroy())
                throw new Exception("Erro ao remover em $this->table!!");
            return true;
        } catch (\Exception $error) {
            echo "<pre>";
            error_log("ERRO: " . print_r($error->getMessage(), TRUE));
            $this->prepStmt ?? $this->dumpQuery($this->prepStmt);
            var_dump($error);
            var_dump($this->prepStmt);
            return false;
        } finally {
            $this->dumpQuery($this->prepStmt);
        }
    }

    protected function setColumns(): array
    {
        return $this->columns = [
            'nome',
            'descricao',
            'qtd_estoque',
            'preco',
            'importado'
        ];
    }
}
