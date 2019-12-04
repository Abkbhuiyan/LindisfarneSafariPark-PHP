<?php
	session_start();
 	$userType = $_SESSION['userType'];
 	$username = $_SESSION['username'];
 	$login = $_SESSION['login'];
 	if($_SESSION['login']!=true)
	header('location:login.html');
	elseif ($userType != 'user') {
		header('location:index.php');
	}
	else{
		include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query="select * from booking where username='$username'";
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
					<th> Total(£) </th>
					<th> Total($) </th>
					<th> Total (€) </th>";		
				echo "</tr>";
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$dollar=convertCurrency($row['totalPrice'], "GBP", "USD"); //echo $dollar;
			$euro=convertCurrency($row['totalPrice'], "GBP", "EUR"); //echo $euro;
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
			echo "<td>".$dollar."</td>";
			echo "<td>".$euro."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	function convertCurrency($amount, $from, $to)
	{
	    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
	    $data = file_get_contents($url);
	    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
	    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
	    return round($converted, 0);
	}
?>
