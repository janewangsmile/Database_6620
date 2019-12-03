<?php

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



if(isset($_POST["Import"]))
{
    // get the uploaded file name
	$file = $_FILES["file"]["name"];
	echo "Selected file: ".$file."</br></br>";
	echo "Logs: </br></br>";
    $table = str_replace('.csv','',$file);

// get structure from csv and insert db
ini_set('auto_detect_line_endings',TRUE);
$handle = fopen("./tables/".$file,'r');
// first row, structure
if ( ($data = fgetcsv($handle) ) === FALSE ) {
    echo "Cannot read from csv $file";die();
}
$fields = array();
$field_count = 0;
for($i=0;$i<count($data); $i++) {
    $f = trim($data[$i]);
    if ($f) {
        // normalize the field name, strip to 20 chars if too long
        $field_count++;
        $fields[] = $f.' VARCHAR(255)';
    }
}
// sql query to create the restored table
$sql = "CREATE TABLE $table (" . implode(', ', $fields) . ')';
echo $sql . "<br /><br />";
$result = mysqli_query($link,$sql);

// insert the values into restored table
$m=0;
while ( ($data = fgetcsv($handle) ) !== FALSE and isset($data[0])) {
    $fields = array();
    for($i=0;$i<$field_count; $i++) {
        	$fields[] = "'".$data[$i]."'";
    }
    $sql = "INSERT INTO ".$table." VALUES(".implode(', ', $fields).")";
    //echo $sql . "<br /><br />";
    $result = mysqli_query($link, $sql);
    
    if(!isset($result))
	{
		$m = $m+1;
		echo "<script type=\"text/javascript\">
				alert(\"Invalid File:Please Upload CSV File.\");
				window.location = \"recover.php\"
				</script>";		
	}
}
// feedback for successful import  
if($m==0) {
	echo "<script type=\"text/javascript\">
			alert(\"CSV File has been successfully Imported.\");
			</script>";
}
fclose($handle);
ini_set('auto_detect_line_endings',FALSE);
	
}	 
mysqli_close($link);
?>