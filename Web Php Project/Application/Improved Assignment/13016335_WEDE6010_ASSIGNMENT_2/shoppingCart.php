<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Your Cart</title>
</head>
<h1>Your Shopping Cart</h1>
<body>
<?php
	 include("class_eShop.php");
	 include("aShopStyling.css");
	 
	 //Initialize variables and objects
	 $newStore = unserialize($_SESSION['eStore']);
	 $itemId = 1001;
	 $subTotal = 0;
	 $total = 0;
	 $arrayLength = count($newStore->userCart);
	 $orderDetails = array();
	 $rowCounter = 0;

//*******************************************************************************************	 
	 //Display Table headings
	 echo "<table width = '100%' height = '50%' id= tblShop>\n";
	 echo "<tr><th>Item Id</th>
	 <th>Image</th>
	 <th>Description</th>
	 <th>Quantity Ordered</th>
	 <th>Sell Price</th>
	 <th>Sub Total</th>
	 <th>Edit Order</th></tr>\n";  
	 
	 //Loop through user cart array
	 for($count = 0 ; $count<$arrayLength;$count++)
	 {
		if(array_key_exists($itemId,$newStore->userCart))
		{
			 //Check if element is bigger than 0
			if(($newStore->userCart[$itemId]) > 0)
			{
				//if true, run sql statement to pull details of that item
				$SQLString = "SELECT * FROM tbl_item WHERE itemId = $itemId";
				$QueryResult = mysqli_query($Dbconnect,$SQLString);
				while(($rowRecord = mysqli_fetch_assoc($QueryResult)) == TRUE)
				{		
						$subTotal = ($rowRecord['SellPrice'] * $newStore->userCart[$itemId]);
						echo "<tr><td>{$rowRecord['itemId']} </td>";	
						echo "<td><img src= images/$itemId.jpg width = 60 height = 60/></td>\n";
						echo "<td>{$rowRecord['Description']}</td>";
						echo "<td>{$newStore->userCart[$itemId]}</td>";
						printf("<td class='currency'>R%.2f </td>\n", $rowRecord['SellPrice']);
						printf("<td class='currency'>R%.2f </td>\n", $subTotal);
						echo "<td><a href= 'myShop.php?PHPSESSID=".session_id()."&Item=$itemId'>Add</a><br/>";	
						echo "<a href='myShop.php?PHPSESSID=".session_id()."&RemoveItem=$itemId'>Remove Item</a></td>";
				};	
				$total += $subTotal;
			}
			$itemId++;
		}
		else
		{
			$itemId++;
		}
	 }
	 echo "<tr><td colspan='5'>Total</td>\n"; 
	 printf("<td class='currency'>R%.2f </td></tr>\n", $total); 
	 echo"</table>";	 
//*******************************************************************************************	 
	 $_SESSION['eStore'] = serialize($newStore); 
	echo "<a href='myShop.php?PHPSESSID=".session_id()."&ClearCart=TRUE'>Empty Cart</a><br>";
	echo "<a href='myShop.php?PHPSESSID=".session_id()."'>Continue</a><br>";
	echo "<td><a href='".$_SERVER['SCRIPT_NAME']."?PHPSESSID=".session_id()."&checkOut=true'>Check Out</a><br>\n";	
//*******************************************************************************************	
	//Check for get response
	if(isset($_GET['checkOut']))
	{
		//Check if cookie contains anything
		if(isset($_COOKIE['password']))
		{
			echo "<p>Are you sure you want to Check out? <br> Please Click Confirm to Save your order and Check out<br> Your Order number is :<p>".session_id()."<br>";
			echo "<td><a href='".$_SERVER['SCRIPT_NAME']."?PHPSESSID=".session_id()."&confirm=TRUE'>Confirm Order</a></td>\n";
		}
		else
		{
			?>
			<script>
				window.open("loginPage.php","_self");
			</script>
			<?php
		}
	}
	
	//Check confirm get response, allow user to loggout
	if(isset($_GET['confirm']))
	{
		echo "<a href='myShop.php?PHPSESSID=".session_id()."&ClearCart=TRUE&LogOut=TRUE'>Logout</a><br>";
		
		//If user has confirmed order, call method to input order details into order table
		fillOrderDetailsArray($arrayLength, $newStore, $rowCounter);
	}
	//********************************************************************************
	function fillOrderDetailsArray($arrayLength, $newStore,$rowCounter)
	{
		//Takes the users shopping cart and fills the final shopping cart basket
		//This is only executed after user has agreed to check out
		include("DBConn.php");
		$itemId = 1001;
			for($count = 0 ; $count<$arrayLength;$count++)
			 {
				if(array_key_exists($itemId,$newStore->userCart))
				{
					if(($newStore->userCart[$itemId]) > 0)
					{
						//Run query to get item details and insert into order array
						$SQLString = "SELECT * FROM tbl_item WHERE itemId = $itemId";
						$QueryResult = mysqli_query($Dbconnect,$SQLString);
						while(($rowRecord = mysqli_fetch_assoc($QueryResult)) == TRUE)
						{		
								$orderDetails[$rowCounter][0] = session_id();
								$orderDetails[$rowCounter][1] = $rowRecord['itemId'];
								$orderDetails[$rowCounter][2] = getCustId();
						};	
					}
					$rowCounter++;
					$itemId++;
				}
				else
				{
				  $itemId++;
				}
			 }	
			 sendToOrderdb($orderDetails);	
	}
	//********************************************************************************
	function getCustId()
	{
	    //Get the customer id from db using pasword cookie as part of query where clause
		include("DBConn.php");
		$userPassword = $_COOKIE['password'];
		$custId;
		
		$SQLString = "SELECT custId FROM tbl_customer WHERE custPassword = MD5('$userPassword')";
		$QueryResult = mysqli_query($Dbconnect,$SQLString);
		if(($result = mysqli_fetch_assoc($QueryResult)) == TRUE)
		{
			 $custId = $result['custId'];
		}
		
		return $custId;
	}
	//********************************************************************************
	function sendToOrderdb($orderDetails)
	{
		include("DBConn.php");
		
		//Filter that array into database and insert all data into db
		$DBRecords = array_filter($orderDetails);
		$QueryResult;
		
		//Insert the necessary details into orders tables
		foreach ($DBRecords as $row)
		{
			$SQLString = "INSERT INTO tbl_order".
			"(orderId,itemId,custId)".
			"VALUES ('$row[0]','$row[1]','$row[2]')" ;
			$QueryResult = mysqli_query ($Dbconnect,$SQLString);										
		}	
		
		if ($QueryResult === FALSE)
		{
			echo "<p> Unable to update table </p>" .  "<p>Error code" . mysqli_errno($Dbconnect). ":". mysqli_error ($Dbconnect)."</p>";
		}
		else
		{
			echo "<p> Order has been Saved </p>";
		}
	}
?>
</body>
</html>