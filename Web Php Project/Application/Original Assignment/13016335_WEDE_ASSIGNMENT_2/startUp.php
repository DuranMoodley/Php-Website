<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Start up</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<?php
		include("aShopStyling.css");
		
		//Show eShop details
		echo "<h1>Duran's eShop Information<h1>";
		echo "<h2>eShop Goals</h2>";
		echo "<p>Our Goal is to provide high quality items to our customers. 
				More specifically, 
				we want provide a wide range devices to make the lives of customers easier.
				We also offer our items at the most affordable prices and we make imports from top quality suppliers.
				If our customers are satisfied, so are we. <br>
				High Qaulity,<br>
				Affordabality and <br>
				Customer Statisfaction is what we live by.</p>";
		echo "<h2>eShop Type</h2>";
		echo "<p>We want to appeal to a wide range of customers. Therefore, we carter for those who are interested in electronics.<br>
			 These devices include: flat screen tv's, flash drives, cell phones and etc <br> 
			 We also have a range of other non-electronic. This includes: a stylish scarf, laptop bags , sunglasses and etc</p>";
	?>
	<form>
			<input type ="button" value= "Shop" 
			 onclick = "document.location.href = 'myShop.php'""/>
			<input type ="button" value= "Logon" id="logOn"
			onclick = "document.location.href = 'loginPage.php'" />
			<input type ="button" value= "Register" id="register"
			onclick = "document.location.href = 'RegistrationForm.php'" />
			<input type ="button" value= "Admin" id="admin"
			onclick = "document.location.href = 'adminLogin.php'" />
	</form>	
	<?php
	?>
</body>
</html>