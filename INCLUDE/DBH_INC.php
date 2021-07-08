<?php

$host='localhost';
$adminUN='root';
$adminPW='bruhbruh';
$dbname='sp';

$conn = mysqli_connect($host,$adminUN,$adminPW,$dbname);

if(!$conn){
	die("Connection failed: " . mysqli_connect_error());	
}