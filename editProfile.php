<html>
<head>
<title> Update Personal Information</title>
<style>
	body{
		background-color: skyblue;
	}
	input{
		width: 40%;
		height: 5%;
		border: 1px;
		border-radius: 05px;
		padding: 8px 15px 8px 15px;
		margin: 5px 0px 5px 0px;
		box-shadow: 1px 1px 2px 1px grey;
	}
</style>
</head>
<body>
	<center>
	<h1> Update Personal Information </h1>
	
		<form action="" method="POST">
			<input type="text" name="username" placeholder="Enter username"/><br/>
			<input type="text" name="firstName" placeholder="Enter First Name"/><br/>
			<input type="text" name="lastName" placeholder="Enter Last Name"/><br/>
			<input type="text" name="age" placeholder="Enter Age"/><br/>
			<input type="text" name="telephoneNumber" placeholder="Enter Phone Number"/><br/>
			<input type="text" name="emailAddress" placeholder="Enter Email"/><br/>
			<input type="text" name="street" placeholder="Enter Street"/><br/>
			<input type="text" name="city" placeholder="Enter City"/><br/>
			<input type="text" name="state" placeholder="Enter State"/><br/>
			<input type="text" name="zipCode" placeholder="Enter Zip Code"/><br/>
			
			<input type="submit" name="update" value="Click to Update Profile"/><br/>
		</form>
		
	</center>
</body>
</html>

<?php
// Include config file
require_once "config.php";
session_start();

// check the logged user, return to different welcome page according to user type
echo "</br><center>";
if($_SESSION["username"]=="admin")
{
	echo "<a href='welcome_admin.php' class='btn btn-primary'>Back to the main page</a>";
}
else
{
	echo "<a href='welcome.php' class='btn btn-primary'>Back to the main page</a>";
}
echo "</center>";


if(isset($_POST['update']))
{
	$username = $_POST['username'];
	$fName = $_POST['firstName'];
	$lName = $_POST['lastName'];
	$age = $_POST['age'];
	$phone = $_POST['telephoneNumber'];
	$email = $_POST['emailAddress'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipCode'];
	
	$query = "UPDATE profile SET firstName='$fName',lastName='$lName',age='$age',telephoneNumber='$phone',emailAddress='$email',street='$street',city='$city',state='$state',zipCode='$zipcode' WHERE username='$username'";
	$query_run = mysqli_query($link,$query);
	
	$sql = "SELECT * FROM profile WHERE username='$username'";
	$result = mysqli_query($link,$sql);
	$num_rows = mysqli_num_rows($result);
	
	// feedback message:
	if($_SESSION["username"]=="admin" or $_SESSION["username"]==$username)
	{
		if($query_run and $num_rows>0)
		{
			echo "<br>";
			echo '<div align="center">'.'<font color="red">'.'Personal information has been saved.'.'</font>'.'</div>';
			echo "<br>";
		
		}
		else
		{
			echo "<br>";
			echo '<div align="center">'.'<font color="red">'.'!!!!!!!!!Warning: Can not find this username! Please check!!!!!!!!!!!!'.'</font>'.'</div>';
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
		}
	}
	else
	{
		echo "<br>";
		echo '<div align="center">'.'<font color="red">'.'!!!!!!!!!Warning: no authorization! Please check username!!!!!!!!!!!!'.'</font>'.'</div>';
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<br>";
	}
	
}
mysqli_close($link);

?>
