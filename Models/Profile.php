<?php
// app/Models/Profile.php
require_once 'Models/Common.php';
class Profile extends Common
{
    public function updateUser($id, $fname, $mname, $lname, $password, $email)
    {
        $sql = "UPDATE users SET firstname='$fname', middlename='$mname', lastname='$lname', pass='$password', email='$email' WHERE id=$id";
        return $this->connection->query($sql);
    }
}
?>