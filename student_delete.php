<?php 
require_once 'DB.php';



	$sql = "DELETE from student WHERE s_id = :id";
 	if(Database::query($sql, array(':id' => $_GET['id']))){
 		header('location: ./students.php');
 	}else{
 		echo "error";
 	}
