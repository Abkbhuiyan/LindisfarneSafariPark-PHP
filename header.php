<?php 
 	$userType = $_SESSION['userType'];
 	$login = $_SESSION['login'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header class="hdr-wrp">
	<div class="menu ">
		<ul class="clearfix">
			<li><a href="index.php">Home</a></li>
			
				<?php if ($userType == 'user') { ?>
				<li><a href="VIPVisitUserView.php">VIP Visits</a></li>
				<?php } ?>
			   <?php if ($userType == 'admin') { ?>
			   <li class="drop-1"><a href="VIPVisits.php">VIP Visits</a>
			    <ul class="sub-menu">
			    	<li><a href="addNewVIPVisit.php">Add New VIP Visit</a></li>
			    	<li><a href="VIPVisits.php">View Visits</a></li>
			    </ul>
			    <?php } ?>
			</li>
			<?php if ($userType == 'user') { ?>
			<li><a href="animalDetailsUserView.php">Animals</a></li>
			<?php } ?>
			 <?php if ($userType == 'admin') { ?>
			<li class="drop-1"><a href="animals.php">Animals</a>
				<ul class="sub-menu">
			    	<li><a href="addAnimals.php">Add New Animal</a></li>
			    	<li><a href="animals.php">View Animals</a></li>
			    </ul>
			</li>
			 <?php } ?>

			<?php if ($userType == 'admin') { ?>
			<li class="drop-1"><a href="ticketDetails.php">Ticket</a>
				<ul class="sub-menu">
			    	<li><a href="newTicket.php">Add New Ticket</a></li>
			    	<li><a href="ticketDetails.php">View Tickets</a></li>
			    </ul>
			</li>
			<?php } ?>
		
			

			<?php if ($userType == 'user') { ?>
			<li class="drop-1"><a href="openingTimes.php">Times & Special Offers </a></li>
			<li class="drop-1"><a href="bookingUI.php">Booking</a>	
				<ul class="sub-menu">
					<li><a href="bookingUI.php">New Booking</a></li>
			    	<li><a href="userBookings.php">My Bookings</a></li>
			    </ul>
			</li>
			<?php } ?>
			<li><a href="userAccount.php">Account</a></li>
		   

		   <?php if ($userType == 'admin') { ?>
			<li><a href="bookingsAdmin.php">Bookings</a>	</li>
			<li class="drop-1"><a href="discountDetails.php">Discounts</a>	
				<ul class="sub-menu">
			    	<li><a href="discountAdd.php">Add Discount</a></li>
			    </ul>
			</li>
		   <?php } ?>
		   <li><a href="logout.php">Logout</a></li>
		  
			
		</ul>
	</div>
</header>
</body>
</html>