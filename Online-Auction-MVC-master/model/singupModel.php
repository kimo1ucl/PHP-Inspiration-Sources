<?php

require_once 'config.php';
class singupModel {
	function __construct() {
		$this -> conset = new config();
	}

	public function openDB() {
		$this -> conn = new mysqli($this -> conset -> servername, $this -> conset -> username, $this -> conset -> password, $this -> conset -> dbname);
		if ($this -> conn -> connect_error) {
			die("Connection failed: " . $this -> conn -> connect_error);
			}
			}

	public function closeDB() {
		$this -> conn -> close();
	}

	public function singup($email, $fname, $lname, $mno, $pass) {
		$this -> openDB();
		$stmt = $this -> conn -> prepare("SELECT * FROM details WHERE Email = ?");
		$stmt -> bind_param("s", $email);
		$stmt -> execute();
		$res = $stmt -> get_result();

		if ($res->num_rows > 0){
			echo "<script type='text/javascript'>alert('User Exist!')</script>";
		}
		else{
			$stmt = $this -> conn -> prepare("INSERT INTO details (Email, FirstName, LastName, Mob, password) VALUES (?, ?, ?, ?, ?)");
			$stmt -> bind_param("sssss", $email, $fname, $lname, $mno, $pass);
			$stmt -> execute();
			 echo "<script type='text/javascript'>alert('User successfully created')</script>";
		}
		$this -> closeDB();
	}

	public function login($email, $pass) {
		$this -> openDB();
		$stmt = $this -> conn -> prepare("SELECT * FROM details WHERE Email=? AND password=?");

		$stmt -> bind_param("ss", $email, $pass);
		if ($stmt -> execute()) {
			$res = $stmt -> get_result();
			$this -> closeDB();
			return $res -> fetch_object();

		} else {
			return FALSE;
		}
	}

	public function logout() {

		session_start();
		session_destroy();
	}

}
?>