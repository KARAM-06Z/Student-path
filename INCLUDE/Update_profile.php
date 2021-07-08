<?php

include_once "DBH_INC.php";
include_once "DBH_ToDo_INC.php";
include_once "update_functions.php";
session_start();

$id=$_POST["id"];
$username= $_POST["username"];
$old_username = $_POST["old_username"];
$day= $_POST["day"];
$month= $_POST["month"];
$year= $_POST["year"];
$new_password=$_POST["new_password"];
$repeat_password=$_POST["repeat_password"];

if(emptyInput($username,$day,$month,$year)){
	header("location: ../STUDENT/student_profile.php?error=emptyfield");
	exit();
}


if(empty_password_one_field($new_password,$repeat_password)){
	header("location: ../STUDENT/student_profile.php?error=emptypasswordfield");
	exit();
}

if($username !== $old_username){
	
	if(invalidUid($username)){
		header("location: ../STUDENT/student_profile.php?error=invalidUID");
		exit();
	}
	
	if(UidExists($conn,$username)){
	header("location: ../STUDENT/student_profile.php?error=UidExists");
	exit();
	}
	
	if(Update_username($conn,$conn_todo,$username,$old_username,$id)){
		$_SESSION["usersUid"]=$username;
		header("location: ../STUDENT/student_profile.php?error=none");
	}
}

if(Update_date($conn,$id,$day,$month,$year)){
	header("location: ../STUDENT/student_profile.php?error=none");
}

if (password_not_empty($conn,$new_password,$repeat_password,$id)){
	if(password_not_match($new_password,$repeat_password)){
		header("location: ../STUDENT/student_profile.php?error=password_dismatch");
		exit();
	}

	if(check_password_length($new_password)){
		header("location: ../STUDENT/student_profile.php?error=password_less_than_8");
		exit();
	}

	if(update_password($conn,$new_password,$id)){
		header("location: ../STUDENT/student_profile.php?error=none");
	}
}