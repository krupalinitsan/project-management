<?php
// app/Models/Project.php
require_once 'Models/Common.php';

class Project extends Common
{
    public function projectAdd($pname, $description, $sdate, $edate, $deadline)
    {
        // Insert into the database
        $sql = "INSERT INTO projects (name, description, start_date, end_date, deadline)
         VALUES ('$pname', '$description', '$sdate', '$edate', '$deadline')";
        return $this->connection->query($sql);
    }
    public function updateProject($id, $name, $description, $startDate, $endDate, $deadline)
    {
        $sql = "UPDATE projects 
                SET name='$name', description='$description', start_date='$startDate', end_date='$endDate', deadline='$deadline' 
                WHERE id='$id'";
        return $this->connection->query($sql);
    }

    public function getProjectByStatus()
    {
        $query = "SELECT * FROM projects WHERE status = 1 ORDER BY created_at DESC";
        return $this->connection->query($query);
    }
}
?>