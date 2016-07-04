<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<?php
		include("aShopStyling.css");
		include("DBConn.php");	
		include("class_eShop.php");
		
		//Checks if the class exists
		if (class_exists("FactoryClass")) 
		{     
			if (isset($_SESSION['editItem'])) 
			{
				$eStore = unserialize($_SESSION['editItem']);
			}
			else
			{
				$eStore = new FactoryClass();
			}
			$eStore->setValues();					
		}
		else
		{
			 $ErrorMsgs[] = "The Factoryclass is unavailable!";     
			 $Store = NULL; 
			 print_r($ErrorMsgs);
		}

	//Call methods to display the table and listen go Get Requests
	$eStore->showAdminTable();
	$eStore->processInput();
	$_SESSION['editItem'] = serialize($eStore);
	
	if(isset($_GET['Item']))
	{
		echo "<a href='editItem.php?PHPSESSID=".session_id()."'>Go to Edit Page</a><br>";
	}
	
	if(isset($_GET['DeleteItem']))
	{
		$itemIdToDlt = $_GET['DeleteItem'];
		deleteItem($itemIdToDlt);
	}
	//***********************************************
	function deleteItem($itemIdToDlt)
	{
		//Get item id that was selected
		//Insert that into delete sql statements
		include("DBConn.php");
		$SQLString = "DELETE FROM tbl_order WHERE itemId = '$itemIdToDlt'";
		$QueryResult = mysqli_query ($Dbconnect,$SQLString);
		if ($QueryResult === FALSE)
		{
			echo "<p> Unable to Delete Record </p>" .  "<p>Error code" . mysqli_errno($Dbconnect). ":". mysqli_error ($Dbconnect)."</p>";
		}
		else 
		{
			//After Parent record is deleted, delete child record
			$SQLString = "DELETE FROM tbl_item WHERE itemId = '$itemIdToDlt'";
			$QueryResult = mysqli_query ($Dbconnect,$SQLString);
			if ($QueryResult === FALSE)
			{
				echo "<p> Unable to update table </p>" .  "<p>Error code" . mysqli_errno($Dbconnect). ":". mysqli_error ($Dbconnect)."</p>";
			}
			else 
			{
				echo "<p> Successfully Deleted </p>";
			}	
		}			
	}
	?>
	 <a href='<?php echo "addItem.php?". SID?>'>Add Item</a><br>	
	 <a href='<?php echo "startUp.php?". SID?>'>Home</a>
</body>
</html>