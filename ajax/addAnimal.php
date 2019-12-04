<?php  
		$sectionName = $_POST['sectionName'];
		$animalName = $_POST['animalName'];
		$about = $_POST['about'];
		$howMuch = $_POST['howMuch'];

		$target_dir = "animals/";
		$target_file = $target_dir . basename($_FILES["pic"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
		$image=basename( $_FILES["pic"]["name"]);
		echo "The file ". basename( $_FILES["pic"]["name"]). " has been uploaded. <br/>";

        // echo "<img src='animals/$image'/>";  
			$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
			$insertQuery = "insert into animal values ('','$sectionName','$animalName','$image','$about',$howMuch)";
			$result = mysqli_query($con, $insertQuery);
			if(!$result) echo mysqli_error($con);
			else{
				header('location:animalFormXml.html');
				//echo "Successfully added";
			}

?>