<?php

session_start();
require_once "DBH_ToDo_INC.php";

$examname= $_POST["examname"];
$user= $_SESSION["usersUid"];

    $q="INSERT INTO $user (exam) VALUES (?);";
        $stmt= mysqli_stmt_init($conn_todo);
            mysqli_stmt_prepare($stmt,$q);
            mysqli_stmt_bind_param($stmt, "s", $examname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

header("location: ../STUDENT/Student_MAIN.php");