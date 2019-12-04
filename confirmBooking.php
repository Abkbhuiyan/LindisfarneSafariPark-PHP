<?php 
	session_start();
    $userType = $_SESSION['userType'];
    $login = $_SESSION['login'];
    if($_SESSION['login']!=true)
    header('location:login.html');
    elseif ($userType!='user') header('location:index.php'); 
    else {
        include_once('header.php');

	if (isset($_POST['addBooking'])) {
		$checkDiscount = false;
		$date=$_POST['visitingDate']; //echo $date;
		$visitingDate =date('Y-m-d',strtotime($date)); 
		$childrenTicketQuantity = $_POST['childrenTicketQuantity'];
		$childrenTicketCost=$_POST['childrenTicketPrice'] * $childrenTicketQuantity;
		$adultTicketQuantity = $_POST['adultTicketQuantity'];
		$adultTicketCost=$_POST['adultTicketPrice'] * $adultTicketQuantity;
		$oapTicketQuantity = $_POST['oapTicketQuantity'];
		$oapTicketCost=$_POST['oapTicketPrice'] * $oapTicketQuantity;
		$familyTicketQuantity = $_POST['familyTicketQuantity'];
		$familyTicketCost=$_POST['familyTicketPrice'] * $familyTicketQuantity;

		$con = mysqli_connect("localhost", "root", "", "lindisfarne_safari_park");
        $numTicket=$childrenTicketQuantity + $adultTicketQuantity+$oapTicketQuantity+$familyTicketQuantity;
	    $query ="select * from availableticket where  forDate='$visitingDate' "; 
	    $booking = false;
	    $result = mysqli_query($con,$query);
	    if (!$result) {
	    	echo mysqli_error($con);
	    }
	    $numOfRow = mysqli_num_rows($result); //echo $query;
	    $row = mysqli_fetch_array(mysqli_query($con,$query),MYSQLI_ASSOC); 

	    if ($numOfRow >0 ) {
	    	$availAbleTicket = $row['availAbleTicket'];
	    	echo $availAbleTicket;
	    	if ($availAbleTicket >= $numTicket) {
	    		$booking =true;
	    	}
	    }else{
	    	$availAbleTicket = 500;
	    	if ($availAbleTicket >= $numTicket) {
	    		$booking =true;
	    	}
	    }
		//echo $booking;
if ($booking == true) {

		$subtotal = $childrenTicketCost + $adultTicketCost + $oapTicketCost + $familyTicketCost;

		$con = mysqli_connect("localhost", "root", "", "lindisfarne_safari_park");
	    $query = "select discountRate, discountStartDate ,discountEndDate  from discount" ;
	    $result = mysqli_query($con, $query);

       	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
       		$discountStartDate = strtotime( $row['discountStartDate']);
       		$discountEndDate =strtotime ($row['discountEndDate']);
       		//echo $discountEndDate; echo $discountStartDate;
       		if ($visitingDate >= $discountStartDate && $visitingDate <= $discountEndDate  ) {
       			$checkDiscount = true;
       			$discountRate = $row['discountRate'];
       			echo $discountRate; echo $checkDiscount; 

       		}
       }
       if ($checkDiscount == true) {
       		$discount = ($subtotal * $discountRate)/100;
       }else{
       		$discount = 0;
       }
       
		$totalPrice = $subtotal - $discount;
		
?>

<head>
 	<style type="text/css">
 		table{
 			background: #aabbcc; font-family: Arial; font-size: 20px; 
 		}
 
 	</style>
 </head>
 <body>
 
		<table align="center" cellpadding="10px" >
			<caption>Confirmation Details</caption>
		<form method="post" action="booking.php">
			<tr>
				<td><label for="visitingDate">Date of visit</label></td>
				<td>: <?php //echo $date ?>
				<input type="date" name="visitingDate" value="<?php echo date('Y-m-d',strtotime($date)); ?>" readonly />
				</td>
			</tr>

			<tr>
				<td><label for="eventName">Event to Visit</label></td>
				<td>: 
				<input type="text" name="eventName" value="<?php echo $_POST['eventName']; ?>" readonly />
				</td>
				</td>
			</tr>

			<tr>
				<td><label for="childrenTicketQuantity">Children Ticket Amount </label></td>
				<td>:
				<input type="number" name="childrenTicketQuantity" value="<?php echo $_POST['childrenTicketQuantity']; ?>" readonly />
				</td>
			</tr>
			<tr>
				<td><label for="childrenTicketCost">Children Ticket Cost</label></td>
				<td>:
				<?php echo $childrenTicketCost; ?>
				</td>
			</tr>

			<tr>
				<td><label for="adultTicketQuantity">Adult Ticket Amount </label></td>
				<td>:
				<input type="number" name="adultTicketQuantity" value="<?php echo $_POST['adultTicketQuantity']; ?>" readonly />
				</td>
			</tr>
			<tr>
				<td><label for="adultTicketCost">Adult Ticket Cost</label></td>
				<td>:
				<?php echo $adultTicketCost; ?>
				</td>
			</tr>

			<tr>
				<td><label for="oapTicketQuantity">OAP Ticket Amount </label></td>
				<td>:
				<input type="number" name="oapTicketQuantity" value="<?php echo $_POST['oapTicketQuantity']; ?>" readonly />
				</td>
			</tr>
			<tr>
				<td><label for="oapTicketCost">OAP Ticket Cost</label></td>
				<td>:
				<?php echo $oapTicketCost; ?>
				</td>
			</tr>

			<tr>
				<td><label for="familyTicketQuantity">Family Ticket Amount </label></td>
				<td>:
				<input type="number" name="familyTicketQuantity" value="<?php echo $_POST['familyTicketQuantity']; ?>" readonly />
				</td>
			</tr>
			<tr>
				<td><label for="familyTicketCost">Family Ticket Cost</label></td>
				<td>:
				<?php echo $familyTicketCost; ?>
				</td>
			</tr>


			<tr>
				<td><label for="subTotal">Sub Total</label></td>
				<td>:
				<input type="text" name="subTotal" value="<?php echo $subtotal; ?>" readonly />
				</td>
			</tr>

			<tr>
				<td><label for="discount">Discount </label> </td>
				<td>:
					<input type="text" name="discount" value="<?php echo $discount; ?>" readonly />
				</td>
			</tr>

			<tr>
				<td><label for="totalPrice">Total Cost</label></td>
				<td>:
					<input type="text" name="totalPrice" value="<?php echo $totalPrice; ?>" readonly />
				</td>
			</tr>

			<tr> 
				<td colspan="2" align="center">
				
			
					<input type="submit" value="Confirm Booking" name="confirm" />
				
				</td>
			</tr>
		 </form>
		</table>
	</body>
	<?php 
		}else echo"Ticket Out of Stock";
		} 
	}

	?>

 