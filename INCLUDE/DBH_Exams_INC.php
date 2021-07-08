<?php

$host='localhost';
$adminUN='root';
$adminPW='bruhbruh';
$dbname='exams';

$connection_exam_DB = mysqli_connect($host,$adminUN,$adminPW,$dbname);

if(!$connection_exam_DB){
	die("Connection failed: " . mysqli_connect_error());	
}