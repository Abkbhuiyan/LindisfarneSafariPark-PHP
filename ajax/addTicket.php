<?php 
	
	if($_POST['add']) {

	$ticketType = $_POST['ticketType'];
	$eventName = $_POST['eventName'];
	$unitPrice = $_POST['unitPrice'];
	$numberOfTickets = $_POST['numberOfTickets'];
	$description = $_POST['description'];

	
		$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$insertQuery = "insert into ticket values ('$ticketType','$numberOfTickets','$unitPrice','$eventName','$description')";
		$result = mysqli_query($con, $insertQuery);
		if(!$result){
			if(mysqli_error($con)=="Duplicate entry '$ticketType'-'$eventName' for key 'PRIMARY'")
				echo "Username Already exist, Please try something else";

			 echo mysqli_error($con);
		}else{
			header('location: ticketFormXml.php');
		} 

	}
		
 ?>