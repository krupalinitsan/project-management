<?php
// app/Controllers/UserController.php

require_once 'Models/Task.php';

class TaskController
{
    private $taskModel;

    public function __construct($connection)
    {
        $this->taskModel = new Task($connection);
    }
    // usertask method 
    public function updateStatus()
    {
        if (isset($_GET['type']) && $_GET['type'] === 'status') {
            $operation = $_GET['operation'];
            $id = $_GET['id'];
            $status = ($operation === 'active') ? '1' : '0';
            $this->taskModel->updateTaskStatus($id, $status);
        }
        $tasks = $this->taskModel->getTasksByEmployeeId();
        include 'Views/user-task/usertask.php';
    }

    public function calanderTask()
    {
        // Calculate the start and end dates of the current week

        $task = $this->taskModel->weekTask();

        if (!$task) {
            include ("Views/header.php");
            echo "<p><center>no tasks found for this week.<center></p>";
            exit();
        }

        $project_id = isset($task['project_id']) ? $task['project_id'] : null;

        if ($project_id) {
            $project_result = $this->taskModel->getDataFromProject($project_id);
        } else {
            $project_result = null;
        }

        $id = isset($task['id']) ? $task['id'] : null;

        if ($id && isset($_POST['sstatus'])) {
            $status = $_POST['status'];

            $data = $this->taskModel->updateTaskStatus($id, $status);

            if ($data) {
                echo '<script>alert("Status updated successfully."); window.location.replace("usercalander");</script>';
                exit();
            } else {
                $msg = "Error: connection failed";
                echo "<script>alert('$msg');</script>";
            }
        }
        include 'Views/user-task/usercalander.php';
    }


    // admin task method


    //fetch data
    public function handleTaskRequest()
    {
        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $_GET['type'];
            if ($type == 'status') {
                $operation = $_GET['operation'];
                $id = $_GET['id'];
                if ($operation == 'active') {
                    $status = '1';
                } else {
                    $status = '0';
                }
                $this->taskModel->updateTaskStatus($id, $status);
            }

            if ($type == 'delete') {
                $id = $_GET['id'];
                $role = $_SESSION['ROLE'];
                // Check if the role is admin 
                if ($role == 1) {
                    $data = $this->taskModel->deleteTask($id);
                    if ($data) {
                        $_SESSION['message'] = "Task hard deleted successfully!";
                    }
                } else {
                    // Hard delete query to remove the task from the database
                    $data = $this->taskModel->deleteUserTask($id);
                    if ($data) {
                        $_SESSION['message'] = "Task soft deleted successfully!";
                    }

                }
                header("Location: project.php"); // Redirect to the users page
                exit();

            }
        }

        $result = $this->taskModel->getAllTask();
        $tasks = $this->taskModel;
        include_once 'Views/task/task.php';

    }

    //edit task 

    public function editTask($id)
    {
        $msg = "";
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($id > 0) {
            // Fetch the current task data
            $task_data = $this->taskModel->getCurrentTask($id);

        } else {
            echo "Invalid task ID";
            exit;
        }

        // Handle form submission to update task data
        if (isset($_POST['update'])) {

            $pname = $_POST['pname'];
            $description = $_POST['desc'];
            $sdate = $_POST['sdate'];
            $edate = $_POST['edate'];
            $deadline = $_POST['ddate'];
            $employee_id = $_POST['employee'];
            $project_id = $_POST['project'];

            // Check if all fields are filled
            if (!empty($pname) && !empty($description) && !empty($sdate) && !empty($edate) && !empty($deadline) && !empty($employee_id) && !empty($project_id)) {
                // SQL query to update data in the tasks table

                $data = $this->taskModel->updateTask($id, $pname, $description, $sdate, $edate, $deadline, $employee_id, $project_id);

                if ($data) {
                    echo '<script>alert("task updated successfully."); 
                    window.location.replace("task");</script>';
                    exit();

                } else {
                    $msg = "Please enter valid details: ";
                }
            } else {
                $msg = "Please fill in all fields.";
            }
        }
        $tasks = $this->taskModel;
        include_once 'Views/task/manage_task.php';
    }

    //add task by admin 

    public function addTask()
    {

        $msg = "";

        // Check if the form is submitted
        if (isset($_POST['add'])) {

            // Fetch $_POST values
            $pname = $_POST['pname'];
            $description = $_POST['desc'];
            $sdate = $_POST['sdate'];
            $edate = $_POST['edate'];
            $deadline = $_POST['ddate'];
            $employee_id = $_POST['employee'];
            $project_id = $_POST['project'];

            // Validate the input data
            if (empty($pname) || empty($description) || empty($sdate) || empty($edate) || empty($deadline) || empty($employee_id) || empty($project_id)) {
                $msg = "Please fill in all fields.";
            } elseif ($sdate > $edate) {
                $msg = "Start date cannot be later than end date.";
            } elseif ($deadline < $sdate) {
                $msg = "Deadline cannot be before the start date.";
            } else {
                // SQL query to insert data into the tasks table

                $data = $this->taskModel->create($pname, $description, $sdate, $edate, $deadline, $employee_id, $project_id);

                if ($data) {
                    echo '<script>alert("task inserted successfully."); 
            window.location.replace("task");</script>';
                    exit();
                } else {
                    $msg = "Error: connection failed";
                }
            }
        }
        $tasks = $this->taskModel;
        include_once 'Views/task/add_task.php';
    }

}