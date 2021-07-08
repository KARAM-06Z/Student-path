<?php
require_once "../INCLUDE/DBH_exams_INC.php";

session_start();

if ($_SESSION["userUid"]==NULL){
	header("location: INS_log-in.php");
	exit();
}

if(empty($_SESSION["examname"]) == false)
    $_SESSION["examname"]=null;
$_SESSION["access"]=false;

$conn2 = mysqli_connect($host,$adminUN,$adminPW,"sp");
if(!$conn2){
	die("Connection failed: " . mysqli_connect_error());	
}
?>

<?php 

    require_once "../INCLUDE/DBH_Exams_INC.php";
    require_once "../INCLUDE/INS_FUNCTIONS_INC.php";

        if(isset($_POST['uplaod'])){
            $examname=$_POST["examname"];
            $filename=$_FILES['file']['name'];
			$fileTmpname=$_FILES['file']['tmp_name'];
            $fileextension= pathinfo($filename,PATHINFO_EXTENSION);
            $allowedtype= array('csv');

            if(!in_array($fileextension,$allowedtype)){
                header("location:INS_MAIN.php?error=noncsv");
            }

            else{

				if(empty($examname)){
					header("location: INS_MAIN.php?error=empty_input");
					exit();
				}

				else if (!preg_match("/^[a-zA-Z0-9 .]*$/", $examname)) {
					header("location: INS_MAIN.php?error=invalid_name");
					exit();
				}

				else if(strlen($examname) > 50 || strlen($examname) < 4){
					header("location: INS_MAIN.php?error=too_long_or_short");
					exit();
				}

				$q="SELECT exam_name FROM ins_exams WHERE exam_name='$examname';";
				$checkname= mysqli_query($conn2,$q);
				while($row=mysqli_fetch_assoc($checkname)){
					if($row["exam_name"] == $examname)
						header("location:INS_MAIN.php?error=nametaken");
						exit();
				}

                $handle= fopen($fileTmpname,'r');
				$counter=0;
				
				$R_ID= rand(10000000,90000000);

                $table="CREATE TABLE E$R_ID
                (ID INT(3) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                num INT(2) NOT NULL,
                question varchar(1000) NOT NULL,
                A varchar(1000) NOT NULL,
                B varchar(1000) NOT NULL,
                C varchar(1000) NOT NULL,
                D varchar(1000) NOT NULL,
                correct varchar(1000) NOT NULL,
				type varchar(10) NOT NULL,
				topic_name varchar(100) NOT NULL,
                topic varchar(10) NOT NULL);";

                $connection_exam_DB->query($table);

                for($i=1 ; $i<=10 ; $i++){

                    while(($data= fgetcsv($handle,1000000,',')) !== false){

                        $question= $data[1];
                        $A= $data[2];
                        $B= $data[3];
                        $C= $data[4];
                        $D= $data[5];
						$correct= $data[6];
						$topic_name= $data[7];
						$type= $data[8];

                        $q2 = "INSERT INTO E$R_ID (num,question,A,B,C,D,correct,type,topic,topic_name) 
						VALUES ('$counter','$question','$A','$B','$C','$D','$correct','$type','topic$i','$topic_name');";
						
                        $execute= mysqli_query($connection_exam_DB,$q2);

                        $counter++;
                        if($counter%10 == 0){
                            $counter=0;
                            break;
                        }
                    }
				}
				
				$UN=$_SESSION['userUid'];
				$q3= "INSERT INTO ins_exams (owner_name,exam_name,exam_R_ID) VALUES ('$UN','$examname',$R_ID);";

					$execute2= mysqli_query($conn2,$q3);
					$UN=null;

                if(replace_lessthan($connection_exam_DB,$R_ID) !== false){
                    header("location:INS_MAIN.php?error=failure");
                }

                if(!$execute){
                    header("location:INS_MAIN.php?error=failure");
				}
				
				if(!$execute2){
                    header("location:INS_MAIN.php?error=failure");
                }

                else
                    header("location:INS_MAIN.php?error=success");
            }
        }
    ?>

