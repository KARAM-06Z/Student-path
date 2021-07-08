<?php

function emptyInput($username,$day,$month,$year){
	if (empty($username) || empty($day) || empty($month) || empty($year)) {
        return true;
	}

    return false;
}

function emptyInput_INS($username,$day,$month,$year,$email,$phone){
	if (empty($username) || empty($day) || empty($month) || empty($year) || empty($email) || empty($phone)) {
        return true;
	}

    return false;
}

function invalidUid($username){
	if (!preg_match("/^[a-zA-Z0-9 .]*$/", $username)) {
        return true;
	}

    return false;
}

function UidExists($conn,$username){
	$q= "SELECT * FROM students WHERE usersUid = ?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../STUDENT/student_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);

	$resultData= mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	
	if ($row= mysqli_fetch_assoc($resultData)) {
        return true;
	}

    return false;
}

function UidExists_INS($conn,$username){
	$q= "SELECT * FROM instructors WHERE userUid = ?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/instructor_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);

	$resultData= mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	
	if ($row= mysqli_fetch_assoc($resultData)) {
        return true;
	}

    return false;
}

function Update_username($conn,$conn_todo,$username,$old_username,$id){

    $status_update = false;
    $status_rename = false;

	$q="UPDATE students SET usersUid=? WHERE usersID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../STUDENT/student_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"si",$username,$id);
	
	if(mysqli_stmt_execute($stmt)){
        $status_update = true;
	}

    $q="ALTER TABLE $old_username RENAME TO $username;";
        $stmt = mysqli_stmt_init($conn_todo);
        if (!mysqli_stmt_prepare($stmt,$q)) {	
            header("location: ../STUDENT/student_profile.php?error=stmtfaliure");
             exit();
        }

        if(mysqli_stmt_execute($stmt)){
            $status_rename = true;
        }

    if($status_update && $status_rename){
        return true;
    }

    return false;
}

function Update_username_INS($conn,$username,$old_username,$id){

    $status_update = false;
    $status_rename = false;

	$q="UPDATE instructors SET userUid=? WHERE userID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/instructor_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"si",$username,$id);
	
	if(mysqli_stmt_execute($stmt)){
        $status_update = true;
	}

	$q="UPDATE ins_exams SET owner_name = ? WHERE owner_name = ?;";
	
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/instructor_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"ss",$username,$old_username);
	
	if(mysqli_stmt_execute($stmt)){
        $status_rename = true;
	}

	if($status_update && $status_rename){
		return true;
	}

    return false;
}

function Update_date($conn,$id,$day,$month,$year){

	$q="UPDATE students SET
		day=?,
		month=?,
		year=?
	WHERE usersID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../STUDENT/student_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"isii",$day,$month,$year,$id);
	
	if(mysqli_stmt_execute($stmt)){
        return true;
	}
	return false;
}

function Update_date_INS($conn,$id,$day,$month,$year){

	$q="UPDATE instructors SET
		day=?,
		month=?,
		year=?
	WHERE userID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/instructor_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"isii",$day,$month,$year,$id);
	
	if(mysqli_stmt_execute($stmt)){
        return true;
	}
	return false;
}

function check_email($email){
	if(preg_match('/^[a-zA-z0-9]+@[a-zA-z0-9]+\.[a-zA-z0-9]{2,4}$/', $email)){
		return true;
	}
	return false;
}

function empty_password_one_field($new_password,$repeat_password){
	if(!empty($new_password) && empty($repeat_password)){
		return true;
	}

	if(empty($new_password) && !empty($repeat_password)){
		return true;
	}
	
	return false;
}

function update_email($conn,$email,$id){
	$q="UPDATE instructors SET email=? WHERE userID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/instructor_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"si",$email,$id);
	
	if(mysqli_stmt_execute($stmt)){
        return true;
	}

	return false;
}

function check_phone_length($phone){
	if(strlen($phone) == 10){
		return true;
	}

	return false;
}

function update_phone($conn,$phone,$id){
	$q="UPDATE instructors SET phone=? WHERE userID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/instructor_profile.php?error=stmtfaliure");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"si",$phone,$id);
	
	if(mysqli_stmt_execute($stmt)){
        return true;
	}

	return false;
}

function password_not_empty($new_password,$repeat_password){
	if(!empty($new_password) && !empty($repeat_password)){
		return true;
	}
	
	return false;
}

function password_not_match($new_password,$repeat_password){
	if($new_password !== $repeat_password){
		return true;
	}
	return false;
}

function check_password_length($new_password){
	if(strlen($new_password) < 8){
		return true;
	}
	return false;
}

function update_password($conn,$new_password,$id){
	$hashedpassword= password_hash($new_password, PASSWORD_DEFAULT);

	$q= "UPDATE students SET usersPwd = ? WHERE usersID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../STUDENT/student_profile.php?error=stmtfaliure");
	 	exit();
	}
	
	mysqli_stmt_bind_param($stmt,"si",$hashedpassword,$id);
	
	if(mysqli_stmt_execute($stmt)){
        return true;
	}
	return false;
}

function update_password_INS($conn,$new_password,$id){
	$hashedpassword= password_hash($new_password, PASSWORD_DEFAULT);

	$q= "UPDATE instructors SET usersPWD = ? WHERE userID = ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/instructor_profile.php?error=stmtfaliure");
	 	exit();
	}
	
	mysqli_stmt_bind_param($stmt,"si",$hashedpassword,$id);
	
	if(mysqli_stmt_execute($stmt)){
        return true;
	}
	return false;
}