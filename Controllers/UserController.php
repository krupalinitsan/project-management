<?php
// app/Controllers/UserController.php

require_once 'Models/Employee.php';

class UserController
{
    private $employeeModel;

    public function __construct($connection)
    {
        $this->employeeModel = new Employee($connection);
    }

    //method for display user
    public function handleUserRequest()
    {
        // session_start();

        if (isset($_GET['type'])) {
            $type = $_GET['type'];

            if ($type == 'status' && isset($_GET['operation'], $_GET['id'])) {
                $status = ($_GET['operation'] == 'active') ? 1 : 0;
                $id = $_GET['id'];
                $this->employeeModel->updateStatus($id, $status);
            }

            if ($type == 'delete' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $role = $_SESSION['ROLE'];
                $hardDelete = ($role == 1);
                $this->employeeModel->deleteEmployee($id, $hardDelete);
                $_SESSION['message'] = $hardDelete ? "user hard deleted successfully!" : "user soft deleted successfully!";
                header("Location: users");
                exit();
            }
        }
        // $role = $this->employeeModel->getRoleById($row['role']);
        $employees = $this->employeeModel->getAllEmployees();
        $employeeModel = $this->employeeModel;
        include_once 'Views/user/users.php';

    }

    // methods for add user

    public function addUser()
    {

        $msg = "";

        if (isset($_POST['add'])) {

            // Fetch $_POST values
            $fname = trim($_POST['fname']);
            $mname = trim($_POST['mname']);
            $lname = trim($_POST['lname']);
            // $password = trim($_POST['password']);
            $email = trim($_POST['email']);
            $role = $_POST['role'];
            $team = $_POST['team'];

            // Validate inputs
            if (empty($fname) || empty($mname) || empty($lname) || empty($email) || empty($role) || empty($team)) {
                $msg = "Please enter all required details.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "Please enter a valid email address.";
            } else {
                // Insertion query

                $data = $this->employeeModel->addUser($fname, $mname, $lname, $email, $role, $team);

                if ($data) {
                    echo '<script>alert("Data inserted successfully."); 
                    window.location.replace("users");</script>';
                    exit();
                    // $msg = "Data inserted successfully.";
                } else {
                    $msg = "Error inserting data. Please try again.";
                }
            }
        }

        $roles = $this->employeeModel->getRoles();
        $teams = $this->employeeModel->getTeam();
        $employeeModel = $this->employeeModel;
        include_once 'Views/user/add_user.php';

    }

    //methods for edit user

    public function editUser($id)
    {
        $msg = "";

        $user = $this->employeeModel->getUsertById($id);
        if (isset($_POST['update'])) {
            // Validate and sanitize user input
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            // $password = $_POST['password'];
            $email = $_POST['email'];
            $role = intval($_POST['role']);
            $team = intval($_POST['team']);

            // Check if all fields are filled
            if (!empty($fname) && !empty($lname) && !empty($email) && !empty($role) && !empty($team)) {

                $data = $this->employeeModel->updateUser($id, $fname, $mname, $lname, $email, $role, $team);

                if ($data) {
                    echo '<script>alert("Data updated successfully."); 
                    window.location.replace("users");</script>';
                    exit();
                } else {
                    $msg = "Failed to update user. Please try again.";
                }
            } else {
                $msg = "Please fill in all fields.";
            }
        }

        $roles = $this->employeeModel->getRoles();
        $teams = $this->employeeModel->getTeam();
        $employeeModel = $this->employeeModel;
        include_once 'Views/user/manage_user.php';
    }
}
?>