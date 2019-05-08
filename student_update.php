<?php 
require_once 'DB.php';

if(isset($_POST['submit'])){

	$sql = "UPDATE student SET s_fname = :firstname , s_lname = :lastname , s_course = :course WHERE s_id = :id";
 	if(Database::query($sql, array(':firstname'=>$_POST['firstname'], ':lastname'=>$_POST['lastname'], ':course'=>$_POST['course'], ':id' => $_GET['id']))){
 		header('location: ./students.php');
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
			$sql = "SELECT * from student WHERE s_id = :id";
 					$rows = Database::query($sql, array(':id'=>$_GET['id']));
 					foreach ($rows as $row) {
			 ?>
			<input type="text" name="firstname" value="<?php echo $row['s_fname']; ?>">
			<input type="text" name="lastname" value="<?php echo $row['s_lname']; ?>">
			<select name="course" >
				<option value="BSIT">BSIT</option>
				<option value="BSED">BSED</option>
				<option value="BEED">BEED</option>
				<option value="BSCrim">BSCrim</option>
			</select>
		<?php } ?>
			<input type="submit" name="submit" value="submit">
		</form>



	</div>
</body>
</html>