<?php
// app/Controllers/ProjectController.php

require_once 'Models/Project.php';

class ProjectController
{
    private $projectModel;

    public function __construct($connection)
    {
        $this->projectModel = new Project($connection);
    }

    public function handleRequest()
    {
        // session_start();

        if (isset($_GET['type'])) {
            $type = $_GET['type'];

            if ($type == 'status' && isset($_GET['operation'], $_GET['id'])) {
                $status = ($_GET['operation'] == 'active') ? 1 : 0;
                $id = $_GET['id'];
                $this->projectModel->updateStatus($id, $status);
            }

            if ($type == 'delete' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $role = $_SESSION['ROLE'];
                $hardDelete = ($role == 1);
                $this->projectModel->deleteProject($id, $hardDelete);
                $_SESSION['message'] = $hardDelete ? "Project hard deleted successfully!" : "Project soft deleted successfully!";
                header("Location: project");
                exit();
            }
        }

        $projects = $this->projectModel->getAllProjects();
        include_once 'Views/project/project.php';

    }
    public function addProject()
    {
        $msg = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

            // Fetch and sanitize $_POST values
            $pname = $_POST['pname'];
            $description = $_POST['desc'];
            $sdate = $_POST['sdate'];
            $edate = $_POST['edate'];
            $deadline = $_POST['ddate'];



            $data = $this->projectModel->projectAdd($pname, $description, $sdate, $edate, $deadline);

            if ($data) {
                echo '<script>alert("project inserted successfully."); 
            window.location.replace("project");</script>';
                exit();
            } else {
                $msg = "Error: connection failed ";
            }

        }
        include_once 'Views/project/add_projects.php';

    }

    public function manageProject($id)
    {
        // session_start();
        $msg = "";

        $project = $this->projectModel->getProjectById($id);
        if (isset($_POST['update'])) {
            $name = $_POST['pname'];
            $description = $_POST['desc'];
            $startDate = $_POST['sdate'];
            $endDate = $_POST['edate'];
            $deadline = $_POST['ddate'];

            if (!empty($name) && !empty($description) && !empty($startDate) && !empty($endDate) && !empty($deadline)) {
                $updated = $this->projectModel->updateProject($id, $name, $description, $startDate, $endDate, $deadline);

                if ($updated) {
                    echo '<script>alert("Project updated successfully."); 
                    window.location.replace("project");</script>';
                    exit();
                } else {
                    $msg = "Failed to update project. Please try again.";
                }
            } else {
                $msg = "Please fill in all fields.";
            }
        }

        $project = $this->projectModel->getProjectById($id);
        include 'Views/Project/manage_project.php';
    }
}
?>