<html>
    <head>
		<title>Instructor - STUDENT PATH</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/INS_MAIN.css">
		<link rel="stylesheet" href="../CSS/_header_style.css">
		<link rel="stylesheet" href="../CSS/_footer_style.css">
    </head>

	<body>
		<div class="main_view">

			<?php 
				include_once "../INCLUDE/_header.php";
			?>

			<div class="content_container_outer">
				<div class="content_container_inner">
					<div class="content_navigator_container">
						<div class="content_navigation_header">
							Navigation
						</div>
						<button type="button" class="content_navigation_button" value="exams"><img src="../CSS/exam.png"> My exams</button>
						<button type="button" class="content_navigation_button" value="upload"><img src="../CSS/upload.png"> Upload exam</button>
					</div>


					<div class="content_container">
						<div class="available_exams_container">
							<div class="my_exams_header">
								<div class="my_exams_text">My exams</div>
							</div>

							<div class="my_exams_container">
								<form action="INS_view.php" method='POST'>
									<?php 
									$UN=$_SESSION['userUid'];
										$conn2 = mysqli_connect($host,$adminUN,$adminPW,"sp");
											if(!$conn2){
												die("Connection failed: " . mysqli_connect_error());	
											}
												$q="SELECT exam_name,likes,unlikes FROM ins_exams where owner_name='$UN';";
												$result=mysqli_query($conn2, $q);
													while($row=mysqli_fetch_assoc($result)){?>
													<div class="exam">
														<div class="exam_upper">
															<input type='submit' class='exam_input' name='examname' value="<?php echo $row["exam_name"]; ?>">
														</div>

														<div class="exam_lower">
															<div class='ratio_span'>Rating: 
																<span> 
																	<?php
																		if($row["likes"] != 0 || $row["unlikes"] != 0){
																			$ratio_value = $row["likes"] / ($row["likes"] + $row["unlikes"]) * 100;
																			$ratio_value_rounded= round($ratio_value , 1) ;
																			$ratio_value_text = $ratio_value_rounded."%";
																			echo $ratio_value_text;
																		}

																		else{
																			echo "Not rated yet";
																		}
																	?>
																</span>
															</div>
														</div>
													</div>
													<?php
													}
									$UN=NULL;
									?>
								</form>
							</div>
						</div>

						<div class="uplaod_exam_container">
							<div class="upload_exam_header">
								<div class="upload_exam_text">Upload exam</div>
							</div>

							<div class="upload_section">
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="instruction_container">
										<ul>
											<li class="instruction">Select only CSV files</li>
											<li class="instruction">Exam name is required</li>
											<li class="instruction">Exam name must not contain any special characters</li>
											<li class="instruction">Exam name must not be longer than 50 character or less than 4</li>
										</ul>
									</div>

									<div class="browse_button_container">
										<input type="file" name="file" class="browse_button" required>
									</div>

									<div class="filename_input_container">
										<input type="text" name="examname" placeholder="Exam name..." autocomplete="off">
									</div>

									<div class="submit_button_container">
										<button type="submit" name="uplaod" class="submit_button">UPLAOD</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php 
				include_once "../INCLUDE/_Footer.php";
			?>

		</div>

		<script>

			document.addEventListener("DOMContentLoaded", function() { 
				let set_nav_button = document.querySelectorAll(".content_navigation_button");
					set_nav_button[0].style.backgroundColor="#14213D";
					set_nav_button[0].style.color="#ffffff";
			});


			const header_navbar_button = document.querySelector(".header_navigation_container_button");
			const header_navbar = document.querySelector(".header_navigation_container");

				document.addEventListener("click" , function(event){
					let view = header_navbar_button.getAttribute("view");

					if(event.target.closest(".header_navigation_container_button")){
						if(view === "false"){
						header_navbar.style.display="block";
						header_navbar_button.setAttribute("view" , "true");
						}
					}

					if(event.target.closest(".header_navigation_container"))
						return;

					else if(!event.target.closest(".header_navigation_container") && view === "true"){
						header_navbar.style.display="none";
						header_navbar_button.setAttribute("view" , "false");
					}
				});


			const navigation_button = document.querySelectorAll(".content_navigation_button");
				for(let i =0 ; i < navigation_button.length ; ++i){
					navigation_button[i].addEventListener("click", function(){
						let button_value = navigation_button[i].getAttribute("value");

						for (let j =0 ; j < navigation_button.length ; ++j){
							navigation_button[j].style.backgroundColor = "#f7f7f7";
							navigation_button[j].style.color = "#535353";
						}

						if(button_value === "exams"){
							navigation_button[i].style.backgroundColor ="#14213D";
							navigation_button[i].style.color ="#ffffff";
								
							document.querySelector(".uplaod_exam_container").style.display="none";
							document.querySelector(".available_exams_container").style.display="block";
						}

						if(button_value === "upload"){
							navigation_button[i].style.backgroundColor ="#14213D";
							navigation_button[i].style.color ="#ffffff";
							
							document.querySelector(".available_exams_container").style.display="none";
							document.querySelector(".uplaod_exam_container").style.display="block";
						}
					});
				}
		</script>
	</body>
</html>