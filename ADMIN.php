<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>

<?php

require_once "INCLUDE/DBH_INC.php";

if(!$conn){
	echo "Couldnt connect";
}

else{
	$q= "SELECT * from requests";

	$result= mysqli_query($conn,$q); 

	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_array($result)){
			echo "<p style='font-size:1vw'>ID: ".$row[0]."<br> Name: ".$row[1]."<br> E-mail: ".$row[2]
			."<br> Phone number: ".$row[3]."<br> Birth date: ".$row[5]." ".$row[6]."</p>";
			 echo "<hr>";
		}
	}

}

?>

<form method="POST">
	<P style="display:inline-block; font-size:1vw"> USER ID :</p>
	<input type="text" name="ID" style="font-size:1vw; width:3.4%"><br>
	<button style='padding:0.2%; width:4%; font-size:0.7vw' name="insert">INSERT</button>
	<button style='margin-left:0.2%; padding:0.2%;  width:4%; font-size:0.7vw' name="delete">DELETE</button>
</form>
<?php
		if($_GET["error"] == none)
			echo "<p style='font-size:1vw'>Data inserted</p>";
			echo "<p style='font-size:1vw'>PASSWORD: ".$_GET["pwd"]."</p>";
?>

<?php

	if(isset($_POST["insert"])){
		$ID=$_POST["ID"];
		$q2="SELECT * FROM requests WHERE usersID= $ID;";
		$result2= mysqli_query($conn,$q2); 

		if(mysqli_num_rows($result2)>0){
		while($row2=mysqli_fetch_array($result2)){

			echo "<br><p style='font-size:1vw'>ID: ".$row2[0]."<br> Name: ".$row2[1]."<br> E-mail: ".$row2[2]
			."<br> Phone number: ".$row2[3]."<br> Birth date: ".$row2[5]." ".$row2[6]."</p>";

			$username=$row2[1];
			$email=$row2[2];
			$phone=$row2[3];
			$day=$row2[4];
			$month=$row2[5];
			$year=$row2[6];
			}
		}

		$generate=rand(10000000,90000000);

		$q3 ="SELECT ID_NUMBER from requests where ID_NUMBER = $generate";
	
		$result3= mysqli_query($conn,$q3);
	
		if($result3){
			while($result3){
				$generate=rand(1000000,9000000);
				$q3 ="SELECT ID_NUMBER from requests where ID_NUMBER = $generate";
				$result3= mysqli_query($conn,$q3);
			}
		}
	
		$Pwd= strval($generate);
		$hashedPwd= password_hash($Pwd, PASSWORD_DEFAULT);

		echo "<p style='font-size:1vw'>".$Pwd."</p>";

		$q4="INSERT INTO instructors (userUid,usersPWD,email,phone,day,month,year) VALUES ('$username','$hashedPwd','$email','$phone','$day','$month','$year');";
		if(!mysqli_query($conn, $q4))
			echo "<p style='font-size:1vw'>Data were not inserted</p>";
		
			else{
				header("location:ADMIN.php?error=none&pwd=$Pwd");
			}

		$q5="DELETE FROM requests WHERE usersID= $ID;";
		mysqli_query($conn, $q5);
	}

	if(isset($_POST["delete"])){
		$ID=$_POST["ID"];
		$q6="DELETE FROM requests WHERE usersID= $ID;";
		if(!mysqli_query($conn, $q6))
			echo "<p style='font-size:1vw'>Row was not deleted</p>";
			
			else
			echo "<p style='font-size:1vw'>Row deleted</p>";
	}
?>

</body>
</html>
