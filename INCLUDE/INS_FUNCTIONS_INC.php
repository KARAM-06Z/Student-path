<?php

function emptyInputSignup($username,$email,$phone,$day,$month,$year){
	$result;
	if (empty($username) || empty($email) || empty($phone) || empty($day) || empty($month) || empty($year)) {
		$result= true;
	}

	else{
		$result= false;
	}

	return $result;
}

function invalidUid($username){
	$result;
	if (!preg_match("/^[a-zA-Z0-9 .]*$/", $username)) {
		$result= true;
	}

	else{
		$result= false;
	}

	return $result;
}

function UidExists($conn,$username){
	$q= "SELECT * FROM requests WHERE usersUid = ?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/INS_Sign-up.php?error=stmtfailed");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);

	$resultData= mysqli_stmt_get_result($stmt);

	if ($row= mysqli_fetch_assoc($resultData)) {
		return $row;
	}

	else{
		$result= false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function UidExists2($conn,$username){
	$q= "SELECT * FROM instructors WHERE userUid = ?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../INSTRUCTOR/INS_Sign-up.php?error=stmtfailed2");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"s",$username);
	mysqli_stmt_execute($stmt);

	$resultData= mysqli_stmt_get_result($stmt);

	if ($row= mysqli_fetch_assoc($resultData)) {
		return $row;
	}

	else{
		$result= false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function createUser($conn,$username,$email,$phone,$day,$month,$year){
	$q= "INSERT INTO requests (usersUid,email,phone,day,month,year) VALUES (?,?,?,?,?,?);";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {
		header("location: ../INSTRUCTOR/INS_Sign-up.php?error=stmt2failed");
	 	exit();
	}

	mysqli_stmt_bind_param($stmt,"sssisi",$username,$email,$phone,$day,$month,$year);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("location: ../INSTRUCTOR/INS_Sign-up.php?error=none&user=registered");
	exit();
}

function emptyInputlogin($username,$pwd){
	$result;
	if (empty($username) || empty($pwd)) {
		$result= true;
	}

	else{
		$result= false;
	}

	return $result;
}

function loginUser($conn,$username,$pwd){
	$UidExists= UidExists2($conn,$username);

	if($UidExists === false){
		header("location: ../INSTRUCTOR/INS_Log-in.php?error=dosntexist");
	 	exit();
    }

	 $pwdHashed= $UidExists["usersPWD"];
     $checkPwd= password_verify($pwd,$pwdHashed);

	 if($checkPwd === false){
	 	header("location: ../INSTRUCTOR/INS_Log-in.php?error=wrongpassword");
	  	exit();
	}

	else if ($checkPwd === true){
		session_start();
		$_SESSION["userID"]= $UidExists["userID"];
		$_SESSION["userUid"]= $UidExists["userUid"];

		header("location: ../INSTRUCTOR/INS_MAIN.php");
		exit();
	    }
}


function replace_lessthan($conn,$R_ID){
	$q="SELECT question,A,B,C,D,correct FROM E$R_ID;";
	$rs = mysqli_query($conn,$q);
	$x=1;

	while($Row=mysqli_fetch_array($rs)){
		$str_replaced_question=str_replace('<','&lt;',$Row[0]);
		$str_replaced_A=str_replace('<','&lt;',$Row[1]);
		$str_replaced_B=str_replace('<','&lt;',$Row[2]);
		$str_replaced_C=str_replace('<','&lt;',$Row[3]);
		$str_replaced_D=str_replace('<','&lt;',$Row[4]);
		$str_replaced_correct=str_replace('<','&lt;',$Row[5]);

		$q2="UPDATE E$R_ID SET question='$str_replaced_question',A='$str_replaced_A',B='$str_replaced_B',C='$str_replaced_C',
		D='$str_replaced_D',correct='$str_replaced_correct' WHERE ID=$x;";
		if(!$conn->query($q2))
			return false;

		$x++;
	}
	return true;
}