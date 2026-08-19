<?php


namespace CSTSI\Dbe2\models;

use CSTSI\Dbe2\database\Connection;
use Exception;
use PDO;
use PDOStatement;

abstract class Model
{

    protected PDO $conn;
    protected const FETCH = PDO::FETCH_ASSOC;

    protected string $table;
    protected string $primaryKey;
    protected array $columns;
    protected array $values;
    protected PDOStatement $prepStmt;

    protected abstract function setColumns(): array;

    protected function __construct()
    {
        try {
            $this->conn = Connection::getInstance();
            $this->setColumns();
        } catch (Exception $error) {
            error_log("ERRO NA MODEL");
            throw $error;
        }
    }

    protected function dumpQuery(PDOStatement $prepStatement)
    {
        ob_start();
        $prepStatement->debugDumpParams();
        error_log(ob_get_contents());
        ob_end_clean();
    }

    protected function setValues(object $object)
    {
        $this->values = [];
        foreach ($this->columns as $column)
            $this->values[":$column"] = $object->$column;
    }

     protected function selectById(int $id): array{
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :id";
        $prepStmt = $this->conn->prepare($sql);
        $prepStmt->execute([':id'=>$id]);
        $result = $prepStmt->fetchAll(self::FETCH);
        if(!$result) 
            throw new Exception("Registro não encontrado no banco!");
        return $result[0];
    }

    protected function selectAll(): array{
        $sql = "SELECT * FROM $this->table";
        $prepStmt = $this->conn->prepare($sql);
        $prepStmt->execute();        
        return $prepStmt->fetchAll(self::FETCH);
    }

    protected function insert(): bool
    {
        $sql = "INSERT INTO $this->table (" . implode(',', $this->columns) . ") "
            . "VALUES (:" . implode(',:', $this->columns) . ")";

        $this->prepStmt = $this->conn->prepare($sql);
        $result = $this->prepStmt->execute($this->values);
        return $result || $this->prepStmt->rowCount() >= 1;
    }

    protected function updates(): bool
    {
        $updatedColumns = [];
        foreach ($this->columns as  $column) $updatedColumns[] = "$column = :$column ";

        $sql = "UPDATE $this->table SET ".implode(', ',$updatedColumns).
                  "WHERE $this->primaryKey = :id";

        $this->prepStmt = $this->conn->prepare($sql);
        if($this->prepStmt->execute($this->values))
                return $this->prepStmt->rowCount() > 0;
        return false;
    }

    protected function destroy(): bool {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :id";
        $this->prepStmt = $this->conn->prepare($sql);
        if ($this->prepStmt->execute($this->values))
            return $this->prepStmt->rowCount() > 0;
        else throw new Exception("Erro ao deletar na tabela $this->table");
    }
}
