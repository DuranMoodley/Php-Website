<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SQL dbConnect</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<?php
		$Dbname = "test";
		$Dbconnect = mysqli_connect("127.0.0.1","root");
		
		//Connect and select the db table
		if($Dbconnect === FALSE)
		{
			echo "<p> Connection Failed </p>\n";
		}
		else 
		{
			 if (mysqli_select_db($Dbconnect,$Dbname) === FALSE) 
			 {          
				echo "<p>Could not select the \"$Dbname\" " . " database: " . mysql_error($Dbconnect) . "</p>\n";  
			 } 	
		}	
	?>
</html>