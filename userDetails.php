<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{ 
			include_once('header.php');
		echo "<a href='userRegistrationForm.php' target='_parent'>Go Back to Home</a>";
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query="select * from user";
		$result=mysqli_query($con,$query);
		echo "<table border=1 align=center>
				<tr>
					<th> First Name</th>
					<th> Last Name</th>
					<th> Date of Birth</th>
					<th> Gender</th>
					<th> Address</th>
					<th> Post Code</th>
					<th> Country</th>
					<th> Email</th>
					<th> Phone</th>
					<th> Username</th>
					<th> password</th>
					<th colspan='2'> Operation</th>
				</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			echo "<tr>";
			echo "<td>".$row['firstName']."</td>";
			echo "<td>".$row['lastName']."</td>";
			echo "<td>".$row['dob']."</td>";
			echo "<td>".$row['gender']."</td>";
			echo "<td>".$row['address']."</td>";
			echo "<td>".$row['postCode']."</td>";
			echo "<td>".$row['country']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['phone']."</td>";
			echo "<td>".$row['username']."</td>";
			echo "<td>".$row['password']."</td>";
			echo "<td><a href=removeUser.php?username=".$row['username'].">Remove</a></td>";
			echo "<td><a href=updateUser.php?username=".$row['username'].">Update</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>