<?php 
	//echo $_POST['date'];
	//echo $_POST['eventName'];
		$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
		if (isset($_POST['eventName'])) {
			$eventName = $_POST['eventName'];
			//$eventDate = $_POST['date'];
			
			$query = "select ticketType, unitPrice from ticket where eventName='$eventName'";
			
			//echo $query; exit;
			$result= mysqli_query($con, $query);
			
			/*$rows =  array();
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$rows[]=  $row;
			}*/
			foreach($result as $row){
				$rows[] = $row;
			}
			$abc = json_encode($rows);
			print_r($abc);
			//echo $abc;
			//print_r($row);exit;

		}
		

 ?>