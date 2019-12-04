<?php 
	$animalId = $_GET['animalId'];
	$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
	$deleteQuery = "delete from animal where animalId = $animalId";
	$result = mysqli_query($con, $deleteQuery);
	header('location: animalFormXml.html');
?>