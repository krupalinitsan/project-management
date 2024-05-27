<?php

class Common
{

    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function fetchAllRecords($tableName)
    {
        $sql = "SELECT * FROM " . $tableName;
        return $this->connection->query($sql);
    }
    public function updateStatus($id, $status, $tableName)
    {
        $sql = "UPDATE $tableName SET status = '$status' WHERE id = '$id'";
        return $this->connection->query($sql);
    }

    public function deleteRecord($id, $tableName, $hardDelete = false)
    {
        if ($hardDelete) {
            $sql = "DELETE FROM " . $tableName . " WHERE id = '$id'";
        } else {
            $sql = "UPDATE $tableName SET deleted = 1 WHERE id = '$id'";
        }
        return $this->connection->query($sql);
    }

    public function getRecordById($id, $tableName)
    {
        $sql = "SELECT * FROM $tableName WHERE id = $id";
        return $this->connection->query($sql)->fetch_assoc();
    }

    public function softDelete($id, $tableName)
    {
        $delete_sql = "UPDATE $tableName SET deleted = 1 WHERE id = '$id'";
        return $this->connection->query($delete_sql);
    }

    public function hardDelete($id, $tableName)
    {
        $delete_sql = "DELETE FROM $tableName WHERE id = '$id'";
        return $this->connection->query($delete_sql);
    }
}