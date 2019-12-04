<?php  
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:logout.php');
	else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add new Events</title>
</head>
<body>
	<?php include_once('header.php');?>
		<form action="addVIPVisit.php" method="post" enctype="multipart/form-data">
			<table align="center" cellpadding="10px" style="background: #00aa34; font-eventStartDate: Arial; font-size: 25px; font-style: italic;">
				<caption>New VIP Visit</caption>
				<tr>
					<td><label for="eventName">Event Name</label></td>
					<td>:<input type="text" id="eventName" name="eventName" /></td>
				</tr>
				<tr>
					<td><label for="eventDesc">Event Description</label></td>
					<td>:<textarea rows="5" cols="25" id="eventDesc" name="eventDesc">
					</textarea>
					</td>
				</tr>
				<tr>
					<td><label for="eventPic">Image </label></td>
					<td>:<input type="file" id="eventPic" name="eventPic" /></td>
				</tr>

				<tr>
					<td><label for="includes">Includes in the Event</label></td>
					<td>:
					<textarea rows="5" cols="25" id="includes" name="includes">
					</textarea>
					</td>
				</tr>

				<tr>
					<td><label for="eventStartDate">Event Start Date</label></td>
					<td>:<input type="Date" id="eventStartDate" name="eventStartDate" /></td>
				</tr>
				
				<tr> 
					<td colspan="2" align="center"><input type="submit" value="Add Visit" /></td>
				</tr>

			</table>
		</form>
</body>
</html>

<?php } ?>