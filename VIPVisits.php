<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	elseif ($_SESSION['userType'] != 'admin') {
		header('location:logout.php');
	}
	else{
		include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query="select * from VIPVisit";
		$result=mysqli_query($con,$query);
		echo "<table border=1 align=center>
				<tr>
					<th> Event ID </th>
					<th> Event Name</th>
					<th> Event Description </th>
					<th> Image </th>
					<th> Includes in the Event </th>
					<th> Event Start Date </th>
  					<th colspan='2'> Operation </th>
  				</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$pic = $row['eventPic'];
			echo "<tr>";
			echo "<td>".$row['eventId']."</td>";
			echo "<td>".$row['eventName']."</td>";
			echo "<td>".$row['eventDesc']."</td>";
			echo "<td>"."<img src='events/$pic'style='width: 300px;'/>"."</td>";

			echo "<td>".$row['includes']."</td>";
			echo "<td>".$row['eventStartDate']."</td>";
			
			echo "<td><a href=removeVIPVisit.php?eventId=".$row['eventId'].">Remove</a></td>";
			echo "<td><a href=updateVIPVisit.php?eventId=".$row['eventId'].">Update</a></td>";

			echo "</tr>";
		}
		echo "</table>";
	}
?>