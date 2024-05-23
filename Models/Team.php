<?php
// app/Models/Project.php

class Team
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function updateStatus($id, $status)
    {
        $update_status_sql = "update teams set status='$status' where id='$id'";
        return $this->connection->query($update_status_sql);
    }

    public function deleteRole($id)
    {
        $delete_sql = "DELETE FROM teams WHERE id = '$id'";
        return $this->connection->query($delete_sql);
    }

    public function deleteByUser($id)
    {
        $delete_sql = "UPDATE teams SET deleted = 1 WHERE id = '$id'";
        return $this->connection->query($delete_sql);
    }

    public function getTeam()
    {
        $query = "SELECT * FROM teams";
        return $this->connection->query($query);

    }

    //edit team functiions 

    public function editTeam($id, $tname)
    {
        $sql = "UPDATE teams SET name='$tname' WHERE id='$id'";
        return $this->connection->query($sql);

    }
    public function addTeam($tname)
    {
        $sql = "INSERT INTO teams (name) VALUES ('$tname')";
        return $this->connection->query($sql);

    }
}

