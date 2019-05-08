<?php 

include_once 'DB.php';

if(isset($_POST['submit'])){

	$sql = "INSERT INTO student (s_fname, s_lname, s_course) values ( :fname, :lname, :course)";
 	if(Database::query($sql, array(':fname'=>$_POST['firstname'], ':lname'=>$_POST['lastname'], ':course'=>$_POST['course']))){
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

		<form action="" method="POST">
			<input type="text" name="firstname">
			<input type="text" name="lastname">
			<select name="course">
				<option value="BSIT">BSIT</option>
				<option value="BSED">BSED</option>
				<option value="BEED">BEED</option>
				<option value="BSCrim">BSCrim</option>
			</select>
			<input type="submit" name="submit" value="submit">
		</form>
		<br>
		<table>
			<thead>
				<th>head</th>
				<th>head</th>
				<th>head</th>
				<th>head</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * from student";
 					$rows = Database::query($sql);
 					foreach ($rows as $row) {
 						?>
				<tr>
					<td><?php echo $row['s_id'];?></td>
					<td><?php echo $row['s_fname'];?></td>
					<td><?php echo $row['s_lname'];?></td>
					<td><?php echo $row['s_course'];?></td>
					<td>
						<a href="student_update.php?id=<?php  echo $row['s_id']?>">edit</a>
						<a href="student_delete.php?id=<?php  echo $row['s_id']?>">delete</a>
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