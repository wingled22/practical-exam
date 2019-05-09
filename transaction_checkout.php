<?php 

include_once 'DB.php';
// print_r($_POST);

	$total;
	$sql = "SELECT * from transaction_details where purchased = :purch AND t_id = :tid ";
		$rows = Database::query($sql, array(':purch' => 0 ,':tid' => $_GET['tid']));
		foreach ($rows as $row) {
			var_dump($row);

			$total = 0;

			$sql = "SELECT * from product where p_id = :id";
			$rows2 = Database::query($sql, array(':id' => $row['td_product']));
			foreach ($rows2 as $row2) {
				$total = $row2['p_stocks'] - $row['td_quantity'];
				echo $total."\n";
			
				$sql = "UPDATE product SET p_stocks= :pstocks WHERE p_id = :id";
		 		Database::query($sql,  array(
		 			':pstocks' => $total, 
		 			':id' => $row['td_product']
		 		));

				echo $total."\n";

			}


		}

	$sql = "UPDATE transaction_details SET purchased = 1 WHERE t_id = :id";
		 	Database::query($sql,  array(
		 		':id' => $_GET['tid']
		 	));
header('location:./transact.php');
