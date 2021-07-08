<?php

include_once "classes.php";

function emptyInputSignup($username,$pwd,$pwdRepeat,$day,$month,$year){
	$result;
	if (empty($username) || empty($pwd) || empty($pwdRepeat) || empty($day) || empty($month) || empty($year)) {
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

function pwdMatch($pwd,$pwdRepeat){
	$result;
	
	if ($pwd !== $pwdRepeat) {
		$result= true;
	}

	else{
		$result= false;
	}

	return $result;
}

function UidExists($conn,$username){
	$q= "SELECT * FROM students WHERE usersUid = ?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {	
		header("location: ../STUDENT/Sign-up.php?error=stmtfailed");
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

function createUser($conn,$username,$pwd,$day,$month,$year){
	$q= "INSERT INTO students (usersUid,usersPwd,day,month,year) VALUES (?,?,?,?,?);";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$q)) {
		header("location: ../STUDENT/Sign-up.php?error=stmt2failed");
	 	exit();
	}


	$hashedPwd= password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt,"ssisi",$username,$hashedPwd,$day,$month,$year);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	require_once "DBH_ToDo_INC.php";

	$q="CREATE TABLE $username(
		id INT(4) AUTO_INCREMENT PRIMARY KEY,
		exam VARCHAR(100)
	);";

	$stmt= mysqli_stmt_init($conn_todo);
	mysqli_stmt_prepare($stmt,$q);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	header("location: ../STUDENT/Sign-up.php?error=none");
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
	$UidExists= UidExists($conn,$username);

	if($UidExists === false){
		header("location: ../index.php?error=doesntexist");
	 	exit();
	}

	$pwdHashed= $UidExists["usersPwd"];
	$checkPwd= password_verify($pwd,$pwdHashed);

	if($checkPwd === false){
		header("location: ../index.php?error=wrongpassword");
	 	exit();
	}

	else if ($checkPwd === true){
		session_start();
		$_SESSION["usersID"]= $UidExists["usersID"];
		$_SESSION["usersUid"]= $UidExists["usersUid"];

		header("location: ../STUDENT/Student_MAIN.php?");
		exit();
	}
}

function select_exam($conn,$examname){
		
	$q="SELECT exam_R_ID FROM ins_exams where exam_name=?";
			$stmt= mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$q)) {
				header("location: ../STUDENT/select.php?error=stmtfailed");
				 exit();
			}

			mysqli_stmt_bind_param($stmt,"s",$examname);
			mysqli_stmt_execute($stmt);

			$result= mysqli_stmt_get_result($stmt); 
			$data=mysqli_fetch_assoc($result);
			
			$R_ID= $data["exam_R_ID"];

			mysqli_stmt_close($stmt);

			return $R_ID;
}

function get_topics($connection_exam_DB,$R_ID){
	$topics_ARR = array();


	$q="SELECT DISTINCT topic_name FROM e$R_ID;";
		$stmt= mysqli_stmt_init($connection_exam_DB);
		if(!mysqli_stmt_prepare($stmt,$q)){
			header("location: ../STUDENT/STUDENT_MAIN.php?error=select_questions_stmtfailed");
			exit();
	   	}

		mysqli_stmt_execute($stmt);

		$result=mysqli_stmt_get_result($stmt);
		for($i = 0 ; $i < $data= mysqli_fetch_assoc($result) ; $i++){
			$topics_ARR[$i] = $data["topic_name"];
		}

		$topics = new topics($topics_ARR);

		return $topics;
}

function check_selection($chk_post){
	$count=0;

	foreach($chk_post as $chk){
		$count++;
	}

	return $count;
}

function save_selection($chk_post){
$topics= array();

foreach($chk_post as $chk){
	array_push($topics,$chk);
}

return $topics;
}

function select_random_questions($connection_exam_DB,$R_ID,$count,$topics){

	$ID_ARR = array();
	$Questions_ARR = array();
	$topic_break= 20/count($topics);
	$topic_index=0;
	$questions_counter=0;

	for($i = 0 ; $i < 20 ; $i++){
	$Random = RAND(0,9);

	$q= "SELECT ID,question,A,B,C,D,correct,Type FROM e$R_ID WHERE topic = ? AND num = ?;";
		$stmt = mysqli_stmt_init($connection_exam_DB);
		if(!mysqli_stmt_prepare($stmt,$q)){
			header("location: ../STUDENT/select.php?error=select_questions_stmtfailed");
			exit();
	   	}

		mysqli_stmt_bind_param($stmt , "si" , $topics[$topic_index] , $Random);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_assoc($result);

		$ID = $data["ID"];
		$question = $data["question"];
		$answer_A = $data["A"];
		$answer_B = $data["B"];
		$answer_C = $data["C"];
		$answer_D = $data["D"];
		$correct = $data["correct"];
		$type = $data["Type"];
		$topic = $topics[$topic_index];

		if(check_repetition($ID_ARR,$ID)){
			$i--;
			continue;
		}

		$Questions_ARR[$i] = new question($i,$ID,$question,$answer_A,$answer_B,$answer_C,$answer_D,$correct,$type,$topic);
		array_push($ID_ARR,$ID);
		$questions_counter++;

		mysqli_stmt_close($stmt);

		if(($i+1) % $topic_break == 0){
			$topic_index++;
		}

		if(empty($topics[$topic_index])){
			break;
		}

	}

	$loop_top = 20-$questions_counter;
	
	for($x = 0 ; $x < $loop_top ; $x++){ 
	$Random = RAND(0,9);
	$Random_topic = RAND(0,count($topics)-1);

		$q= "SELECT ID,question,A,B,C,D,correct,Type FROM e$R_ID WHERE topic = ? AND num = ?;";
		$stmt = mysqli_stmt_init($connection_exam_DB);
		if(!mysqli_stmt_prepare($stmt,$q)){
			header("location: ../STUDENT/select.php?error=select_questions_stmtfailed");
			exit();
	   	}

		mysqli_stmt_bind_param($stmt , "si" , $topics[$Random_topic] , $Random);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_assoc($result);

		$ID = $data["ID"];
		$question = $data["question"];
		$answer_A = $data["A"];
		$answer_B = $data["B"];
		$answer_C = $data["C"];
		$answer_D = $data["D"];
		$correct = $data["correct"];
		$type = $data["Type"];
		$topic = $topics[$Random_topic];

		if(check_repetition($ID_ARR,$ID)){
			$x--;
			continue;
		}

		$Questions_ARR[$questions_counter] = new question($questions_counter,$ID,$question,$answer_A,$answer_B,$answer_C,$answer_D,$correct,$type,$topic);
		array_push($ID_ARR,$ID);
		$questions_counter++;

		mysqli_stmt_close($stmt);
	}

	return $Questions_ARR;
}

function check_repetition($ID_ARR,$ID){
	for($j=0 ; $j < count($ID_ARR) ; $j++){
		if($ID_ARR[$j] === $ID){
			return true;
		}
	}
	return false;
}