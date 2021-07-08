<?php

include_once "DBH_Exams_INC.php";
include_once "DBH_INC.php";
include_once "FUNCTIONS_INC.php";

session_start();

if(isset($_POST["examname"])){
    $examname = $_POST["examname"];

    $R_ID = select_exam($conn,$examname);

        if(empty($R_ID)){
            header("location: ../STUDENT/STUDENT_MAIN.php?error=ExamNotFound");
            exit();
        }
        
    $selected_topics = get_topics($connection_exam_DB,$R_ID);

    $_SESSION["selected_topics"]= serialize($selected_topics);
    $_SESSION["examname"]= $examname;
    header("location: ../STUDENT/select.php");
}

else{
    header("location: ../index.php");
    exit();
}