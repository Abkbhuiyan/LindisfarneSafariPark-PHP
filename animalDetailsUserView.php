<?php
	session_start();
 	$userType = $_SESSION['userType'];
 	$login = $_SESSION['login'];
 	if($_SESSION['login']!=true)
	header('location:login.html');
	
	else{
		include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query="select * from animal";
		$result=mysqli_query($con,$query);
		echo "<table border=1 align=center>
				<tr>
					<th> Animal Picture </th>
					<th> Animal Details </th>";

				echo "</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$pic = $row['pic'];
			echo "<tr>";
			echo "<td>"."<img src='animals/$pic' style='width: 300px; height: 200px;'/>"."</td>";
			echo "<td>";
			echo 	"<table>";
				echo"<tr>
					<td>Animal ID</td>
					<td>:".$row['animalId']."</td>
					</tr>";
				echo"<tr>
					<td>Section Name</td>
					<td>:".$row['sectionName']."</td>
					</tr>";
				echo"<tr>
					<td>Animal Name</td>
					<td>:".$row['animalName']."</td>
					</tr>";
				echo"<tr>
					<td>About Animal</td>
					<td>:".$row['about']."</td>
					</tr>";
				echo"<tr>
					<td>Number Of Animal</td>
					<td>:".$row['howMuch']."</td>
					</tr>";
			echo "</table></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>