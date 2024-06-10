<?php
// app/Models/Employee.php
require_once 'Models/Common.php';
class Employee extends Common
{

    // methods for adding user

    public function addUser($fname, $mname, $lname, $email, $role, $team)
    {
        $sql = "INSERT INTO users (firstname, middlename, lastname,  email, role, team_id) 
 VALUES ('$fname', '$mname', '$lname', '$email', '$role', '$team')";
        return $this->connection->query($sql);
    }

    //method for update user

    // public function getUserById($id)
    // {
    //     $sql = "SELECT * FROM users WHERE id = $id";
    //     return $this->connection->query($sql)->fetch_assoc();
    // }
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users 
    INNER JOIN projects ON users.id = projects.id 
    WHERE users.id = $id";
        return $this->connection->query($sql)->fetch_assoc();
    }
    public function updateUser($id, $fname, $mname, $lname, $email, $role, $team)
    {
        $sql = "UPDATE users 
                        SET firstname='$fname', middlename='$mname', lastname='$lname', email='$email', role='$role', team_id='$team'
                        WHERE id='$id'";
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
}

?>