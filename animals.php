<?php
	session_start();
 	$userType = $_SESSION['userType'];
 	$login = $_SESSION['login'];
 	if($_SESSION['login']!=true)
	header('location:login.html');
	elseif ($userType != 'admin') {
		header('location:logout.php');
	}
	else{
		include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query="select * from animal";
		$result=mysqli_query($con,$query);
		echo "<table border=1 align=center>
				<tr>
					<th> Animal ID</th>
					<th> Section Name</th>
					<th> Animal Name</th>
					<th > Picture</th>
					<th> About Animal</th>
					<th> Amount of Animal</th>";
					if ( $userType=='admin') {
						echo "<th colspan='2'> Operation </th>";
					}
				echo "</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$pic = $row['pic'];
			echo "<tr>";
			echo "<td>".$row['animalId']."</td>";
			echo "<td>".$row['sectionName']."</td>";
			echo "<td>".$row['animalName']."</td>";
			echo "<td>"."<img src='animals/$pic' style='width: 300px;'/>"."</td>";
			echo "<td>".$row['about']."</td>";
			echo "<td>".$row['howMuch']."</td>";
			if ( $userType=='admin') {
			echo "<td><a href=removeAnimal.php?animalId=".$row['animalId'].">Remove</a></td>";
			echo "<td><a href=updateAnimal.php?animalId=".$row['animalId'].">Update</a></td>";
			}	
			echo "</tr>";
		}
		echo "</table>";
	}
?>
