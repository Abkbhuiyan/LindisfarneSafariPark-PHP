<?php 
session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{

	function fillEventList(){
		$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
		$query = "select eventName from VIPVisit";
		$result= mysqli_query($con, $query);
		$output= '';

			while ($row= mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$eventName = $row['eventName'];
			 	//echo $eventName;
			 	$output .= '<option value="'.$eventName.'">'.$eventName.'</option>';
					//echo "<option value='$eventName'>".$eventName."</option>";
			}
		return $output;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add new Animal</title>
</head>
<body>
 <?php include_once('header.php');?>
		<form action="addNewTicket.php" method="post" enctype="multipart/form-data">
			<table align="center" cellpadding="10px" style="background: #00aa34; font-description: Arial; font-size: 25px; font-style: italic;">
				<caption>New Ticket</caption>
				<tr>
					<td><label for="ticketType">Ticket Type</label></td>
					<td>:<select id="ticketType" name="ticketType">
						<option value="Adult">Adult</option>
						<option value="Children">Children </option>
						<option value="OAP">Old Age Pensioner</option>
						<option value="Family">Family</option>
					</select>
					</td>
				</tr>

				<tr>
					<td><label for="eventName">Ticket for Event</label></td>
					<td>:<select  id="eventName" name="eventName"> 
					<?php 
						echo fillEventList() ;
					?>
					</select>
					</td>
				</tr>

				<tr>
					<td><label for="unitPrice">Ticket Price</label></td>
					<td>:<input type="text" id="unitPrice" name="unitPrice">
					</td>
				</tr>


				<tr>
					<td><label for="description">Ticket Details</label></td>
					<td>:<input type="text" id="description" name="description" /></td>
				</tr>

				<tr> 
					<td colspan="2" align="center"><input type="submit" value="Add Ticket" name="add" /></td>
				</tr>
			</table>
		</form>
</body>
</html>
<?php } ?>
