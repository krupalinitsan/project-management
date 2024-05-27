<?php
require_once 'Models/Common.php';

class Task extends Common
{
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

    //edit task 

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

    //add task operation methods 
    public function create($pname, $description, $sdate, $edate, $deadline, $employee_id, $project_id)
    {
        $sql = "INSERT INTO tasks (name, description, employee_id, project_id, deadline, start_date, end_date)
        VALUES ('$pname', '$description', '$employee_id', '$project_id', '$deadline', '$sdate', '$edate')";
        return $this->connection->query($sql);

    }
    public function getAllTask()
    {
        $sql = "SELECT * FROM tasks";
        return $this->connection->query($sql);
    }

}