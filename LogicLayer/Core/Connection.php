<?php

require_once "DataModel.php";

class Connection
{
    public array $object;
    private string $servername;
    private string $username;
    private string $password;
    private mixed $connection;
    
    public function __construct()
    {
        $this->object = array();
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
    }

    public function NewObjectID() : string
    {
        $query = "SELECT UUID() AS NEWID;";
        $this->connect();
        $result = $this->connection->query($query);
        $this->disconnect();
        if ($result->num_rows < 1)
        {
            throw new Exception("Failed to retrieve new ObjectID from the database");
        }
        while ($row = $result->fetch_assoc())
        {
            $newUUID = $row['NEWID'];
        }
        if (!isset($newUUID))
        {
            throw new Exception("Database return new ObjectID with null value");
        }
        return $newUUID;
    }

    private function connect() : void
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password);
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
            if ($isNew->getValue($o))
            $isNew->setValue($o, false);
        }
        // execute sql
        foreach(explode("\n", $sql) as $s)
            echo $s . "<br>";
        $this->object = array();
        return true;
    }
}

?>