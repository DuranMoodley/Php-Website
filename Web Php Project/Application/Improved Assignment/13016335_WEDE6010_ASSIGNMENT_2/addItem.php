<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add Item</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
		include("DBConn.php");
		include("aShopStyling.css");
		echo "<h1> Add Item </h2>";
?>
	<form name="AddItem" method = "post"  enctype="multipart/form-data">	
				<p>Item Id : <input type = "text" name= "itemId" />
				<p><input type="file" name="imageToUpload" id="imageToUpload">
				<p>Item Description : <input type = "text" name= "description"  />
				<p>Item Quantity : <input type = "text" name = "quantity" />
				<p>Item Cost Price R: <input type = "text" name = "costPrice" />
				<p>Item Selling Price R: <input type = "text" name = "sellingPrice" />
				<p><input type = "reset" value = "Clear" />&nbsp;
				&nbsp; <input type = "Submit" value = "Submit" name = "AddItem"/>
	</form>	
	<a href='<?php echo "admin.php?"?>'>Go Back</a><br>
<?php
	//*************************************************************
	function uploadImage()
	{
		//Uploads an image file by opening up the open file dialog
		if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], "images/" . $_FILES["imageToUpload"]["name"]) === FALSE)  
		{			
			echo "Could not move uploaded ﬁle to \"images/"; 
		}
		else 
		{     
			chmod("images/" .$_FILES["imageToUpload"]["name"],0644);    
			echo "Successfully uploaded \"images/" . htmlentities($_FILES["imageToUpload"]["name"]) ."\"<br/>\n"; 
		}
	}
	//*************************************************************
	buttonClick();
	//*************************************************************				
	function buttonClick()
    {
		//Handles the button click events
	    if(isset($_POST['AddItem']))
		{				
			uploadImage();
			if(validation())
			{
				sendToDatabase();
			}
			
			if(isset($_POST['Clear']))
			{
				$_POST['username'] = "";
				$_POST['surname'] = "";
				$_POST['email'] = "";
				$_POST['password'] = "";
			}
		}
	}
//---------------------------------------------------------------------------//
	function sendToDatabase()
	{
		//Sends the relevant items to the item table
		include("DBConn.php");
		$itemId =  $_POST['itemId'];
		$description = $_POST['description'];
		$quantity = $_POST['quantity'];
		$costPrice = $_POST['costPrice'];
		$sellingPrice = $_POST['sellingPrice'];
		
		//Insert the user entered values into db
		$SQLString = "INSERT INTO tbl_item".
					 "(itemId,Description,CostPrice,Quantity, SellPrice)".
					 "VALUES ('$itemId','$description','$costPrice','$quantity','$sellingPrice')" ;
					 $QueryResult = mysqli_query ($Dbconnect,$SQLString);
			
		//Checks if the query was successful
		if ($QueryResult === FALSE)
		{
			echo "<p> Unable to update table </p>" .  "<p>Error code" . mysqli_errno($Dbconnect). ":". mysqli_error ($Dbconnect)."</p>";
		}
		else 
		{
			echo "<p> Successfully added </p>";
		}	
	}
//---------------------------------------------------------------------------//
function validation()
	{
		    //Fills the variables with user input
			$itemId =  $_POST['itemId'];
			$description = $_POST['description'];
			$quantity = $_POST['quantity'];
			$costPrice = $_POST['costPrice'];
			$sellingPrice = $_POST['sellingPrice'];
			$isFieldsValid = TRUE;
			
			//Trim
			$itemId = trim($itemId);
			$description = trim($description);
			$quantity = trim($quantity);
			$costPrice = trim($costPrice);
			$sellingPrice = trim($sellingPrice);
			
			//Check Null values
			if(empty($itemId))
			{
				echo "<p> Field Item Id Empty </p>";
				$isFieldsValid = FALSE;
			}
			if(empty($description))
			{
				echo "<p> Field Description is Empty </p>";
				$isFieldsValid = FALSE;
			}
			if(empty($quantity))
			{
				echo" <p> Field Quantity is Empty </p> ";
				$isFieldsValid = FALSE;
			}
			if(empty($costPrice))
			{
				echo" <p> Field CostPrice is Empty </p> ";
				$isFieldsValid = FALSE;
			}
			if(empty($sellingPrice))
			{
				echo" <p> Field SellPrice is Empty </p> ";
				$isFieldsValid = FALSE;
			}
			//If fields are still valid, user preg match for further checking
			if($isFieldsValid === TRUE)
			{
					if (preg_match("/^[A-Za-z]+/",$description)== 0) 
					{				
						echo " <p>Description is invalid.</p>";
						$isFieldsValid = FALSE;						
					}	
					if (preg_match("/[0-9]/",$sellingPrice)== 0) 
					{				
						echo " <p> Selling Price is invalid. </p>";  
						$isFieldsValid = FALSE;
					}	
					if (preg_match("/[0-9]/",$quantity) == 0) 
					{				
						echo " <p> Quantity is invalid. </p>";  
						$isFieldsValid = FALSE;
					}	
					if (preg_match("/[0-9]/",$costPrice) == 0) 
					{				
						echo " <p> Cost Price is invalid. </p>";  
						$isFieldsValid = FALSE;
					}	
					if (preg_match("/[0-9]/",$itemId) == 0) 
					{				
						echo " <p> Item Id is invalid. </p>";  
						$isFieldsValid = FALSE;
					}	
			}
			return $isFieldsValid;
		}
		//---------------------------------------------------------------------------//
?>
</body>
</html>