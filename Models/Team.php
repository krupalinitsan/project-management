<?php
// app/Models/Project.php
require_once 'Models/Common.php';
class Team extends Common
{
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

