<?php

// Classe base para os modelos, ou seja, classes para tratar a base de dados
abstract class Model  
{
    protected $dbh;
    protected $stmt;

    public function __construct() {
        // TODO
        $this->dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
    }
    
    // Prepara uma query para ser executada
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Função pronta para pegar dados de uma certa coleção, ou número selecionado de dados
    public function range($query, $start, $end)
    {
        $this->query($query);
        $this->bind(':START', $start);
        $this->bind(':END', $end);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function rollBack()
    {
        $this->dbh->rollBack();
    }
    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }
    public function commit()
    {
        $this->dbh->commit();
    }
    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

 
    public function singleResult()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCounte()
    {

        return $this->stmt->rowCount();
    
    }
}

