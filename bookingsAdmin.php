<?php
	session_start();
 	$userType = $_SESSION['userType'];
 	$username = $_SESSION['username'];
 	$login = $_SESSION['login'];
 	if($_SESSION['login']!=true)
	header('location:login.html');
	elseif ($userType != 'admin') {
		header('location:index.php');
	}
	
	else{
		include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		if($_POST)
			{
				$bookingId =$_POST['bookingId'];

				$visitingDate = date('Y-m-d',strtotime($_POST['visitingDate'])) ;


					$updateQuery="update booking set visitingDate='$visitingDate' where bookingId=$bookingId";

					$result = mysqli_query($con, $updateQuery);

					if(!$result) echo mysqli_error($con);
					else{
						//echo "Information successfully updated";
						header('location: bookingsAdmin.php');
					} 
				}	

			if($_GET){
			$bookingId = $_GET['bookingId'];
			$selectQuery="select * from booking where bookingId='$bookingId'";
			$result=mysqli_query($con,$selectQuery)or die("Error: ".mysqli_error($con));
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$visitingDate=$row['visitingDate'];
		?>
		<head>
			
			<link rel="stylesheet"  href="jquery-ui11.css">
            <link rel="stylesheet"  href="style1.css">
            <script src="jquery11-1.12.4.js"></script>
		<script src="jquery-ui11.js"></script>
		<script>
			$( function() {
				$("#visitingDate").datepicker({minDate: 0, });
			} );
		</script>
		</head>
			<form action='bookingsAdmin.php' method='post' >
					<table align='center' cellpadding='10px' style='background: #00aa34; font-family: Arial; font-size: 25px; font-style: italic;'>
						<caption>New Animal</caption>
						<tr>
							<td><label for='visitingDate'>Visiting Date </label></td>
							<td>:<input type="text" id="visitingDate" name="visitingDate" value="<?php echo date('Y-m-d',strtotime($visitingDate)); ?>" />
                                   
							</td>
						</tr>
						
						<tr>  
							<td colspan="2" align="center">
							<input type="hidden" value="<?php echo $row['bookingId'] ?>" name="bookingId" />
							<input type="submit" value="Update Booking" />
							</td>
						</tr>

					</table>
				</form>
			
<?php } 
		$query="select * from booking";
		$result=mysqli_query($con,$query);
		echo "<table border=1 align=center>
				<tr>
					<th> Booking Id</th>
					<th> Booking Date</th>
					<th> Visiting Date</th>
					<th> Event TO Visit</th>
					<th> Children Ticket Amount	</th>
					<th> Adult Ticket Amount	</th>
					<th> OAP Ticket Amount	</th>
					<th> Family Ticket Amount	</th>
					<th> Sub Total </th>
					<th> Discount </th>
					<th> Total Cost	</th>
					<th> Operation </th>";
		echo "</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			echo "<tr>";
			echo "<td>".$row['bookingId']."</td>";
			echo "<td>".$row['bookingDate']."</td>";
			echo "<td>".$row['visitingDate']."</td>";
			echo "<td>".$row['eventName']."</td>";
			echo "<td>".$row['childrenTicketQuantity']."</td>";
			echo "<td>".$row['adultTicketQuantity']."</td>";
			echo "<td>".$row['oapTicketQuantity']."</td>";
			echo "<td>".$row['familyTicketQuantity']."</td>";
			echo "<td>".$row['subTotal']."</td>";
			echo "<td>".$row['discount']."</td>";
			echo "<td>".$row['totalPrice']."</td>";
			echo "<td><a href=bookingsAdmin.php?bookingId=".$row['bookingId'].">Modify Booking</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>