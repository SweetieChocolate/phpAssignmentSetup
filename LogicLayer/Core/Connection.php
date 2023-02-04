<?php

require_once "DataModel.php";

class DBConnection
{
    public array $object;
    private string $servername;
    private string $username;
    private string $password;
    private string $database;
    private mixed $connection;

    public function ServerName() : string
    {
        return $this->servername;
    }
    public function DataBase(): string
    {
        return $this->database;
    }
    
    public function __construct()
    {
        $this->object = array();
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "test";
    }

    private function connect() : void
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error)
        {
            throw new Exception("Failed to connect to the database");
        }
    }

    private function disconnect() : void
    {
        if (isset($this->connection))
        {
            $this->connection->close();
        }
    }

    public function ExecuteQuery(string $query) : mixed
    {
        $this->connect();
        $result = $this->connection->query($query);
        $this->disconnect();
        if (!$result)
        {
            throw new Exception("Failed to execute the query");
        }
        return $result;
    }

    public function ExecuteMultipleQuery(string $query) : mixed
    {
        $this->connect();
        $result = $this->connection->multi_query($query);
        $this->disconnect();
        if (!$result)
        {
            throw new Exception("Failed to execute the query");
        }
        return $result;
    }
    
    public function commit() : bool
    {
        $sql = "";
        foreach ($this->object as $o)
        {
            $sql .= $o->GenerateRawInsertUpdateSql() . "\n";
            
            $dataModel = new ReflectionClass('DataModel');
            // IsLock property
            $isLock = $dataModel->getProperty('IsLock');
            $isLock->setAccessible(true); // only required prior to PHP 8.1.0
            $isLock->setValue($o, false);
            // IsNew property
            $isNew = $dataModel->getProperty('IsNew');
            $isNew->setAccessible(true); // only required prior to PHP 8.1.0
            $isNew->setValue($o, false);
        }
        // execute sql
        $this->ExecuteMultipleQuery($sql);
        $this->object = array();
        return true;
    }
}

?>