<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:logout.php');
	else{ 
			include_once('header.php');

		 $con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		if($_POST)
		{	
			$eventId =$_POST['eventId'];
			$eventName = $_POST['eventName'];
			$eventDesc = $_POST['eventDesc'];
			$includes = $_POST['includes'];
			$eventStartDate = $_POST['eventStartDate'];

				$updateQuery="update VIPVisit set eventName='$eventName',eventDesc='$eventDesc',includes='$includes',eventStartDate='$eventStartDate' where eventId='$eventId'";
				$result = mysqli_query($con,$updateQuery)or die("Error: ".mysqli_error($con));
			if ($result)  header('location:VIPVisits.php');
		}		

		if($_GET){
			$eventId = $_GET['eventId'];
			$selectQuery="select * from VIPVisit where eventId='$eventId'";
			$result=mysqli_query($con,$selectQuery)or die("Error: ".mysqli_error($con));
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			echo "<form action='updateVIPVisit.php' method='post' enctype='multipart/form-data'>
					<table align='center' cellpadding='10px' style='background: #00aa34; font-eventStartDate: Arial; font-size: 25px; font-style: italic;'>
						<caption>Modify VIP Visit</caption>
						<tr>
							<td><label for='eventName'>Event Name</label></td>
							<td>:<input type='text' id='eventName' name='eventName' value=".$row['eventName']." /></td>
						</tr>
						<tr>
							<td><label for='eventDesc'>Event Description</label></td>
							<td>:<textarea rows='5' cols='25' id='eventDesc' name='eventDesc'>
							 ".$row['eventDesc']."
							</textarea>
							</td>
						</tr>

						<tr>
							<td><label for='includes'>Includes in the Event</label></td>
							<td>:
							<textarea rows='5' cols='25' id='includes' name='includes'>
							 ".$row['includes']."
							</textarea>
							</td>
						</tr>

						<tr>
							<td><label for='eventStartDate'>Event Start Date</label></td>
							<td>:<input type='Date' id='eventStartDate' name='eventStartDate'  value=".$row['eventStartDate']." /></td>
						</tr>
						
						<tr> 
							<input type='hidden' value=".$row['eventId']." name='eventId' />
							<td colspan='2' align='center'><input type='submit' value='Update Visit' /></td>
						</tr>

					</table>
				</form>";
			}
		}
?>