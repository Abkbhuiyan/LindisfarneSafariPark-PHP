<?php 
	
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$postCode = $_POST['postCode'];
	$country = $_POST['country'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$userType = $_POST['userType'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	if ($password != $cpassword) echo "Password did not match";
	else {
		$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$insertQuery = "insert into user values ('$firstName','$lastName','$dob','$gender','$address','$postCode','$country','$email','$phone','$userType','$username','$password',0,0)";
		$result = mysqli_query($con, $insertQuery);
		if(!$result){
			if(mysqli_error($con)=="Duplicate entry '$username' for key 'PRIMARY'")
				echo "Username Already exist, Please try something else";

			else echo mysqli_error($con);
		}else{
			//echo "Registration was successful";
			header('location: userRegXml.html');
		} 
	}
		

 ?>