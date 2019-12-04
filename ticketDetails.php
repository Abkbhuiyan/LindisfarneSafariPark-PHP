<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{
				 include_once('header.php');
			$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
			$query="select * from ticket";
			$result=mysqli_query($con,$query);
			echo "<table border=1 align=center>
					<tr>
						<th> Ticket Type</th>
						<th> Ticket for Event</th>
						<th > Ticket Price</th>
						<th> Ticket Details</th>
						<th colspan='2'> Operation </th>
					</tr>";
			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td>".$row['ticketType']."</td>";
				echo "<td>".$row['eventName']."</td>"; 
				echo "<td>".$row['unitPrice']."</td>";
				echo "<td>".$row['description']."</td>";
				$eventName=str_replace(' ', '%20', $row['eventName']);
				echo "<td><a href=updateTicket.php?ticketType=".$row['ticketType']."&eventName=$eventName >Update</a></td>";
				echo "<td><a href=removeTicket.php?ticketType=".$row['ticketType']."&eventName=$eventName >Remove</a></td>";
				echo "</tr>";
			}
			echo "</table>";
	}
?>