<?php
// app/Models/Project.php

class Project
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAllProjects()
    {
        $sql = "SELECT * FROM projects";
        return $this->connection->query($sql);
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE projects SET status = '$status' WHERE id = '$id'";
        return $this->connection->query($sql);
    }

    public function deleteProject($id, $hardDelete = false)
    {
        if ($hardDelete) {
            $sql = "DELETE FROM projects WHERE id = '$id'";
        } else {
            $sql = "UPDATE projects SET deleted = 1 WHERE id = '$id'";
        }
        return $this->connection->query($sql);
    }

    public function projectAdd($pname, $description, $sdate, $edate, $deadline)
    {
        // Insert into the database
        $sql = "INSERT INTO projects (name, description, start_date, end_date, deadline)
         VALUES ('$pname', '$description', '$sdate', '$edate', '$deadline')";
        return $this->connection->query($sql);
    }

    public function getProjectById($id)
    {
        $sql = "SELECT * FROM projects WHERE id = $id";
        return $this->connection->query($sql)->fetch_assoc();
    }

    public function updateProject($id, $name, $description, $startDate, $endDate, $deadline)
    {
        $sql = "UPDATE projects 
                SET name='$name', description='$description', start_date='$startDate', end_date='$endDate', deadline='$deadline' 
                WHERE id='$id'";
        return $this->connection->query($sql);
    }
}
?>