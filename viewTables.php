<html>
<p>
Please select the table to view.
<form action="" method="POST">
	<select name="viewTables">
		<option value="Please select a table">Select...</option>
		<option value="users">users</option>
		<option value="lobbyists">lobbyists</option>
		<option value="clients">clients</option>
		<option value="employers">employers</option>
		<option value="combinations">combinations</option>
		<option value="compensations">compensations</option>
		<option value="contributions">contributions</option>
		<option value="expenditures">expenditures</option>
		<option value="gifts">gifts</option>
	</select>
	<input type="submit" value="Click to view table information"/><br/><br/>
</form>
</p>
</html>

<?php 
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
	
	if(isset($_POST['viewTables']))
	{
		$_SESSION["tableName"] =$_POST['viewTables'];
		header("location: index.php");
	}
?>

