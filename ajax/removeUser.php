<?php 
	$username = $_GET['username'];
	$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
	$deleteQuery = "delete from user where username = '$username'";
	$result = mysqli_query($con, $deleteQuery);
	if(!$result) echo mysqli_error($con);
	else header('location: userRegXml.html');
?>