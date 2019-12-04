<?php 
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else{ 
			include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$username = $_SESSION['username'];
		$query = "select * from user where username='$username'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<style type="text/css">
 		table{
 			width: 500px; 
 		}
 	</style>
 </head>
 <body>
 
	<table align="center" cellpadding="10px" style="background: #aabbcc; font-family: Arial; font-size: 20px">
		<caption>User Info</caption>

		<tr>
			<td><label for="firstName">First Name</label></td>
			<td>: 
			<?php echo $row['firstName']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="lastName">Last Name</label></td>
			<td>: 
			<?php echo $row['lastName']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="dob">Date Of Birth</label></td>
			<td>:
			<?php echo $row['dob']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="gender">Gender</label></td>
			<td>:
			<?php echo $row['gender']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="address">Address</label></td>
			<td>:
			<?php echo $row['address']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="postCode">Post Code</label></td>
			<td>:
			<?php echo $row['postCode']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="country">Country</label></td>
			<td>:
			<?php echo $row['country']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="email">Email </label> </td>
			<td>:
				<?php echo $row['email']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="phone">Phone</label></td>
			<td>:
				<?php echo $row['phone']; ?>
			</td>
		</tr>

		<tr>
			<td><label for="username">Username </label> </td>
			<td>:
				<?php echo $row['username']; ?>
			</td>

		</tr>

		<tr> 
			<td colspan="2" align="center">
			<form method="get" action="updateUser.php">
				<input type="hidden" name="username" value="<?php echo $row['username']; ?>">
				<input type="submit" value="edit" />
			</form>
			</td>
		</tr>

	</table>
</body>
</html>

<?php } ?>
