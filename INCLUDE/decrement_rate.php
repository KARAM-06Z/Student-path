<?php

require_once "DBH_INC.php";
$examname=$_POST["examname"];

    $q="SELECT unlikes FROM ins_exams WHERE exam_name = '$examname';";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$q);

        mysqli_stmt_execute($stmt);
        
        $result=mysqli_stmt_get_result($stmt);
        $data=mysqli_fetch_assoc($result);
        
        $unlikes = $data["unlikes"];

        mysqli_stmt_close($stmt);

    $q="UPDATE ins_exams SET unlikes=$unlikes+1 WHERE exam_name = '$examname';";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$q);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

header("location: ../STUDENT/display_mark.php?rate=down");