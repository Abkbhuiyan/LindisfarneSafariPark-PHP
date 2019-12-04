<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{ 
			include_once('header.php');
			 $con=mysqli_connect("localhost","root","","lindisfarne_safari_park");

			if($_POST)
			{
				$animalId =$_POST['animalId'];
				$sectionName = $_POST['sectionName'];
				$animalName = $_POST['animalName'];
				$about = $_POST['about'];
				$howMuch = $_POST['howMuch'];

					$updateQuery="update animal set sectionName='$sectionName',animalName='$animalName',about='$about',howMuch='$howMuch'  where animalId='$animalId'";
					$result = mysqli_query($con, $updateQuery);

					if(!$result) echo mysqli_error($con);
					else{
						//echo "Information successfully updated";
						header('location: animals.php');
					} 
				}		

		if($_GET){
			$animalId = $_GET['animalId'];
			$selectQuery="select * from animal where animalId='$animalId'";
			$result=mysqli_query($con,$selectQuery)or die("Error: ".mysqli_error($con));
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$animalName = $row['animalName']; $sectionName=$row['sectionName']; //echo $animalName;
			echo "<form action='updateAnimal.php' method='post' >
					<table align='center' cellpadding='10px' style='background: #00aa34; font-family: Arial; font-size: 25px; font-style: italic;'>
						<caption>New Animal</caption>
						<tr>
							<td><label for='animalName'>Animal Name</label></td>
							<td>:<input type='text' id='animalName' name='animalName' value=".$animalName." /></td>
						</tr>
						<tr>
							<td><label for='sectionName'>Section Name</label></td>
							<td>:<input type='text' id='sectionName' name='sectionName' value=".$sectionName." /></td>
						</tr>
						<tr>
							<td><label for='about'>About The Animal</label></td>
							<td>:<textarea rows='5' cols='25' id='about' name='about'>
								".$row['about']."
							</textarea>
							</td>
						</tr>						
						<tr>
							<td><label for='howMuch'>Amount of the Animal </label> </td>
							<td>: <input type='text' id='howMuch' name='howMuch' value=".$row['howMuch']." /> </td>

						</tr>
						<tr>  
							<td colspan='2' align='center'>
							<input type='hidden' value=".$row['animalId']." name='animalId' />
							<input type='submit' value='Update Animal' />
							</td>
						</tr>

					</table>
				</form>";
			}
		}
?>