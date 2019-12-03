<html>
<body>
<p>
	<center>
	<a href="viewTables.php" class="btn btn-primary"> Back to table selection page</a><br/>
	</center>
</p>
<?php 
	session_start();
	require_once "config.php";
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
	
	
	$table = $_SESSION["tableName"];
	if($table)
	{
		echo "Table information for: "."<b>".$table."</b><br/><br/>";
		// page is the current page, if not set, defalut is 1
		$page = isset($_GET['page'])?$_GET['page']:1;
		$per_page = 25;
		$offset = ($page-1)*$per_page;
		
		echo "Page # (current page in red)      ";
		// **** paging section here ****
		// ***** for 'first' and 'previous' pages
		if($page>1){
			echo "<a href='" . $_SERVER['PHP_SELF'] . "' title='Go to the first page.' class='customBtn'>";
        	echo "<span style='margin:0 .5em;'> << </span>";
    		echo "</a>";
    		// ********** show the previous page
    		$prev_page = $page - 1;
    		echo "<a href='" . $_SERVER['PHP_SELF'] . "?page={$prev_page}' title='Previous page is {$prev_page}.' class='customBtn'>";
        	echo "<span style='margin:0 .5em;'> < </span>";
    		echo "</a>";
		}
		// show the number paging
		
		// find out total pages
		$query = "SELECT * FROM ".$table;
		$result = mysqli_query($link,$query);

		$total_rows = mysqli_num_rows($result);
		$total_pages = ceil($total_rows / $per_page);
 
		// range of num links to show
		$range = 2;
 
		// display links to 'range of pages' around 'current page'
		$initial_num = $page - $range;
		$condition_limit_num = ($page + $range)  + 1;
		 
		for ($x=$initial_num; $x<$condition_limit_num; $x++) {
		     
 		   // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
		    if (($x > 0) && ($x <= $total_pages)) {
		     
		        // current page
		        if ($x == $page) {
		            echo "<span class='customBtn' style='background:red;'>$x</span>";
		        } 
		         
		        // not current page
		        else {
		            echo "<a href='{$_SERVER['PHP_SELF']}?page=$x' class='customBtn'>$x</a> ";
		        }
		    }
		}
		// for next and last pages
		if($page<$total_pages){
		// ********** show the next page
			$next_page = $page + 1;
			echo "<a href='" . $_SERVER['PHP_SELF'] . "?page={$next_page}' title='Next page is {$next_page}.' class='customBtn'>";
        	echo "<span style='margin:0 .5em;'> > </span>";
    		echo "</a>";
     
    		// ********** show the last page
    		echo "<a href='" . $_SERVER['PHP_SELF'] . "?page={$total_pages}' title='Last page is {$total_pages}.' class='customBtn'>";
        	echo "<span style='margin:0 .5em;'> >> </span>";
    		echo "</a>";
		}
		
		
		
		$query = "SELECT * FROM ".$table." LIMIT ".$offset.",".$per_page;
		$result = mysqli_query($link,$query);
		
		if(!$result)
		{
			$message = 'ERROR:'.mysql_error();
			return $message;
		}
		else
		{
			$i=0;
			echo '<html><head><style>table,th,td{border: 0.5px solid black;}</style></head><body><table><tr>';
			while($i < mysqli_num_fields($result))
			{
				$meta = mysqli_fetch_field_direct($result,$i);
				echo '<th>'.$meta->name.'</th>';
				$i = $i + 1;
			}
			echo '</tr>';
			
			$i = 0;
			while($row = mysqli_fetch_row($result))
			{
				echo '<tr>';
				$count = count($row);
				$y = 0;
				while ($y < $count)
				{
					$c_row = current($row);
					echo '<td>'.$c_row.'</td>';
					next($row);
					$y = $y + 1;
				}
				echo '</tr>';
				$i = $i + 1;
			}
			echo '</table></body></html>';
			mysqli_free_result($result);
		}
		
				
		mysqli_close($link);
	}
?>
</body>
<html>



