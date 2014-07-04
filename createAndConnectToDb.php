<?php
$con = mysqli_connect('localhost','root','');
if(!$con){
	echo 'Failed to connect to MySQL '.mysqli_connect_error();
}
else echo 'Success\n';

/*
$db = "CREATE DATABASE PACE";
if(!mysqli_query($con,$db)) {
	echo 'Database PACE not created : '.mysqli_error($con);
}
else echo 'Database PACE created successfully\n';
*/

$db = mysqli_select_db($con,"PACE");

$db = "CREATE TABLE AITS (Subject CHAR(30), Difficulty CHAR (30), QuestionType Char(30), Topic char(100), Question text, Answer text, DetailedAnswer text)";
if(mysqli_query($con,$db)) {
	echo 'Table AITS created successfully<br>';
}
else echo 'Error creating table "AITS" '.mysqli_error($con);
mysqli_close($con);
?>