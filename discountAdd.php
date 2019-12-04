<?php  
	session_start();
 	if($_SESSION['login']!=true)
	header('location:login.html');
	else if ( $_SESSION['userType'] != "admin") 
	header('location:home.php');
	else{
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php include_once('header.php');?>
	<form action="addDiscount.php" method="post">
			<table align="center" cellpadding="10px" style="background: #aabbcc; font-family: Arial; font-size: 20px">
				<caption>Discount add form</caption>
				<tr>
					<td><label for="discountStartDate">Discount Date</label></td>
					<td>:<input type="Date" id="discountStartDate" name="discountStartDate" /></td>
				</tr>
				<tr>
					<td><label for="discountEndDate">Discount End Date</label></td>
					<td>:<input type="date" id="discountEndDate" name="discountEndDate" /></td>
				</tr>

				<tr>
					<td><label for="discountRate">Discount Rate</label></td>
					<td>:<input type="text" id="discountRate" name="discountRate" /></td>
				</tr>
			
				<tr> 
					<td colspan="2" align="center"><input type="submit" value="Add Discount" /></td>
				</tr>

			</table>
		</form>
</body>
</html>
<?php } ?>