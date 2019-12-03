<?php 
session_start();

// connects to the database
require_once "config.php";

$query = "SELECT username, firstName, lastName, age, telephoneNumber, emailAddress,street,city,state,zipCode FROM profile WHERE username = '".$_SESSION['username']."'";
if($result = $link->query($query))
{
    while($row = $result->fetch_assoc())
    {
        echo "<div align=\"center\">";
        echo "<br />Your <b><i>Profile</i></b> is as follows:<br />";
        echo "<br /><b>Username: </b> ". $row['username'];
        echo "<br /><b>First name: </b> ". $row['firstName'];
        echo "<br /><b>Last name: </b> ".$row['lastName'];
        echo "<br /><b>Age: </b> ".$row['age'];
        echo "<br /><b>Phone Number: </b> ".$row['telephoneNumber'];
        echo "<br /><b>Email: </b> ".$row['emailAddress'];
        echo "<br /><b>Street: </b> ".$row['street'];
        echo "<br /><b>City: </b> ".$row['city'];
        echo "<br /><b>State: </b> ".$row['state'];
        echo "<br /><b>Zip Code: </b> ".$row['zipCode'];
        echo "</div>";   
        
        // check the logged user, return to different welcome page according to user type
        echo "</br><center>";
		if($row['username']=="admin")
		{
			echo "<a href='welcome_admin.php' class='btn btn-primary'>Back to the main page</a>";
		}
		else
		{
			echo "<a href='welcome.php' class='btn btn-primary'>Back to the main page</a>";
		}
		echo "</center>";
    	}
    
	$result->free();
    
}
else
{
    echo "No results found";
}
?>

<html>
<head>
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
		margin: 10px 0px 15px 0px;
		box-shadow: 1px 1px 2px 1px grey;
	}
</style>
</head>
