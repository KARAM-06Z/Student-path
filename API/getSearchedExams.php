<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/JSON');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "../configration/database_SP.php";
include_once "../modules/exams.php";

$database = new database();
    $db_connection = $database->connect();

$exams = new exams($db_connection);

$data = json_decode(file_get_contents("php://input"));
$exams->searched_exam_name = $data->search_value;

$result = $exams->getSearchedExams();
$number = $result->rowCount();

if($number > 0){
    $searched_exams_ARR = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $searched_exams_items_ARR= array(
            'owner_name' => $owner_name,
            'exam_name' => $exam_name,
            'likes' => $likes,
            'unlikes' => $unlikes
        ); 

        array_push($searched_exams_ARR , $searched_exams_items_ARR);
    }
    echo json_encode($searched_exams_ARR);
}

else{
    echo json_encode( array("message" => "no matched results found") );
}
