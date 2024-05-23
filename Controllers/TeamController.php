<?php
// app/Controllers/ProjectController.php

require_once 'Models/Team.php';

class TeamController
{
    private $teamModel;

    public function __construct($connection)
    {
        $this->teamModel = new Team($connection);
    }

    public function handleTeamRequest()
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
                $this->teamModel->updateStatus($id, $status);

            }
            // Execute the delete query

            if ($type == 'delete') {
                $id = $_GET['id'];
                $role = $_SESSION['ROLE'];
                // Check if the role is admin (assuming $role is defined elsewhere in your code)
                if ($role == 1) {
                    $data = $this->teamModel->deleteRole($id);

                    if ($data) {
                        $_SESSION['message'] = "Team hard deleted successfully!";
                    }
                    // Soft delete query to update the 'deleted' column

                } else {
                    // Hard delete query to remove the task from the database

                    $data = $this->teamModel->deleteByUser($id);

                    if ($data) {
                        $_SESSION['message'] = "Team soft deleted successfully!";
                    }
                    // $message = "Team soft deleted successfully!";
                }
                header("Location: team"); // Redirect to the users page
                exit();

            }
        }
        $result = $this->teamModel->getTeam();
        include 'Views/team/team.php';
    }


    // methods for edit team data 
    public function manageTeam()
    {

        $msg = "";
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if (isset($_POST['edit'])) {
            // Validate and sanitize user input
            $tname = $_POST['tname'];

            // Check if team name is not empty
            if (!empty($tname)) {
                // SQL query to update team name
                $data = $this->teamModel->editTeam($id, $tname);
                if ($data) {
                    echo '<script>alert("team updated successfully."); 
                    window.location.replace("team");</script>';
                    exit();
                } else {
                    $msg = "Failed to update user. Please try again.";
                }
            } else {
                $msg = "Please fill in all fields.";
            }
        }

        include 'Views/team/manage_team.php';
    }

    //add team methods

    public function addTeam()
    {
        $msg = "";

        if (isset($_POST['add'])) {

            // Fetch $_POST values
            $tname = trim($_POST['tname']);

            // Validate input
            if (empty($tname)) {
                $msg = "Please enter a valid team name.";
            } else {
                // Insertion query
                $data = $this->teamModel->addTeam($tname);
                if ($data) {
                    echo '<script>alert("team inserted successfully."); 
                    window.location.replace("team");</script>';
                    exit();
                } else {
                    $msg = "Error inserting team. Please try again.";
                }
            }
        }
        include 'Views/team/add_team.php';
    }
}