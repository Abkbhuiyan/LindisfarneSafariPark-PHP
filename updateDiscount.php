<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{ 
			include_once('header.php');
			$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
			if($_POST){
				$discountID = $_POST['discountID'];
				$discountStartDate = $_POST['discountStartDate'];
				$discountEndDate = $_POST['discountEndDate'];
				$discountRate = $_POST['discountRate'];
				
				if ($password != $cpassword) echo "Password did not match";
				else {
					$updateQuery="update discount set discountStartDate='$discountStartDate',discountEndDate='$discountEndDate',discountRate='$discountRate' where discountID='$discountID'";
					$result = mysqli_query($con, $updateQuery);
					if(!$result) echo mysqli_error($con);
					else{
						//echo "Information successfully updated";
						header('location: discountDetails.php');
					} 
				}
				
			}


			if($_GET){
				$discountID = $_GET['discountID'];
				$selectQuery="select * from discount where discountID='$discountID'";
				$result=mysqli_query($con,$selectQuery)or die("Error: ".mysqli_error($con));
				$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

				echo "<form action='updateDiscount.php' method='post' '>
						<table align='center' cellpadding='10px' style='background: #aabbcc; font-family: Arial; font-size: 30px'>
							<caption>Update User Details</caption>
							<tr>
								<td><label for='discountStartDate'>Discount Start Date</label></td>
								<td>:<input type='date' id='discountStartDate' name='discountStartDate' value=".$row['discountStartDate']." /></td>
							</tr>
							<tr>
								<td><label for='discountEndDate'>Discount End Date</label></td>
								<td>:<input type='text' id='discountEndDate' name='discountEndDate' value=".$row['discountEndDate']." /></td>
							</tr>
							<input type = 'hidden' id='discountID' name='discountID' value=".$row['discountID']."
							<tr>
								<td><label for='discountRate'>Discount Rate</label></td>
								<td>:<input type='text' id='discountRate' name='discountRate' value=".$row['discountRate']." /></td>
							</tr>
							
							<tr> 
								<td colspan='2' align='right'>

								<input type='submit' value='Update' /></td>
							</tr>

						</table>
					</form>";
				}
		}
?>

