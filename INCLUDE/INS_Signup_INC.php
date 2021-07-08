<?php

if (isset($_POST["submit"])) {
	
	$username= $_POST["username"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];
	$day= $_POST["day"];
	$month= $_POST["month"];
	$year= $_POST["year"];

	require_once "DBH_INC.php";
	require_once "INS_FUNCTIONS_INC.php";


	 if (emptyInputSignup($username,$email,$phone,$day,$month,$year) !== false) {
	 	header("location: ../INSTRUCTOR/INS_Sign-up.php?error=emptyinput");
	 	exit();
	 }

	 if (invalidUid($username) !== false) {
	 	header("location: ../INSTRUCTOR/INS_Sign-up.php?error=invalidUid");
	 	exit();
	 }

	 if (UidExists($conn,$username) !== false) {
	 	header("location: ../INSTRUCTOR/INS_Sign-up.php?error=usernametakenR");
	 	exit();
     }
     
     if (UidExists2($conn,$username) !== false) {
        header("location: ../INSTRUCTOR/INS_Sign-up.php?error=usernametakenI");
        exit();
    }

	   createUser($conn,$username,$email,$phone,$day,$month,$year);
}
	else{
		header("location: ../INSTRUCTOR/INS_Sign-up.php");
		exit();
	}