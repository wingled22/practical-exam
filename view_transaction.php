<?php 

include_once 'DB.php';
// print_r($_POST);
if(isset($_POST['submit'])){

	$priceof;
	$sql = "SELECT * from product WHERE p_id = :id";
	$rows = Database::query($sql, array(':id'=> $_POST['product']));
			foreach ($rows as $row) {
				$priceof = $row['p_price']* $_POST['quantity'];
			}

	$sql = "INSERT INTO transaction_details (td_product,td_quantity, td_price ,t_id) values ( :td_product,:td_quantity, :td_price, :tid)";
 	if(Database::query($sql, array(
 		':td_product' => $_POST['product'],
 		':td_quantity' => $_POST['quantity'],
 		':td_price' => $priceof,
 		':tid' => $_GET['tid']
 	))){
 		echo "<h4 style=\"text-align: center\">Added Successfully</h4>";
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
 		
		<a href="./transact.php"><button>back to home</button></a>
		<h3>Transaction of: <?php 
			$sql = "SELECT * from customer WHERE c_id = :cid";
			$rows = Database::query($sql, array(':cid'=> $_GET['cid']));
			foreach ($rows as $row) {
				echo $row['c_fname']." ".$row['c_lname'];
			}
		 ?></h3>

		<form action="" method="POST">
			
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
			</select>
			<input type="number" placeholder="quantity" name="quantity">

			<input type="submit" name="submit" value="submit">
		</form>
		<br>
		<table>
			<thead>
				<th>transaction detail id</th>
				<th>product</th>
				<th>quantity</th>
				<th>price</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * from transaction_details where t_id = :tid";
 					$rows = Database::query($sql, array(':tid'=>$_GET['tid']));
 					foreach ($rows as $row) {
 						?>
				<tr>
					<td><?php echo $row['td_id'];?></td>
					<td><?php echo $row['td_product'];?></td>
					<td><?php echo $row['td_quantity'];?></td>
					<td><?php echo $row['td_price'];?></td>
					<td>
						<!-- <a href="transaction_detail_update.php?tid=<?php  echo $_GET['tid']."&cid=".$_GET['cid']."&tdid=".$row['td_id'];?>">edit</a> -->
						<a href="transaction_detail_delete.php?tdid=<?php  echo $row['td_id']?>">delete</a>
					</td>
				</tr>

 						<?php
 					}
				 ?>

				
			</tbody>
		</table>
		<a href="./transaction_checkout.php?tid=<?php echo $_GET['tid']; ?>"><button>proceed to checkout</button></a>
	<?php
	?>
	</div>
</body>
</html>