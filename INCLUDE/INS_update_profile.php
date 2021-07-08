<?php

include_once "DBH_INC.php";
include_once "update_functions.php";
session_start();

$id=$_POST["id"];
$username= $_POST["username"];
$old_username = $_POST["old_username"];
$day= $_POST["day"];
$month= $_POST["month"];
$year= $_POST["year"];
$email= $_POST["email"];
$phone= $_POST["phone"];
$new_password=$_POST["new_password"];
$repeat_password=$_POST["repeat_password"];

if(emptyInput_INS($username,$day,$month,$year,$email,$phone)){
	header("location: ../INSTRUCTOR/instructor_profile.php?error=emptyfield");
	exit();
}


if(empty_password_one_field($new_password,$repeat_password)){
	header("location: ../INSTRUCTOR/instructor_profile.php?error=emptypasswordfield");
	exit();
}

if($username !== $old_username){
	
	if(invalidUid($username)){
		header("location: ../INSTRUCTOR/instructor_profile.php?error=invalidUID");
		exit();
	}
	
	if(UidExists_INS($conn,$username)){
	header("location: ../INSTRUCTOR/instructor_profile.php?error=UidExists");
	exit();
	}
	
	if(Update_username_INS($conn,$username,$old_username,$id)){
		$_SESSION["userUid"]=$username;
		header("location: ../INSTRUCTOR/instructor_profile.php?error=none");
	}
}

if(Update_date_INS($conn,$id,$day,$month,$year)){
	header("location: ../INSTRUCTOR/instructor_profile.php?error=none");
}

if(!check_email($email)){
    header("location: ../INSTRUCTOR/instructor_profile.php?error=invalid_email");
    exit();
}

if(update_email($conn,$email,$id)){
    header("location: ../INSTRUCTOR/instructor_profile.php?error=none");
}

if(!check_phone_length($phone)){
    header("location: ../INSTRUCTOR/instructor_profile.php?error=invalid_phone_number");
    exit();
}

if(update_phone($conn,$phone,$id)){
    header("location: ../INSTRUCTOR/instructor_profile.php?error=none");
}

if (password_not_empty($conn,$new_password,$repeat_password,$id)){
	if(password_not_match($new_password,$repeat_password)){
		header("location: ../INSTRUCTOR/instructor_profile.php?error=password_dismatch");
		exit();
	}

	if(check_password_length($new_password)){
		header("location: ../INSTRUCTOR/instructor_profile.php?error=password_less_than_8");
		exit();
	}

	if(update_password_INS($conn,$new_password,$id)){
		header("location: ../INSTRUCTOR/instructor_profile.php?error=none");
	}
}