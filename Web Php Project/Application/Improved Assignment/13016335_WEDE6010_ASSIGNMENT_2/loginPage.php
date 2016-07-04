<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Login Form</title>
</head>
<h1>Login Page </h1>
<body>		
		<form name="Registration" method = "post" >	
				<p>Username : <input type = "text" name= "username"  />
				<p>Surname : <input type = "text" name= "surname"  />
				<p>Password : <input type = "password" name = "password" />
				<p>Email : <input type = "text" name = "email" />
				<p><input type = "reset" value = "Clear" />&nbsp;
				&nbsp; <input type = "Submit" value = "Submit" name = "submit"/>
		</form>		
<?php	
		include("aShopStyling.css");
		buttonClick();
//************************************************************************************			
	    function buttonClick()
		{
			if(isset($_POST['submit']))
			{				
				if(validation())
				{
					checkUserExistInDb();
				}			
			}
			
			if(isset($_POST['Clear']))
			{
				$_POST['username'] = "";
				$_POST['surname'] = "";
				$_POST['email'] = "";
				$_POST['password'] = "";
			}
		}
//---------------------------------------------------------------------------//	
		function checkUserExistInDb()
		{
			include("DBConn.php");
			
			//Retrieve all data from text boxes
			$Username =  $_POST['username'];
			$Surname = $_POST['surname'];
			$Email = $_POST['email'];
			$userInputArray = array($Username,$Surname, $Email);
			$UserPassword = $_POST['password'];
			$displaySticky = FALSE;
			$count = 0;
			
			//Run query to check if user exists
			$SQLstring = "SELECT custName , custSurname , custEmail FROM tbl_customer WHERE custPassword = MD5('$UserPassword')";
			if ($QueryResult = mysqli_query($Dbconnect,$SQLstring))
			{
				//If more than 0 rows returns, user exists
				$numRows = mysqli_num_rows($QueryResult);
				if ($numRows  > 0 ) 
				{
					echo " Login Successfully <br>";
					
					//Make the row returned into an associative array
					while($rowRecord = mysqli_fetch_assoc($QueryResult))
					{
						//Check the user entered data, to the real record field from the database
						foreach($rowRecord as $record => $value)
						{
							//if they are matching, do not put into incorrectUserData array 
							//If not matching then insert element into the incorrectUserData array
							if($userInputArray[$count] !== $value)
							{						
								$userInputArray[$count] = "";
								$displaySticky = TRUE;
							}	
							$count++;
						}					
					}	
					
					if($displaySticky)
					{
						echo "<p> Some Data is incorrect, Please correct the Blank Fields </p>";
						displayStickyForm($userInputArray);
					}
					else
					{					
						echo "<p> User : $Username , $Surname is logged in </p>";
						setcookie('password',$UserPassword);
						?>
						   <form>
							<p> <input type ="button" value= "Show Items" 
							onclick = "document.location.href = 'myShop.php'"  />
						</form>	
						<?php
					}
				}
				else 
				{
					echo "<p> Not Found,Please Re-Enter your password Or Click the Link below to Register </p> ";
					?>
					<a href="RegistrationForm.php">Click here to Register</a>
					<?php
				}
			}
		}
//---------------------------------------------------------------------------//
		function validation()
		{
			$Username = $_POST['username'];
			$Surname = $_POST['surname'];
			$Password = $_POST['password'];
			$Email = $_POST['email'];
			$isFieldsValid = TRUE;
			
			//Trim
			$Username = trim($Username);
			$Password = trim($Password);
			$Surname = trim($Surname);
			$Email = trim($Email);
			
			//Check Null values
			if(empty($Username))
			{
				echo "<p> Field Username Empty </p>";
				$isFieldsValid = FALSE;
			}
			if(empty($Password))
			{
				echo "<p> Field Password is Empty </p>";
				$isFieldsValid = FALSE;
			}
			if(empty($Email))
			{
				echo" <p> Field Email is Empty </p> ";
				$isFieldsValid = FALSE;
			}
			if(empty($Surname))
			{
				echo" <p> Field Surname is Empty </p> ";
				$isFieldsValid = FALSE;
			}
			if($isFieldsValid === TRUE)
			{
					if (preg_match("/^[A-Za-z]+/",$Username)== 0) 
					{				
						echo " <p>Username is invalid.</p>";
						$isFieldsValid = FALSE;						
					}				
								
					if (preg_match("/^[A-Za-z]+/",$Surname)== 0) 
					{				
						echo " <p> Surname is invalid. </p>";  
						$isFieldsValid = FALSE;
					}				
									
					if (preg_match("/^[\w-]*/",$Password)== 0) 
					{				
						echo " <p> Password is invalid. </p> "; 
						$isFieldsValid = FALSE;	
					}	
					
					if (preg_match("/^[\w-]+(\.[\w-]+)*@"."[\w-]+(\.[\w-]+)*(\.[[A-Za-z]{2,})$/i",$Email)== 0) 
					{				
						echo " <p> Email is invalid. </p> "; 
						$isFieldsValid = FALSE;	
					}	
					
			}
			return $isFieldsValid;
		}
//---------------------------------------------------------------------------//
		function displayStickyForm($incorrectUserData)
		{
		?>
			<form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
			<p> Username : <input type = "text" name= "username" value ="<?php echo $incorrectUserData[0]; ?>" />
			<p>Surname : <input type = "text" name= "surname" value ="<?php echo $incorrectUserData[1]; ?>"  />
			<p>Password : <input type = "password" name = "password" />
			<p> Email : <input type = "text" name = "email" value ="<?php echo $incorrectUserData[2] ?> "/>
			<p> <input type = "reset" value = "Clear" />&nbsp;
			&nbsp; <input type = "Submit" value = "Submit" name = "Submit"/>
			</form>	
		<?php		
		}
//---------------------------------------------------------------------------//
?>
</body>
</html>