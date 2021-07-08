<?php

if(isset($_POST["login"])){
    $username=$_POST["username"];
    $pwd=$_POST["password"];

    require_once "DBH_INC.php";
    require_once "INS_FUNCTIONS_INC.php";
    
    if (emptyInputlogin($username,$pwd) !== false) {
        header("location: ../INSTRUCTOR/INS_Log-in.php?error=emptyinput");
        exit();
    }

    loginUser($conn,$username,$pwd);
}

else{
    header("location: ../INSTRUCTOR/INS_Log-in.php");
    exit();
}