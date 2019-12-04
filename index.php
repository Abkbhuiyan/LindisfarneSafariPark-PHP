<?php 
	session_start();
 	$userType = $_SESSION['userType'];
 	$login = $_SESSION['login'];
 	if($_SESSION['login']!=true)
	header('location:login.html');
	
	else{

		include_once('header.php');
?>

	<div align="center" style="color: green; font-style: bold-italic;font-size: 60px">
		<p> Welcome To Lindisfarne Safari Park</p>
	</div>
	

<?php } ?>
 