<?php 

	$ticketType = $_GET['ticketType'];
	$eventName = $_GET['eventName'];
	$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
	$deleteQuery = "delete from ticket where ticketType = '$ticketType' and eventName='$eventName'";
	$result = mysqli_query($con, $deleteQuery) or die("Error: ".mysqli_error($con));
	if($result) header('location: ticketDetails.php');
?>