<html>
<p>
Please select a table to backup.
<form action="backTables.php" method="POST">
	<select name="selectedTables" multiple>
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
	
	<br/><br/><input type="submit" name="submit" value="Click to backup the selected table(s)"/><br/>
	<p>The table will be downloaded and stored as "tableName.csv".</p>
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
	
	if(isset($_POST["submit"]))
	{
		$_SESSION['Tables_to_back_up'] = $_POST["selectedTables"];		
		//header("location: backTables.php");
	}
	
	mysqli_close($link);
?>



