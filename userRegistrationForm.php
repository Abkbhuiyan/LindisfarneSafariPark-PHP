<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
</head>
<body>
		<form action="createUser.php" method="post">
			<table align="center" cellpadding="10px" style="background: #aabbcc; font-family: Arial; font-size: 20px">
				<caption>User Registration Form</caption>
				<tr>
					<td><label for="firstName">First Name</label></td>
					<td>:<input type="text" id="firstName" name="firstName" /></td>
				</tr>
				<tr>
					<td><label for="lastName">Last Name</label></td>
					<td>:<input type="text" id="lastName" name="lastName" /></td>
				</tr>
				<tr>
					<td><label for="dob">Date Of Birth</label></td>
					<td>:<input type="Date" id="dob" name="dob" /></td>
				</tr>
				<tr>
					<td><label for="gender">Gender</label></td>
					<td>:<input type="radio" id="male" name="gender" value="Male" />
					<label for="male">Male </label>
					<input type="radio" id="female" name="gender" value="Female" /> 
					<label for="f">Female </label>
					<input type="radio" id="other" name="gender" value="Other" /> 
					<label for="other">Other </label></td>
				</tr>
				<tr>
					<td><label for="address">Address</label></td>
					<td>:
					<textarea rows="5" cols="35" id="address" name="address">
					</textarea>
					</td>
				</tr>
				<tr>
					<td><label for="postCode">Post Code</label></td>
					<td>:<input type="text" id="postCode" name="postCode" /></td>
				</tr>
				<tr>
					<td><label for="country">Country</label></td>
					<td>:<input type="text" id="country" name="country" /></td>
				</tr>
				<tr>
					<td><label for="email">Email </label> </td>
					<td>: <input type="email" id="email" name="email" /> </td>
				</tr>
				<tr>
					<td><label for="phone">Phone</label></td>
					<td>:<input type="text" id="phone" name="phone" /></td>
				</tr>
				<input type="hidden" id="userType" name="userType" value="user" />
				<tr>
					<td><label for="username">Username </label> </td>
					<td>: <input type="uname" id="username" name="username" /> </td>

				</tr>
				<tr> 
					<td><label for="password">Password </label> </td>
					<td>: <input type="password" id="password" name="password" /> </td>
				</tr>
		
				<tr> 
					<td><label for="cpassword">Confirm Password </label> </td>
					<td>: <input type="password" id="cpassword" name="cpassword" /> </td>
				</tr>
				<tr> 
					<td colspan="2" align="center"><input type="submit" value="Register" /></td>
				</tr>

			</table>
		</form>
</body>
</html>