<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Edit Item</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<?php
	 include("class_eShop.php");
	 include("aShopStyling.css");
	 
	 //Initialize variables and objects
	 $newStore = unserialize($_SESSION['editItem']); 
	 $arrayLength = count($newStore->userCart); 	 
	 $_SESSION['editItem'] = serialize($newStore);
	 $itemDescription = "";
	 $itemQuantity = "";
	 $itemSellingPrice = 0;
	 	 
	getItemDetails($arrayLength,$newStore, $itemDescription,$itemQuantity,$itemSellingPrice);
	//*********************************************************************
	function getItemDetails($arrayLength,$newStore, $itemDescription,$itemQuantity,$itemSellingPrice)
	{
		//Get the item id number to edit
		include("DBConn.php");
		$itemId = 1001;
		$itemUpdatedId ;
		
		//Loop through object array (user cart) ,
		for($count = 0 ; $count<$arrayLength; $count++)
		{
			if(array_key_exists($itemId,$newStore->userCart))
			{
				//if the element is bigger than 0, get item id of that element
				if(($newStore->userCart[$itemId]) > 0)
				{
					//Run query to extract the details of that element 
					$SQLString = "SELECT * FROM tbl_item WHERE itemId = $itemId";
					$QueryResult = mysqli_query($Dbconnect,$SQLString);
					while(($rowRecord = mysqli_fetch_assoc($QueryResult)) == TRUE)
					{
						//Put associative element into variables 
						echo "<p> Item Id Number : $itemId</p>"; 
						$itemDescription = $rowRecord['Description'];
						$itemQuantity = $rowRecord['Quantity'];
						$itemSellingPrice = $rowRecord['SellPrice'];
					}
					$itemUpdatedId = $itemId;
					break;
				}
				$itemId++;
			}
			else
			{
				$itemId++;
			}
		}
		
		//Parse those variable into the display form method, so that user can see the item details 
		displayForm($itemDescription,$itemQuantity,$itemSellingPrice , $itemUpdatedId);
	} 
	//***********************************************************************
	function displayForm($itemDescription,$itemQuantity,$itemSellingPrice ,$itemUpdatedId)
	{
		//Show the item details on the form, allow user to make the neccessary changes
		?>
			<form name="Edit Item Details" method = "post">				
				<p>Description : <input type = "text" name= "description" value='<?php echo $itemDescription ?>'</p>
				<p>Selling Price : <input type = "text" name= "sellingprice"  value='<?php echo $itemSellingPrice ?>'</p>
				<p>Quantity Remaining : <input type = "text" name = "amountRemaining" value='<?php echo $itemQuantity ?>'</p>
				<p><input type = "reset" value = "Clear" />&nbsp;
				&nbsp; <input type = "Submit" value = "Submit" name = "Submit"/>
			</form>	
		<?php
		echo "<a href='admin.php?PHPSESSID=".session_id()."'>Go Back</a><br>";
		
		//Checks button clicks 
		if(isset($_POST['Submit']))
		{	
			if(validation())
			{
				sendToDatabase($itemUpdatedId);		
			}			
		}
		if(isset($_POST['Clear']))
		{
			$_POST['description'] = "";
			$_POST['sellingprice'] = "";
			$_POST['amountRemaining'] = "";
		}
	}
	//***********************************************************************
	function validation()
	{
			$decription = $_POST['description'];
			$sellingprice = $_POST['sellingprice'];
			$amountRemaining = $_POST['amountRemaining'];
			$isFieldsValid = TRUE;
			
			//Trim
			$decription = trim($decription);
			$sellingprice = trim($sellingprice);
			$amountRemaining = trim($amountRemaining);
			
			//Check Null values
			if(empty($decription))
			{
				echo "<p> Field decription Empty </p>";
				$isFieldsValid = FALSE;
			}
			if(empty($sellingprice))
			{
				echo "<p> Field selling price is Empty </p>";
				$isFieldsValid = FALSE;
			}
			if(empty($amountRemaining))
			{
				echo" <p> Field amountRemaining is Empty </p> ";
				$isFieldsValid = FALSE;
			}
			//If fields are still valid, user preg match for further checking
			if($isFieldsValid === TRUE)
			{
					if (preg_match("/^[A-Za-z]+/",$decription)== 0) 
					{				
						echo " <p>Username is invalid.</p>";
						$isFieldsValid = FALSE;						
					}				
								
					if (preg_match("/[0-9]/",$sellingprice)== 0) 
					{				
						echo " <p> Surname is invalid. </p>";  
						$isFieldsValid = FALSE;
					}	
					if (preg_match("/[0-9]/",$amountRemaining) == 0) 
					{				
						echo " <p> Quantity is invalid. </p>";  
						$isFieldsValid = FALSE;
					}					
			}
			return $isFieldsValid;
		}
		//---------------------------------------------------------------------------//
	function sendToDatabase($itemUpdatedId)
	{
		//Send all items details to db and update it
		include("DBConn.php");
		$decription = $_POST['description'];
		$sellingprice = $_POST['sellingprice'];
		$amountRemaining = $_POST['amountRemaining'];
		
		//Insert the user entered values into db
		$SQLString = "UPDATE tbl_item SET Description = '$decription' , SellPrice = $sellingprice, Quantity = $amountRemaining 
					 WHERE itemId = '$itemUpdatedId'";
		$QueryResult = mysqli_query ($Dbconnect,$SQLString);
								
					if ($QueryResult === FALSE)
					{
						echo "<p> Unable to update table </p>" .  "<p>Error code" . mysqli_errno($Dbconnect). ":". mysqli_error ($Dbconnect)."</p>";
					}
					else 
					{
						echo "<p> Successfully Updated </p>";
					}	
	}
	//---------------------------------------------------------------------------//
	?>	
</body>
</html>