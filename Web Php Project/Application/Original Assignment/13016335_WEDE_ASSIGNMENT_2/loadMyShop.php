<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Create Table</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
   //Create a string consisting of the sql create statements
   $createCustomer =  "CREATE TABLE tbl_customer(custId INT(10) UNSIGNED AUTO_INCREMENT , custName VARCHAR(30), 
							 custSurname VARCHAR(30),
							 custEmail VARCHAR(30),
							 custPassword VARCHAR(100),
							 constraint pk_cust PRIMARY KEY (custId)) ENGINE=InnoDB;";
	$createItem = "CREATE TABLE tbl_item(itemId VARCHAR(50), Description VARCHAR(50), 
			             CostPrice NUMERIC(15,2),
						 Quantity NUMERIC,
						 SellPrice NUMERIC(15,2),
						 constraint pk_item PRIMARY KEY (itemId)) ENGINE=InnoDB;";
	
	$createOrder = "CREATE TABLE tbl_order(orderId VARCHAR(100), 
	                                      itemId VARCHAR(50),
										  custId INT(10) UNSIGNED AUTO_INCREMENT,
										  PRIMARY KEY(orderId,itemId,custId),
										  INDEX (itemId),
										  INDEX (custId),
										  FOREIGN KEY (itemId)
										  REFERENCES tbl_item(itemId)
										  ON UPDATE CASCADE ON DELETE RESTRICT,									 
										  FOREIGN KEY (custId)
										  REFERENCES tbl_customer(custId)
										  ON UPDATE CASCADE ON DELETE RESTRICT) ";
	//Parse those values into method
   checkTableExists("tbl_customer",$createCustomer);
   checkTableExists("tbl_item",$createItem);
   checkTableExists("tbl_order",$createOrder);	
//----------------------------------------------------------------------------------------------//
function checkTableExists($TableName , $createString)
{
	include("DBConn.php");
	$SQLstring = "SHOW TABLES LIKE '$TableName'";
		
	if ($QueryResult = mysqli_query($Dbconnect,$SQLstring))
	{
		$numRows = mysqli_num_rows($QueryResult);	
	}
	
	//Check if table has any rows
	if ($numRows  == 0 ) 
	{	
		createTables($TableName , $createString);
	}
	else
	{
		//If table contains a rows, its exist
		if($TableName == "tbl_order")
		{
			$SQLstring = "DROP TABLE $TableName";
			$QueryResult = mysqli_query($SQLstring,$Dbconnect);
			if($QueryResult === FALSE)
			{
				echo "Error";
			}
			else
			{
				echo "<p> Table Dropped </p>";	
				//createTables($TableName , $createString);
			}
		}
	}	
}
//----------------------------------------------------------------------------------------------//
function createTables($TableName , $create)
{
	include("DBConn.php");
	//After table has been drop re-create it
	$QueryResult = mysqli_query($Dbconnect,$create);
	if($QueryResult === FALSE)
	{
		echo "Error".  "<p>Error code" . mysqli_errno($Dbconnect). ":". mysqli_error ($Dbconnect)."</p>";
	}
	else
	{
		echo "Table re-created";
	}	
 }
?>
</body>
</html>