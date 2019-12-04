<?php
session_start();  
	$username =$_POST["username"];
	$password = $_POST["password"];
	$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
	$query = "select * from user where  username='$username'";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);
	if($num==0)
		echo "User doesn't exist, please enter a valid username in <a href='login.html'> Login</a> Page";
	else{
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$time = $row['timeStamp']; 
		if ($time<time()) {
		$dbpassword=$row['password'];
		if($password != $dbpassword){
			echo "Wrong password, please enter right password in <a href='login.html'> Login</a> Page";
			$attempt = $row['attempt']+1;
			$query="update user set attempt=$attempt where username='$username'";
			mysqli_query($con, $query);

			if ($attempt==3) {
				$time = time()+10000;
				$query = "update user set timeStamp=$time where username='$username'";	
				mysqli_query($con, $query);
			}
		}
		else{
			$query="update user set attempt=0 where username='$username'";
					mysqli_query($con,$query);
			$userType = $row['userType'];
			$_SESSION['username'] = $username;
			$_SESSION['login'] = true;
			$_SESSION['userType']=$userType;
			
				header('location: index.php');
		}
		}else
		echo "You have entered wrong password more than 3 times in a row.Please Try again some time later.";
	}

?>