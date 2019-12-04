<!DOCTYPE html>
<html>
<head>
</head>
<body onload="showTickets()">

		<form action="addTicket.php" method="post" enctype="multipart/form-data">
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
					<td><label for="numberOfTickets">Available Ticket per day </label></td>
					<td>:<input type="text" id="numberOfTickets" name="numberOfTickets" /></td>
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

	<script language="javascript">
			function showTickets(){
				var url;
				url="ticketXml.php";
				if(window.XMLHttpRequest){
				//code  for modern browsers
					request = new XMLHttpRequest();
				}else{
					//code for older version of internet explorer
					request=new ActiveXObject("Microsoft.XMLHttp");
				}
				request.onreadystatechange=function(){
					if(request.readyState==4 && request.status==200){
						var text = "<tr><td>Ticket Type</td><td>Event Name</td><td>Ticket  Description</td><td>Amount Of Ticket</td><td>Unit Price</td><td>Operation</td></tr>";
						var elements,ticketType,eventName,description,numberOfTickets,unitPrice;
						
						elements = request.responseXML.documentElement.getElementsByTagName("Ticket");
						
						for(i=0; i<elements.length; i++){
							ticketType = elements[i].getElementsByTagName("ticketType");
							eventName = elements[i].getElementsByTagName("eventName");
							description = elements[i].getElementsByTagName("description");
							numberOfTickets = elements[i].getElementsByTagName("numberOfTickets");
							unitPrice = elements[i].getElementsByTagName("unitPrice");
						

							text += "<tr><td>" + ticketType[0].firstChild.nodeValue + "</td>";
							text += "<td>" + eventName[0].firstChild.nodeValue + "</td>";	
							text += "<td>" + description[0].firstChild.nodeValue + "</td>";	
							text += "<td>" + numberOfTickets[0].firstChild.nodeValue + "</td>";	
							text += "<td>" + unitPrice[0].firstChild.nodeValue + "</td>";	
								
							text += "<td><a href=removeTicket.php?ticketType=" + ticketType[0].firstChild.nodeValue+"&&eventName="+eventName[0].firstChild.nodeValue+ ">Delete</a></td></tr>";
						} 
						document.getElementById("animalDetails").innerHTML = text;
					}
				}
				request.open("GET",url, true);
				request.send();
			}
		</script>

	<table id="animalDetails" border="1" align="center"> </table>
</body>
</html>


<?php 

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