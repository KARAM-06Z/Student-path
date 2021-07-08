<?php 
session_start();
require_once "../INCLUDE/DBH_Exams_INC.php";

if ($_SESSION["userUid"]==NULL){
	header("location: INS_log-in.php");
	exit();
}

if (!isset($_POST["examname"])) {
    header("location:INS_MAIN.php");
    exit();
}
?>

<html>
<head>
    <title>View exam - STUDENT PATH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/INS_viewStyle.css">
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
                <div class="examname_container">
                    <div class='examname'><?php echo $_POST['examname']; ?></div>
                </div>

                    <?php 
                        $examname=$_POST['examname'];
                        $x=1;
                        $i=0;

                        $conn2 = mysqli_connect($host,$adminUN,$adminPW,"sp");
                            if(!$conn2){
                                die("Connection failed: " . mysqli_connect_error());	
                            }
                            
                        $q="SELECT exam_R_ID FROM ins_exams where exam_name='$examname'";
                        $result= mysqli_query($conn2,$q); 
                        $row=mysqli_fetch_assoc($result);
                        $R_ID= $row["exam_R_ID"];


                        $q="SELECT question,A,B,C,D,correct,ID,topic_name from E$R_ID;";
                        $result= mysqli_query($connection_exam_DB,$q); 

                        while($row=mysqli_fetch_assoc($result)){
                            
                            if($x%10 == 1){
                                $i++;
                                echo "<div class='topic'>".$row['topic_name']."</div>";
                            }?>
                                
                            <div class="exam_question_and_answers_container">
                                <div class="question_container">
                                    <div class="question_numbering">
                                        <?php echo($row['ID'])."- "; ?>
                                    </div>
                                    
                                    <div class='question'>
                                        <?php print nl2br($row['question']);?>
                                    </div>

                                    <!-- <div class="question_edit_button_container">
                                        <button class="question_edit_button">Edit</button>
                                    </div> -->
                                </div>

                                <div class="hr_line"></div>

                                <div class='answers_container'>
                                    <div class="answer_container">
                                        <div class="answer"><?php print nl2br("<div class='answer_order'>A) </div> <div>".$row['A']."</div>");?></div>
                                    </div>

                                    <div class="answer_container">
                                        <div class="answer"><?php print nl2br("<span class='answer_order'>B) </span> <div>".$row['B']."</div>");?></div>
                                    </div>

                                    <div class="answer_container">
                                        <div class="answer"><?php print nl2br("<span class='answer_order'>C) </span> <div>".$row['C']."</div>");?></div>
                                    </div>

                                    <div class="answer_container">
                                        <div class="answer"><?php print nl2br("<span class='answer_order'>D) </span> <div>".$row['D']."</div>");?></div>
                                    </div>

                                    <div class="correct_answer_container">
                                        <div class="correct_answer"><?php print nl2br("Correct answer: <span>".$row['correct']."</span>");?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $x++;
                        }
                    ?>
            </div>
        </div>
    <?php 
        include_once "../INCLUDE/_Footer.php";
    ?>
    </div>
    <script>
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
    </script>
</body>
<html>
