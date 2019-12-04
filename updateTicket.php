<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{ 
			include_once('header.php');

			$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
			if($_GET){
				$ticketType = $_GET['ticketType'];
				$eventName =  $_GET['eventName'];
				$selectQuery="select * from ticket where ticketType='$ticketType'and eventName='$eventName'";
				//echo $selectQuery;
				$result=mysqli_query($con,$selectQuery)or die("Error: ".mysqli_error($con));
				$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
				$ticket = $row['ticketType'];
				$event = $row['eventName'];
				$up= $row['unitPrice'];
				$des =$row['description'];
				echo "<form action='updateTicket.php' method='post'>
						<table align='center' cellpadding='10px' style='background: #00aa34; font-description
			              : Arial; font-size: 25px; font-style: italic;'>
							<caption>New Ticket</caption>
							<tr>
								<td><label for='ticketType'>Ticket Type</label></td>
								<td>:<select id='ticketType' name='ticketType'>
									<option value='Adult'"; if($ticket == 'Adult') echo "selected ='selected'"; echo" >Adult</option>
									<option value='Children'";if($ticket == 'Children') echo "selected ='selected'"; echo">Children </option>
									<option value='OAP'";if($ticket == 'OAP') echo "selected ='selected'"; echo">Old Age Pensioner</option>
									<option value='Family'";if($ticket == 'Family') echo "selected ='selected'"; echo">Family</option>
								</select>
								</td>
							</tr>
							<tr>
								<td><label for='eventName'>Ticket for Event</label></td>
								<td>:<select  id='eventName' name='eventName'>
									<option value='Regular'";if($event == 'Regular') echo "selected ='selected'";echo ">Rgular</option>";
										
								$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
								$query = "select eventName from VIPVisit";
								$result= mysqli_query($con, $query);
								$numResults = mysqli_num_rows($result);
									while ($row= mysqli_fetch_array($result,MYSQLI_ASSOC)) {
										$eventName = $row['eventName'];
									 	//echo $eventName;
											echo "<option value='$eventName'";if($event == $eventName) echo "selected ='selected'"; echo">".$eventName."</option>";
									}
								echo "</select>
								</td>
							</tr>
							<tr>
								<td><label for='unitPrice'>Ticket Price</label></td>
								<td>:<input type='text' id='unitPrice' name='unitPrice' value='$up' />
								</td>
							</tr>

							<tr>
								<td><label for='description'>Ticket Details</label></td>
								<td>:<input type='text' id='description' name='description' value='$des' /></td>
							</tr>

							<tr> 
								<td colspan='2' align='center'><input type='submit' name='update' value='Updtae Ticket' /></td>
							</tr>
						</table>
					</form>";
				}

				if(isset($_POST['update'])){
					$ticketType = $_POST['ticketType'];
					$unitPrice = $_POST['unitPrice'];
					$eventName = $_POST['eventName'];
					$description = $_POST['description'];


					$updateQuery="update ticket set ticketType='$ticketType',unitPrice='$unitPrice',eventName='$eventName',description='$description' where ticketType='$ticketType' and eventName='$eventName'";
						$result = mysqli_query($con, $updateQuery);
						if(!$result) echo mysqli_error($con);
						else{
							echo "Information successfully updated";
							header('location: ticketDetails.php');
						} 
				
				
				}
		}
?>