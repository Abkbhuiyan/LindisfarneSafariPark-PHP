<?php
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else{ 
			include_once('header.php');
		$con=mysqli_connect("localhost","root","","lindisfarne_safari_park");
		if($_POST){
			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$dob = $_POST['dob'];
			$gender = $_POST['gender'];
			$address = $_POST['address'];
			$postCode = $_POST['postCode'];
			$country = $_POST['country'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			if ($password != $cpassword) echo "Password did not match";
			else {
				$updateQuery="update user set firstName='$firstName',lastName='$lastName',dob='$dob',gender='$gender',address='$address',postCode='$postCode',country='$country',email='$email',phone='$phone',password='$password' where username='$username'";
				$result = mysqli_query($con, $updateQuery);
				if(!$result) echo mysqli_error($con);
				else{
					echo "Information successfully updated";
					header('location: userAccount.php');
				} 
			}
			
		}


		if($_GET){
			$username = $_GET['username'];
			$selectQuery="select * from user where username='$username'";
			$result=mysqli_query($con,$selectQuery)or die("Error: ".mysqli_error($con));
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$sex = $row['gender'];
			echo "<form action='updateUser.php' method='post' onSubmit='return validate(this)'>
					<table align='center' cellpadding='10px' style='background: #aabbcc; font-family: Arial; font-size: 30px'>
						<caption>Update User Details</caption>
						<tr>
							<td><label for='firstName'>First Name</label></td>
							<td>:<input type='text' id='firstName' name='firstName' value=".$row['firstName']." /></td>
						</tr>
						<tr>
							<td><label for='lastName'>Last Name</label></td>
							<td>:<input type='text' id='lastName' name='lastName' value=".$row['lastName']." /></td>
						</tr>
						<tr>
							<td><label for='dob'>Date Of Birth</label></td>
							<td>:<input type='Date' id='dob' name='dob' value=".$row['dob']." /></td>
						</tr>
						
						
						<tr>
							<td><label for='gender'>Gender</label></td>
							<td>:<input type='radio' id='male' name='gender' value='Male'"; if($sex == 'Male') echo "checked"; echo "/>
							<label for='male'>Male </label>
							<input type='radio' id='female' name='gender' value='Female'"; if($sex == 'Female') echo "checked";echo "/> 
							<label for='female'>Female </label>
							<input type='radio' id='other' name='gender' value='Other'"; if($sex == 'Other') echo "checked"; echo "/> 
							<label for='other'>Other </label></td>
						</tr>
							
							
						
						<tr>
							<td><label for='address'>Address</label></td>
							<td>:
							<textarea rows='5' cols='35' id='address' name='address'>
							".$row['address']."
							</textarea>
							</td>
						</tr>
						<tr>
							<td><label for='postCode'>Post Code</label></td>
							<td>:<input type='text' id='postCode' name='postCode' value=".$row['postCode']." /></td>
						</tr>
						<tr>
							<td><label for='country'>Country</label></td>
							<td>:<input type='text' id='country' name='country' value=".$row['country']." /></td>
						</tr>
						<tr>
							<td><label for='email'>Email </label> </td>
							<td>: <input type='email' id='email' name='email' value=".$row['email']." /> </td>
						</tr>
						<tr>
							<td><label for='phone'>Phone</label></td>
							<td>:<input type='text' id='phone' name='phone' value=".$row['phone']." /></td>
						</tr>
						<tr>
							<td><label for='username'>Username </label> </td>
							<td>: <input type='uname' id='username' name='username' value=".$row['username']."  readonly /> </td>

						</tr>
						<tr> 
							<td><label for='password'>Password </label> </td>
							<td>: <input type='password' id='password' name='password' value=".$row['password']." /> </td>
						</tr>
				
						<tr> 
							<td><label for='cpassword'>Confirm Password </label> </td>
							<td>: <input type='password' id='cpassword' name='cpassword' value=".$row['password']." /> </td>
						</tr>
						<tr> 
							<td colspan='2' align='right'>

							<input type='submit' value='Update' /></td>
						</tr>

					</table>
				</form>";
			}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update User Details</title>
	<script type="text/javascript">
			function validate(form)
			{
				fail=""
				fail += validateFirstName(form.firstName.value)
				fail += validateLastName(form.lastName.value)
				fail +=validateUsername(form.username.value)
				fail += validatePassword(form.password.value)
				fail += validateCPassword(form.password.value, form.cpassword.value)
				fail += validateEmail(form.email.value)

				if (fail=="") return true
					else{alert(fail); return false}
			}
			function validateFirstName(field){
				if (field=="") return "No First Name was Entered \n"

				else if (/[^a-zA-Z-.]/.test(field)) return "Invalid data, Only alphabets are allowed in First Name. \n"
				return ""
			}
			
			function validateLastName(field){
				if (field=="") return "No Last Name was Entered \n"
				else if (/[^a-zA-Z-.]/.test(field)) return "Invalid data, Only alphabets are allowed in Last Name. \n"
				return ""
			}
			
			function validateUsername(field){
				if (field == "") return "No Username Was Entered \n"
				else if (field.length < 5) return "Username Must be at least 5 Characters \n"
				else if (/[^a-zA-Z0-9_-]/.test(field)) return "Only a-z, A-Z, 0-9, - and _ allowed in Username \n"
					return ""
			}
			function validatePassword(field){
				if (field == "") return "No Password Was Entered \n"
				else if(field.length < 6) return "Password Must be at least 6 characters"
				else if (!/[a-z]/.test(field) ||!/[A-Z]/.test(field) ||!/[0-9]/.test(field)) return "Password Require one each of a-z, A-Z, 0-9\n"
				return ""	
			}
			function validateCPassword(field1, field2){
				if (field1 != field2) return "Password mismatched \n"
				return ""	
			}

			function validateEmail(field){
				if(field == "") return "No Email Was Enterd \n"
				else if (field.indexOf(".") !>1 || (field.indexOf("@")!=1) || /[^a-zA-Z0-9@._-]/.test(field)) return"Invalid Email Address\n"
				return ""
			}


		</script>
</head>
</html>