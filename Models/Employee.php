<?php
// app/Models/Employee.php

class Employee
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAllEmployees()
    {
        $sql = "SELECT * FROM users";
        return $this->connection->query($sql);
    }
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE users SET status = '$status' WHERE id = '$id'";
        return $this->connection->query($sql);
    }

    public function deleteEmployee($id, $hardDelete)
    {
        if ($hardDelete) {
            $sql = "DELETE FROM users WHERE id = '$id'";
        } else {
            $sql = "UPDATE users SET deleted = 1 WHERE id = '$id'";
        }
        return $this->connection->query($sql);
    }

    public function getRoleById($role_id)
    {
        $sql = "SELECT name FROM roles WHERE id='$role_id'";
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }

    public function getTeamById($team_id)
    {
        $sql = "SELECT name FROM teams WHERE id='$team_id'";
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }


    // methods for adding user


    public function addUser($fname, $mname, $lname, $email, $role, $team)
    {
        $sql = "INSERT INTO users (firstname, middlename, lastname,  email, role, team_id) 
 VALUES ('$fname', '$mname', '$lname', '$email', '$role', '$team')";
        return $this->connection->query($sql);
    }

    public function getRoles()
    {
        $sql = "SELECT * FROM roles";
        return $this->connection->query($sql);
    }

    public function getTeam()
    {
        $sql = "SELECT * FROM teams";
        return $this->connection->query($sql);
    }

    //method for update user

    public function getUsertById($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        return $this->connection->query($sql)->fetch_assoc();
    }
    public function updateUser($id, $fname, $mname, $lname, $email, $role, $team)
    {
        $sql = "UPDATE users 
                        SET firstname='$fname', middlename='$mname', lastname='$lname', email='$email', role='$role', team_id='$team'
                        WHERE id='$id'";
        return $this->connection->query($sql);

    }
}

?>