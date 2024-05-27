<?php
// app/Models/User.php
require_once 'Models/Common.php';
class User extends Common
{
	// login user
	public function getUserByEmailAndPassword($email, $password)
	{
		$email = $this->connection->real_escape_string($email);
		$password = md5($this->connection->real_escape_string($password));

		$sql = "SELECT * FROM `users` WHERE email='$email' AND pass='$password'";
		$result = $this->connection->query($sql);

		return $result->fetch_assoc();
	}

	// register user
	public function registerUser($fname, $mname, $lname, $email, $password)
	{
		$fname = $this->connection->real_escape_string($fname);
		$mname = $this->connection->real_escape_string($mname);
		$lname = $this->connection->real_escape_string($lname);
		$email = $this->connection->real_escape_string($email);
		$password = md5($this->connection->real_escape_string($password));

		$sql = "INSERT INTO users (firstname, middlename, lastname, email, pass) VALUES ('$fname', '$mname', '$lname', '$email', '$password')";
		return $this->connection->query($sql);
	}
	//update password
	public function updatePassword($email, $newPassword)
	{
		$email = $this->connection->real_escape_string($email);
		$newPassword = md5($this->connection->real_escape_string($newPassword));

		$sql = "UPDATE `users` SET pass='$newPassword' WHERE email='$email'";
		return $this->connection->query($sql);
	}
	//email verify for reset password
	public function emailExists($email)
	{
		$email = $this->connection->real_escape_string($email);

		$sql = "SELECT email FROM `users` WHERE email='$email'";
		$result = $this->connection->query($sql);

		return $result->num_rows > 0;
	}

}
?>