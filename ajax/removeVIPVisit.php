<?php 
	$eventId
 = $_GET['eventId'];
	$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
	$deleteQuery = "delete from VIPVisit where eventId
 = '$eventId'";
	$result = mysqli_query($con, $deleteQuery);
	if(!$result) echo mysqli_error($con);
	else header('location: VIPVisitFormXml.html');
?>