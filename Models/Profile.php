<?php
// app/Models/Profile.php

class Profile {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        return $this->connection->query($sql)->fetch_assoc();
    }

    public function updateUser($id, $fname, $mname, $lname, $password, $email) {
        $sql = "UPDATE users SET firstname='$fname', middlename='$mname', lastname='$lname', pass='$password', email='$email' WHERE id=$id";
        return $this->connection->query($sql);
    }
}
?>
