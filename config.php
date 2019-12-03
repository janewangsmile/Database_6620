<?php
// connect to the database:
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
if($link === false){
	die("ERROR: Could not connect.");}
else{
echo '<div align="center">'."Database Connected Successfully".'</div>';
}
?>



