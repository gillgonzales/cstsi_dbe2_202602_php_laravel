<?php

namespace CSTSI\Dbe2\database;

use Exception;
use PDO;
use stdClass;

class Connection
{
    private static PDO $instance;
    private static stdClass $db;

    public static function getInstance(): PDO
    {
        if (!isset(self::$instance)) {
            try {
                self::readEnv();
                $dsn = self::getDsn();
                self::$instance = new PDO($dsn, self::$db->user, self::$db->pass);
                // if(!Connection::isTablesInstalled()){
                //     self::installDB();
                // }
            } catch (\PDOException $error) {
                // var_dump(
                //     "CONNECTION",
                //     [
                //         $error->getMessage(),
                //         $error->getTraceAsString()
                //     ]
                // );
                throw new Exception($error->getMessage());
            }
        }
        return self::$instance;
    }

    private static function readEnv(): void
    {
        $db = new stdClass();
        $db->host = $_ENV['DB_HOST'];
        $db->drive = $_ENV['DB_DRIVE'];
        $db->name = $_ENV['DB_NAME'];
        $db->port = $_ENV['DB_PORT'] ?? '';
        $db->user = $_ENV['DB_USER'];
        $db->pass = $_ENV['DB_PASS'];
        $db->charset = isset($_ENV['DB_CHARSET']) ? $_ENV['DB_CHARSET'] : 'UTF8';
        self::$db = $db;
        if (!self::$db) {
            throw new Exception("Erro ao ler arquivo de configuração!");
        }
    }

    private static function getDsn(): string
    {
        switch (self::$db->drive) {
            case 'mysql':
            case 'mariadb':
                $dsn = "mysql:host=" . self::$db->host . ";"
                    . "dbname=" . self::$db->name . ";"
                    . "charset=" . self::$db->charset;
                $port = self::$db->port ?? 3306;
                $dsn .= ";port=$port";
                break;
            case 'pgsql':
                $dsn = "pgsql:host=" . self::$db->host . ";"
                    . "dbname=" . self::$db->name . ";";
                $port = self::$db->port ?? 5432;
                $dsn .= ";port=$port";
                break;
            default:
                throw new Exception("Driver " . self::$db->drive . " não suportado!");
        }
        return $dsn;
    }

    public static function getDrive(): string
    {
        return self::$db->drive;
    }

    public static function isTablesInstalled() :bool {
        if(self::$db->drive=='pgsql'){
            $sql = "SELECT produtos FROM pg_catalog.pg_tables WHERE schemaname = 'public'";
            $stmt = self::$instance->query($sql);
            $tabelas = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return !empty($tabelas);
        }else{
            $stmt = self::$instance->query("SHOW TABLES");
            $tabelas = $stmt->fetchAll(PDO::FETCH_COLUMN);
           return count($tabelas) > 0;
        }
    }

    private static function installDB() {
        try{
            $dumpFile = self::$db->drive=='pgsql'?'pgsql_apiprod.sql':'mysql_apiprod.sql';
            $scriptSQL = __DIR__."/dumps/$dumpFile";
            $script = fopen($scriptSQL, "r+");
            if (!$script)throw new Exception("Erro ao ler arquivo de dump.");
            $sql = fread($script, filesize($scriptSQL));
            fclose($script);
            $sqlArray = explode(';', $sql);
            foreach ($sqlArray as $stmt)
                if (strlen($stmt) > 3) {
                    $result = self::$instance->query($stmt);
                    if (!$result) throw new Exception("Erro ao restaurar o dump do banco.");
                }
           var_dump("Banco de Dados Instalado!");
        }catch(Exception $error){
            var_dump($error);
        }
    }
}
