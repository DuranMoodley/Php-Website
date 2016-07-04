<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Regististration Form</title>
</head>
<h1>Register</h1>
<body>
 <form name="Registration" method = "post">				
				<p>Username : <input type = "text" name= "username"  </p>
				<p>Surname : <input type = "text" name= "surname"  </p>
				<p>Password : <input type = "text" name = "password" </p>
				<p>Email : <input type = "text" name = "email" </p>
				<p><input type = "reset" value = "Clear" />&nbsp;
				&nbsp; <input type = "Submit" value = "Submit" name = "Submit"/>
		</form>	
<?php
	include("aShopStyling.css");
	buttonClick();
//************************************************************************						
	function buttonClick()
    {
	    if(isset($_POST['Submit']))
		{				
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
		include("DBConn.php");
		$Username =  $_POST['username'];
		$Surname = $_POST['surname'];
		$Email = $_POST['email'];
		$Password = MD5($_POST['password']);
		
		//Insert the user entered values into db
		$SQLString = "INSERT INTO tbl_customer".
					 "(custName,custSurname,custEmail, custPassword)".
					 "VALUES ('$Username','$Surname','$Email','$Password')" ;
					 $QueryResult = mysqli_query ($Dbconnect,$SQLString);
								
					if ($QueryResult === FALSE)
					{
						echo "<p> Unable to update table </p>" .  "<p>Error code" . mysqli_errno($Dbconnect). ":". mysqli_error ($Dbconnect)."</p>";
					}
					else 
					{
						echo "<p> Successfully added  </p>";
						?>
						<a href="loginPage.php">Click here to Login</a>
						<?php
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
			//If fields are still valid, user preg match for further checking
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
?>
</body>
</html>