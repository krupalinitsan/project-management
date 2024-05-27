<?php
// index.php

require 'config/config.php';
require 'Controllers/LoginController.php';
require 'Controllers/ProjectController.php';
require 'Controllers/UserController.php';
require 'Controllers/TaskController.php';
require 'Controllers/ProfileController.php';
require 'Controllers/TeamController.php';


session_start();
$id = $_SESSION['ID'];

if (isset($_SERVER['PATH_INFO'])) {
    switch ($_SERVER['PATH_INFO']) {
        //login case
        case '/':
        case '/login':
            $loginController = new LoginController($connection);
            $loginController->login();
            break;
        case '/register':
            $loginController = new LoginController($connection);
            $loginController->register();
            break;
        case '/resetpassword':
            $loginController = new LoginController($connection);
            $loginController->resetPassword();
            break;
        case '/dashboard';
            include_once 'Views/dashboard.php';
            break;
        case '/logout';
            include_once 'Views/logout.php';
            break;

        // routes for project crud operation
        case '/project';
            $projectController = new ProjectController($connection);
            $projectController->handleRequest();
            break;
        case '/add_projects';
            $projectController = new ProjectController($connection);
            $projectController->addProject();
            break;
        case '/manage_project';
            if (isset($_GET['id'])) {
                $projectController = new ProjectController($connection);
                $projectController->manageProject($_GET['id']);
            } else {
                echo "Project ID is required.";
            }
            break;

        //routes for user crud opeartions
        case '/users';
            $usercontroller = new UserController($connection);
            $usercontroller->handleUserRequest();
            break;

        case '/add_user';
            $usercontroller = new UserController($connection);
            $usercontroller->addUser();
            break;
        case '/manage_user';
            if (isset($_GET['id'])) {
                $usercontroller = new UserController($connection);
                $usercontroller->editUser($_GET['id']);
            } else {
                echo "user ID is required.";
            }
            break;

        //routes for User dashboard activity
        case '/usertask';
            $taskcontroller = new TaskController($connection);
            $taskcontroller->updateStatus();
            break;
        case '/usercalander';
            $taskcontroller = new TaskController($connection);
            $taskcontroller->calanderTask();
            break;

        //routes for task crud opeartion 
        case '/task';
            $taskcontroller = new TaskController($connection);
            $taskcontroller->handleTaskRequest();
            break;
        case '/manage_task';
            if (isset($_GET['id'])) {
                $taskcontroller = new TaskController($connection);
                $taskcontroller->editTask($_GET['id']);
            }
            break;
        case '/add_task';
            $taskcontroller = new TaskController($connection);
            $taskcontroller->addTask();
            break;

        //route for profile o my Account 
        case '/profile':
            $profileController = new ProfileController($connection);
            $profileController->handleProfile($id);
            break;

        //routes for team crud opeartion 
        case '/team':
            $teamController = new TeamController($connection);
            $teamController->handleTeamRequest();
            break;
        case '/manage_team';
            if (isset($_GET['id'])) {
                $teamController = new TeamController($connection);
                $teamController->manageTeam();
            }
            break;
        case '/add_team';
            $teamController = new TeamController($connection);
            $teamController->addTeam();
            break;
        case '/admin_dashboard';
            $projectController = new ProjectController($connection);
            $projectController->fetchProject();
            break;
        default:
            // Handle 404 error
            echo "404 Not Found";
            break;
    }

}
?>