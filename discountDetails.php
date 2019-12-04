
<?php
session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{
		include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query="select * from discount";
		$result=mysqli_query($con,$query);
		echo "<table border=1 align=center>
				<tr>
					<th> Discount ID</th>
					<th> Discount Start Date</th>
					<th> Last Name</th>
					<th> Date of Birth</th>
					<th> Gender</th>
					
					<th colspan='2'> Operation</th>
				</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			echo "<tr>";
			echo "<td>".$row['discountID']."</td>";
			echo "<td>".$row['discountStartDate']."</td>";
			echo "<td>".$row['discountEndDate']."</td>";
			echo "<td>".$row['discountRate']."</td>";

			echo "<td><a href=removeDiscount.php?discountID=".$row['discountID'].">Remove</a></td>";
			echo "<td><a href=updateDiscount.php?discountID=".$row['discountID'].">Update</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>