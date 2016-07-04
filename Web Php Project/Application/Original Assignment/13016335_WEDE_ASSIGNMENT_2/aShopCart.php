<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Item</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
	include("class_eShop.php");
	
	//Checks if the class exists
	if (class_exists("FactoryClass")) 
	{     
		//Check if sessions contains an object
		if (isset($_SESSION['eStore'])) 
		{
			$eStore = unserialize($_SESSION['eStore']);
		}
		else 
		{           
			$eStore = new FactoryClass();  	
			$eStore->setValues();
		}		
		$eStore->processInput(); 		
	}
	else
	{
		 $ErrorMsgs[] = "The Factoryclass is unavailable!";     
		 $Store = NULL; 
		 print_r($ErrorMsgs);
	}

	$eStore->showTable();
	?>
		<a href='<?php echo "shoppingCart.php?". SID?>'>Shopping Cart</a><br>
		<a href='<?php echo "startUp.php?". SID?>'>Home</a>
	<?php
	$_SESSION['eStore'] = serialize($eStore); 
?>
</body>
</html>