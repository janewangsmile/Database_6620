<?php 
// connect to database
function OpenCon()
{
     $dbhost = "mysql1.cs.clemson.edu";
     $dbuser = "JunDatabase_2v38";
     $dbpass = "dygdb2019%";
     $db = "JunDatabase_1fmh";
     $link = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $link -> error);
     
     return $link;
}
     
$link = OpenCon();


if(isset($_POST["submit"]))
{		
	//session_start();
	header('Content-Type: text/csv; charset=utf-8');
	
	//$_SESSION['Tables_to_back_up'] = $_POST["selectedTables"];	
	$table = $_POST["selectedTables"];

	//foreach($tables as $table)
	//{
		header("Content-Disposition: attachment; filename=".$table);
		$output = fopen("php://output","w");
		// get the column names:
		$query = "SELECT * FROM ".$table;
		$result = mysqli_query($link,$query);
		
		$columns=array();
		$i=0;
		while($i < mysqli_num_fields($result))
		{
			$meta = mysqli_fetch_field_direct($result,$i);
			$columns[]=$meta->name;
			$i = $i + 1;
		}
		
		fputcsv($output, $columns);
		
		$query = "SELECT * FROM ".$table;
		$result = mysqli_query($link,$query);
		while($row=mysqli_fetch_assoc($result))
		{
			fputcsv($output, $row);
		}
		fclose($output);
	//}
	mysqli_close($link);
}

?>



