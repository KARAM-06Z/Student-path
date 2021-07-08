<?php

class exams{
    private $connection;
    private $instructor_exams_table = "ins_exams";
    public $searched_exam_name;

    public function __construct($db_connection){
        $this->connection = $db_connection;
    }

    public function getAllExams(){
        $query = "SELECT owner_name,exam_name,likes,unlikes FROM ".$this->instructor_exams_table.";";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getSearchedExams(){
        $query = "SELECT owner_name,exam_name,likes,unlikes FROM ".$this->instructor_exams_table." WHERE exam_name LIKE ?;";
        
        $stmt = $this->connection->prepare($query);
            $LIKE_expression = "%".$this->searched_exam_name."%" ;
        $stmt->bindParam(1,$LIKE_expression);
        $stmt->execute();
        
        return $stmt;
    }

    public function getToDoList($table_name){
        $query = "SELECT exam FROM ".$table_name.";";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}