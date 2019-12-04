<?php 

	$discountID = $_GET['discountID'];

	$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
	$deleteQuery = "delete from discount where discountID = '$discountID'";
	$result = mysqli_query($con, $deleteQuery) or die("Error: ".mysqli_error($con));
	if($result) header('location: discountDetails.php');
?>