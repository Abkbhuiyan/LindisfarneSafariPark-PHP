<?php  
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{

		$eventName = $_POST['eventName'];
		$eventType = $_POST['eventType'];
		$eventDesc = $_POST['eventDesc'];
		$includes = $_POST['includes'];
		$eventStartDate = $_POST['eventStartDate'];
		$target_dir = "events/";
		$target_file = $target_dir . basename($_FILES["eventPic"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["eventPic"]["tmp_name"], $target_file);
		$image=basename( $_FILES["eventPic"]["name"]);
			$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
			$insertQuery = "insert into VIPVisit values ('','$eventName','$eventDesc','$image','$includes','$eventStartDate')";
			$result = mysqli_query($con, $insertQuery);
			if(!$result) echo mysqli_error($con);
			else{
				header('location:VIPVisits.php');
			}
		}
?>