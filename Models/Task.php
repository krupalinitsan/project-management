<?php
// app/Models/Project.php

class Task
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getTasksByEmployeeId()
    {
        $employeeId = $_SESSION['ID'];
        $query = "SELECT * FROM tasks WHERE employee_id='$employeeId'";
        $result = $this->connection->query($query);
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function updateTaskStatus($id, $status)
    {
        $query = "UPDATE tasks SET status='$status' WHERE id='$id'";
        return $this->connection->query($query);
    }

    //calander task methods
    public function weekTask()
    {
        $today = date("Y-m-d");
        $startOfWeek = date("Y-m-d", strtotime('monday this week', strtotime($today)));

        $endOfWeek = date("Y-m-d", strtotime('friday this week', strtotime($today)));

        $id = $_SESSION['ID'];
        $query = "SELECT * FROM tasks WHERE employee_id='$id' AND start_date >= '$startOfWeek' AND end_date <= '$endOfWeek'";
        $result = $this->connection->query($query);
        return $result->fetch_assoc();

    }

    public function getDataFromProject($project_id)
    {
        $sql = "SELECT * FROM projects WHERE id='$project_id'";
        return $this->connection->query($sql);
    }


    // admin task functions 

    //fetch task
    public function deleteTask($id)
    {
        $delete_sql = "DELETE FROM tasks WHERE id = '$id'";
        return $this->connection->query($delete_sql);
    }
    public function deleteUserTask($id)
    {
        $delete_sql = "UPDATE tasks SET deleted = 1 WHERE id = '$id'";
        return $this->connection->query($delete_sql);
    }

    public function getAllTask()
    {
        $sql = "SELECT * FROM tasks";
        return $this->connection->query($sql);
    }

    public function getEmployeeNameById($id)
    {
        $sql = "SELECT firstname FROM users WHERE id='$id'";
        return $this->connection->query($sql)->fetch_assoc();
    }

    public function getProjectNameById($id)
    {
        $sql = "SELECT name FROM projects WHERE id='$id'";
        return $this->connection->query($sql)->fetch_assoc();
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE tasks SET status='$status' WHERE id='$id'";
        return $this->connection->query($sql);
    }

    //edit task 

    public function getCurrentTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id = $id";
        return $this->connection->query($sql)->fetch_assoc();
    }
    
    public function updateTask($id, $pname, $description, $sdate, $edate, $deadline, $employee_id, $project_id)
    {
        $sql = "UPDATE tasks SET 
        name = '$pname', 
        description = '$description', 
        employee_id = '$employee_id', 
        project_id = '$project_id', 
        deadline = '$deadline', 
        start_date = '$sdate', 
        end_date = '$edate' 
        WHERE id = $id";
        return $this->connection->query($sql);
    }
    public function getAllUser()
    {
        $sql = "SELECT * FROM users";
        return $this->connection->query($sql);
    }
    public function getAllProject()
    {
        $sql = "SELECT * FROM projects";
        return $this->connection->query($sql);
    }

    //add task operation methods 

    public function create($pname, $description, $sdate, $edate, $deadline, $employee_id, $project_id)
    {
        $sql = "INSERT INTO tasks (name, description, employee_id, project_id, deadline, start_date, end_date)
        VALUES ('$pname', '$description', '$employee_id', '$project_id', '$deadline', '$sdate', '$edate')";
        return $this->connection->query($sql);

    }
}