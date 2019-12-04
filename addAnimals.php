<?php  
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add new Animal</title>
</head>
<body>
 	<?php include_once('header.php');?>
		<form action="addAnimal.php" method="post" enctype="multipart/form-data">
			<table align="center" cellpadding="10px" style="background: #00aa34; font-family: Arial; font-size: 25px; font-style: italic;">
				<caption>New Animal</caption>
				<tr>
					<td><label for="animalName">Animal Name</label></td>
					<td>:<input type="text" id="animalName" name="animalName" /></td>
				</tr>
				<tr>
					<td><label for="sectionName">Section Name</label></td>
					<td>:<input type="text" id="sectionName" name="sectionName" /></td>
				</tr>
				<tr>
					<td><label for="about">About The Animal</label></td>
					<td>:<textarea rows="5" cols="25" id="about" name="about">
					</textarea>
					</td>
				</tr>
				<tr>
					<td><label for="pic">Image </label></td>
					<td>:<input type="file" id="pic" name="pic" /></td>
				</tr>
				
				<tr>
					<td><label for="howMuch">Amount of the Animal </label> </td>
					<td>: <input type="uname" id="howMuch" name="howMuch" /> </td>

				</tr>
				<tr> 
					<td colspan="2" align="center"><input type="submit" value="Add Animal" /></td>
				</tr>


			</table>
		</form>
</body>
</html>

<?php } ?>