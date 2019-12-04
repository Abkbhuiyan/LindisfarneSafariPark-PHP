<?php 
	
	$discountStartDate = $_POST['discountStartDate'];
	//print $discountStartDate; exit;
	$discountEndDate = $_POST['discountEndDate'];
	$discountRate = $_POST['discountRate'];
	
		$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$insertQuery = "insert into discount values ('','$discountStartDate','$discountEndDate',$discountRate)";
		$result = mysqli_query($con, $insertQuery);
		if(!$result) echo mysqli_error($con);
		else
			//echo "Discount Added";
			header('location: discountDetails.php');
		
	
		

 ?>