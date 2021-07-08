<?php 
session_start();
require_once "../INCLUDE/DBH_Exams_INC.php";
include_once "../INCLUDE/classes.php";

if ($_SESSION["usersUid"]==NULL){
	header("location: Log-in.php");
	exit();
}

if($_SESSION["access"] == false){
    header("location:Student_MAIN.php");
    exit();}

$Questions_ARR = unserialize($_SESSION["Questions_ARR"]);
$selected_questions = array();
?>

<html>
<head>
    <title>Exam - STUDENT PATH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/examStyle.CSS">
    <link rel="stylesheet" href="../CSS/_footer_style.css">
	<link rel="stylesheet" href="../CSS/_header_style.css">
</head>

<body>
<div class="main_view">

    <?php
        include_once "../INCLUDE/_header.php";
    ?>

        <div class="exam_container_outer">
            <div class="exam_container_inner">
                <div class="examname_container">
                    <div class='examname'><?php echo $_SESSION["examname"]; ?></div>
                </div>

                <form action="display_mark.php" method="POST">

                <?php
                    for($i=0 ; $i<count($Questions_ARR) ; $i++){
                ?>
                    
                    <div class='exam_question_and_answers_container'>
                        <div class="question_container">
                            <div class="question_numbering">
                                <?php echo($Questions_ARR[$i]->number+1)."- "; ?>
                            </div>
                            
                            <div class='question'>
                                <?php print nl2br($Questions_ARR[$i]->question);?>
                            </div>
                        </div>

                        <div class="hr_line"></div>

                        <?php
                        if($Questions_ARR[$i]->type === "Multiple"){
                        ?>
                            <div class="answer_container">
                                <label class='answer_radio_label'>
                                    <input class="answer_radio_button" type='radio' name='<?php echo "answer".$i;?>' value='<?php echo $Questions_ARR[$i]->answer_A;?>'>

                                    <div class="radio_edited_outer">
                                        <div class="radio_edited_inner">
                                            <div class="selected"></div>
                                        </div>
                                    </div>

                                    <div class="answer"><?php print nl2br($Questions_ARR[$i]->answer_A);?></div>
                                </label>
                                
                                <label class='answer_radio_label'>
                                    <input class="answer_radio_button" type='radio' name='<?php echo "answer".$i;?>' value='<?php echo $Questions_ARR[$i]->answer_B;?>'>

                                    <div class="radio_edited_outer">
                                        <div class="radio_edited_inner">
                                            <div class="selected"></div>
                                        </div>
                                    </div>

                                    <div class="answer"><?php print nl2br($Questions_ARR[$i]->answer_B);?></div>
                                </label>

                                <label class='answer_radio_label'>
                                    <input class="answer_radio_button" type='radio' name='<?php echo "answer".$i;?>' value='<?php echo $Questions_ARR[$i]->answer_C;?>'>

                                    <div class="radio_edited_outer">
                                        <div class="radio_edited_inner">
                                            <div class="selected"></div>
                                        </div>
                                    </div>

                                    <div class="answer"><?php print nl2br($Questions_ARR[$i]->answer_C);?></div>
                                </label>
                                
                                <label class='answer_radio_label'>
                                    <input class="answer_radio_button" type='radio' name="<?php echo "answer".$i;?>" value='<?php echo $Questions_ARR[$i]->answer_D;?>'>

                                    <div class="radio_edited_outer">
                                        <div class="radio_edited_inner">
                                            <div class="selected"></div>
                                        </div>
                                    </div>

                                    <div class="answer"><?php print nl2br($Questions_ARR[$i]->answer_D);?></div>
                                </label>
                            </div>
                            <?php
                                }
                                else if($Questions_ARR[$i]->type === "Fill"){
                            ?>
                            <div class="answer_container">
                                <textarea class="answer_text_area" name="<?php echo "answer".$i; ?>" placeholder="Answer" rows="1" column="300"></textarea>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php

                    array_push($selected_questions,$Questions_ARR[$i]->ID);
                    }
                    
                    $_SESSION["selected_questions"]= $selected_questions;
                    ?>

                    <div class="finish_button_container">
                        <button type="submit" name="Finish" class="finish_button">Finish Test</button>
                    </div>
                </form>
            </div>
        </div>
    <?php
        include_once "../INCLUDE/_footer.php";
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
</script>
</body>
<html>
