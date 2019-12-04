<?php
	session_start();
 	$userType = $_SESSION['userType'];
 	$login = $_SESSION['login'];
 	if($_SESSION['login']!=true)
	header('location:login.html');
	
	else{
		include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query="select * from VIPVisit";
		$result=mysqli_query($con,$query);
		echo "<table border=1 align=center>
				<tr>
					<th> Event Picture </th>
					<th> Visit Details </th>";

				echo "</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

			$pic = $row['eventPic'];
			echo "<tr>";
			echo "<td>"."<img src='events/$pic' style='width: 300px; height: 200px;'/>"."</td>";
			echo "<td>";
			echo 	"<table>";
				echo"<tr>
					<td>Event ID</td>
					<td>:".$row['eventId']."</td>
					</tr>";
				echo"<tr>
					<td>Event Name</td>
					<td>:".$row['eventName']."</td>
					</tr>";
				echo"<tr>
					<td>Event Description</td>
					<td>:".$row['eventDesc']."</td>
					</tr>";
				echo"<tr>
					<td>Includes in the Event</td>
					<td>:".$row['includes']."</td>
					</tr>";
				echo"<tr>
					<td>Event Start Date</td>
					<td>:".$row['eventStartDate']."</td>
					</tr>";
			echo "</table></td>";
				
			echo "</tr>";
		}
		echo "</table>";
	}
?>
