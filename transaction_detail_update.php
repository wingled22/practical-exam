<?php 
require_once 'DB.php';

if(isset($_POST['submit'])){

	$sql = "UPDATE customer SET c_fname = :cfname, c_lname = :clname, c_age = :cage, c_address = :caddress WHERE c_id = :id";
 	if(Database::query($sql,  array(
 		':cfname' => $_POST['cfname'],
 		':clname' => $_POST['clname'],
 		':cage' => $_POST['cage'], 
 		':caddress' => $_POST['caddress'],
 		':id' => $_GET['id']
 	))){
 		header('location: ./customer.php');
 	}else{
 		echo "error";
 	}
}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<div id="container">
		<form action="" method="POST">
			<?php 
			$sql = "SELECT * from transaction_details WHERE td_id = :id";
 					$rows = Database::query($sql, array(':id'=>$_GET['tdid']));
 					foreach ($rows as $row) {
			 ?>
			 <select name="product">
				<?php 
					$sql = "SELECT * from product";
 					$rows = Database::query($sql);
 					foreach ($rows as $row) {
 						?>
				<option value="<?php echo $row['p_id'];?>"><?php echo $row['p_name'];?></option>
 						<?php
 					}
				 ?>
			<input type="text" placeholder="last name" name="clname"	value="<?php echo $row['c_lname']; ?>">
			<input type="text" placeholder="age" name="cage"	value="<?php echo $row['c_age']; ?>">
			<input type="text" placeholder="address" name="caddress"	value="<?php echo $row['c_address']; ?>">
		<?php } ?>
			<input type="submit" name="submit" value="submit">
		</form>



	</div>
</body>
</html>