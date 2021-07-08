<?php
session_start();
require_once "../INCLUDE/DBH_Exams_INC.php";
require_once "../INCLUDE/DBH_INC.php";

if ($_SESSION["usersUid"]==NULL){
	header("location: Log-in.php");
	exit();
}

if(!isset($_POST["Finish"]) && !isset($_GET["rate"])){
    header("location: Student_MAIN.php");
    exit();
}

if(isset($_POST["Finish"])){
    for($j=0 ; $j<=20 ; $j++){
        $_SESSION["answer$j"] = $_POST["answer$j"];
    }
}

$_SESSION["access"]=false;
$examname= $_SESSION["examname"];
?>

<html>

<head>
    <title>Review - STUDENT PATH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/markStyle.css">
    <link rel="stylesheet" href="../CSS/_footer_style.css">
	<link rel="stylesheet" href="../CSS/_header_style.css">
</head>

<body>
    <div class="main_view">

        <?php 
            include_once "../INCLUDE/_header.php";
        ?>

        <div class="exam_container_outer">

        <?php
            if(isset($_GET["rate"])){
                echo "<div class='rate_box' style='display:none'>";
            }

            elseif(!isset($_GET["rate"])){
                echo "<div class='rate_box'>";
            }
        ?>
                <div class="rate_box_top">
                    <div class="rate_text">
                        <span>Did you find this exam any good?</span>
                    </div>
                    <div class="close_icon_container">
                        <button type="button" class="button_container"><img src="../CSS/close.png" class="close_icon"></button>
                    </div>
                </div>

                <div class="rate_box_bottom">
                    <div class="rate_YES">
                        <form action="../INCLUDE/increment_rate.php" method="POST">
                            <?php
                            echo "<button type='submit' name='examname' value='$examname' class='rate_button_YES'>";
                            echo "<input type='hidden' name='rate_value' value='".$ratings["likes"]."'>";
                            echo "Yes</button>";
                            ?>
                        </form>
                    </div>

                    <div class="rate_NO">
                        <form action="../INCLUDE/decrement_rate.php" method="POST">
                            <?php
                            echo "<button button type='submit' name='examname' value='$examname' class='rate_button_NO'>";
                            echo "<input type='hidden' name='rate_value' value='".$ratings["unlikes"]."'>";
                            echo "No</button>";
                            ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="exam_container_inner">
                <?php
                    $answers= array();
                    $mark=0;

                    for($j=0 ; $j<=20 ; $j++){
                        array_push($answers,$_SESSION["answer$j"]);
                    }

                    $selected_questions=$_SESSION['selected_questions'];

                        $q="SELECT exam_R_ID FROM ins_exams where exam_name='$examname'";
                            $result= mysqli_query($conn,$q); 
                                $row=mysqli_fetch_assoc($result);
                                    $R_ID= $row["exam_R_ID"];

                    for($i=0; $i<count($selected_questions) ; $i++){
                    $q="SELECT question,A,B,C,D,correct,ID from e$R_ID where ID=$selected_questions[$i];";
                    $result= mysqli_query($connection_exam_DB,$q); 
                        while($row=mysqli_fetch_assoc($result)){
                            $answer_transformed = preg_replace("/[\r\n]*/","",$answers[$i]);
                            $correct_transformed= preg_replace("/[\r\n]*/","",$row["correct"]);
                            
                            if(strcmp($answer_transformed,$correct_transformed)== 0)
                                $mark++;     
                        }
                    }
                    ?>


                <div class="examname_container">
                    <div class='examname'><?php echo $_SESSION["examname"]; ?></div>
                    <div class='mark'><?php echo $mark."/20";?></div>
                </div>

                    <!-- <input type="checkbox" class="viewanswers" id="toggle" onclick="checkboxtext()"><label id="label" for="toggle" class="viewanswerslabel">View correct answers
                    <img src="../CSS/Arrow.png"></label> -->

                    <?php

                    for($i=0; $i<count($selected_questions) ; $i++){
                    $q="SELECT question,A,B,C,D,correct,ID from E$R_ID where ID=$selected_questions[$i];";
                    $result= mysqli_query($connection_exam_DB,$q); 
                        while($row=mysqli_fetch_assoc($result)){
                            $answer_transformed = preg_replace("/[\r\n]*/","",$answers[$i]);
                            $correct_transformed= preg_replace("/[\r\n]*/","",$row["correct"]);
                            
                            if(strcmp($answer_transformed,$correct_transformed)== 0)
                                echo "<div class='exam_question_and_answers_container' style='background-color:#ffe4cc'>";

                                else if($answer_transformed != $correct_transformed && $answer_transformed != NULL)
                                    echo "<div class='exam_question_and_answers_container'>";

                                    else
                                        echo "<div class='exam_question_and_answers_container'>";

                                echo "<div class='question_container'>";
                                    echo "<div class='question_numbering'>";
                                        echo "<div>".($i+1)."- </div>";
                                    echo "</div>";  

                                    print nl2br("<div class='question'>".$row["question"]."</div>");
                                echo "</div>";

                                echo "<div class='hr_line'></div>";

                                echo "<div class='answer_container'>";

                                print nl2br("<div class='correct_answer'>Correct answer: ".$row["correct"]."</div>");
                                    
                                    if($answer_transformed == $correct_transformed){
                                        print nl2br("<div class='student_answer'>Your answer: ".$answers[$i]."</div>");}

                                        else if($answer_transformed != $correct_transformed && $answer_transformed != NULL){
                                            print nl2br("<div class='student_answer'>Your answer: ".$answers[$i]."</div>");}

                                            else
                                            echo "<div class='student_answer'>Your answer: You did not select an answer</div>";
                                            
                                echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>

                <div class="finish_button_container">
                    <button class="finish_button"><a href="Student_MAIN.php">Back to student page</a></button>
                </div>
            </div>
        </div>

        <?php 
            include_once "../INCLUDE/_Footer.php";
        ?>

    </div>

    <script type="text/javascript">
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

            const close_rate_box = document.querySelector(".close_icon_container");
            const rate_box = document.querySelector(".rate_box");
                close_rate_box.addEventListener("click" , function(){
                    rate_box.style.left="-100%";

                    setTimeout(function(){
                        rate_box.style.display="none";
                    },300);
                });
    </script>
</body>
</html>