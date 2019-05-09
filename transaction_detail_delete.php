<?php 
require_once 'DB.php';



	$sql = "DELETE from transaction_details WHERE td_id = :id";
 	if(Database::query($sql, array(':id' => $_GET['tdid']))){
 		// header("location:javascript://history.go(-1)");
 		header('Location: ' . $_SERVER['HTTP_REFERER']);
 	}else{
 		echo "error";
 	}
