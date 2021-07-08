<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/JSON');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "../configration/database_todo.php";
include_once "../modules/exams.php";

$database = new database();
    $db_connection=$database->connect();

$exams = new exams($db_connection);

$table_name = $_SESSION["usersUid"];

$result = $exams->getToDoList($table_name);
$number= $result->rowCount();

if($number > 0){
    $todo_list_ARR = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        array_push($todo_list_ARR,$exam);
    }

    echo json_encode($todo_list_ARR);
}

else{
    echo json_encode(   array("message" => "0")   );
}