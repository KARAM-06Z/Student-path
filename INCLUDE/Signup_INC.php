<?php

if (isset($_POST["submit"])) {
	
	$username= $_POST["username"];
	$pwd= $_POST["password"];
	$pwdRepeat= $_POST["passwordrepeat"];
	$day= $_POST["day"];
	$month= $_POST["month"];
	$year= $_POST["year"];

	require_once "DBH_INC.php";
	require_once "FUNCTIONS_INC.php";


	 if (emptyInputSignup($username,$pwd,$pwdRepeat,$day,$month,$year) !== false) {
	 	header("location: ../STUDENT/Sign-up.php?error=emptyinput");
	 	exit();
	 }

	 if (invalidUid($username) !== false) {
	 	header("location: ../STUDENT/Sign-up.php?error=invalidUid");
	 	exit();
	 }

	 if (pwdMatch($pwd,$pwdRepeat) !== false) {
	 	header("location: ../STUDENT/Sign-up.php?error=passworddontmatch");
	 	exit();
	 }

	 if (UidExists($conn,$username) !== false) {
	 	header("location: ../STUDENT/Sign-up.php?error=usernametaken");
	 	exit();
	 }

	   createUser($conn,$username,$pwd,$day,$month,$year);
}
	else{
		header("location: ../STUDENT/Sign-up.php");
		exit();
	}