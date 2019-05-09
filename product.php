<?php 

include_once 'DB.php';
// print_r($_POST);
if(isset($_POST['submit'])){

	$sql = "INSERT INTO product (p_name, p_category, p_stocks, p_price) values ( :pname, :pcategory, :pstocks, :pprice)";
 	if(Database::query($sql, array(
 		':pname' => $_POST['pname'],
 		':pcategory' => $_POST['pcategory'],
 		':pstocks' => $_POST['pstocks'], 
 		':pprice' => $_POST['pprice']
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
		<a href="./"><button>back to home</button></a>
		<h1>Products</h1>

		<form action="" method="POST">
			<input type="text" placeholder="name" name="pname">
			<input type="number" placeholder="stocks" name="pstocks">
			<select name="pcategory">
				<option value="condiments">condiments</option>
				<option value="canned goods">canned goods</option>
				<option value="bread and pastry">bread and pastry</option>
				<option value="beverages">beverages</option>
				<option value="biscuits">biscuits</option>
				<option value="perishable">perishable</option>
				<option value="dry goods">dry goods</option>
			</select>
			<input type="number" placeholder="price" name="pprice">

			<input type="submit" name="submit" value="submit">
		</form>
		<br>
		<table>
			<thead>
				<th>id</th>
				<th>name</th>
				<th>category</th>
				<th>price</th>
				<th>stocks</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * from product";
 					$rows = Database::query($sql);
 					foreach ($rows as $row) {
 						?>
				<tr>
					<td><?php echo $row['p_id'];?></td>
					<td><?php echo $row['p_name'];?></td>
					<td><?php echo $row['p_category'];?></td>
					<td><?php echo $row['p_price'];?></td>
					<td><?php echo $row['p_stocks'];?></td>
					<td>
						<a href="product_update.php?id=<?php  echo $row['p_id']?>">edit</a>
						<a href="product_delete.php?id=<?php  echo $row['p_id']?>">delete</a>
					</td>
				</tr>

 						<?php
 					}
				 ?>

				
			</tbody>
		</table>
	</div>
</body>
</html>