<?php

include_once "DBH_Exams_INC.php";
include_once "DBH_INC.php";
include_once "FUNCTIONS_INC.php";

session_start();
$examname=$_SESSION["examname"];
$chk_post = $_POST['chk'];


    if (isset($_POST["enroll"])) {
            if(check_selection($chk_post) < 4){
                header("location: ../STUDENT/select.php?error=lessthan4");
                exit();
            }

        $topics = save_selection($chk_post);

        $R_ID = select_exam($conn,$examname);

            if(empty($R_ID)){
                header("location: ../STUDENT/select.php?error=ExamNotFound");
                exit();
            }

        $Questions_ARR = select_random_questions($connection_exam_DB,$R_ID,$count,$topics);
        $_SESSION["Questions_ARR"] = serialize($Questions_ARR);

        $_SESSION["access"]= true;
        header("location: ../STUDENT/exam.php");
    }

    else{
        header("location: ../index.php");
        exit();
    }