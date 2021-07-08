<?php

$host='localhost';
$adminUN='root';
$adminPW='bruhbruh';
$dbname='todo';

$conn_todo = mysqli_connect($host,$adminUN,$adminPW,$dbname);

if(!$conn_todo){
	die("Connection failed: " . mysqli_connect_error());	
}