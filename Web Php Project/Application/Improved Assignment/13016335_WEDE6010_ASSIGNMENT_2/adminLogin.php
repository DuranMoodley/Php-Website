<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin Login</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>	
	<?php		
		function buttonClick()
		{
			//Handles button click events of the form
			if(isset($_POST['Submit']))
			{				
				if(validation())
				{
					checkUserExistInDb();
				}			
			}			
			if(isset($_POST['Clear']))
			{
				$_POST['username'] = "";
				$_POST['password'] = "";
			}
		}
	  //**************************************************************
	  //Check if the administrator is already logged on
      if(isset($_COOKIE['admin']))
	  {
	    ?>
			<script>
				window.open("admin.php","_self");
			</script>
		<?php
	  }
	  else
	  {
		  //Open the logon form if the user is not logged on
			include("aShopStyling.css");
			echo "<h1>Admin Login<h1>";
		  ?>
		  <form name="Registration" method = "post">				
				<p>Username : <input type = "text" name= "username"  </p>
				<p>Password : <input type = "password" name = "password" </p>
				<p><input type = "reset" value = "Clear" />&nbsp;
				&nbsp; <input type = "Submit" value = "Submit" name = "Submit"/>
		 </form>	
		  <?php		  
		  buttonClick();
	  }
	//---------------------------------------------------------------------------//
		function validation()
		{
			$Username = $_POST['username'];
			$Password = $_POST['password'];
			$isFieldsValid = TRUE;
			
			//Trim
			$Username = trim($Username);
			$Password = trim($Password);
			
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
			if($isFieldsValid === TRUE)
			{
					if (preg_match("/^[A-Za-z]+/",$Username)== 0) 
					{				
						echo " <p>Username is invalid.</p>";
						$isFieldsValid = FALSE;						
					}																							
					if (preg_match("/^[\w-]*/",$Password)== 0) 
					{				
						echo " <p> Password is invalid. </p> "; 
						$isFieldsValid = FALSE;	
					}					
			}
			return $isFieldsValid;
		}
		//---------------------------------------------------------------------------//
		function checkUserExistInDb()
		{
			include("DBConn.php");		
			
			//Retrieve all data from text boxes
			$Username =  $_POST['username'];
			$UserPassword = $_POST['password'];
			$dbCustName;
			
			//Check if the administrator is still in the db
			$SQLstring = "SELECT * FROM tbl_customer WHERE custPassword = MD5('abcd123') AND custName = 'Duran'";
			$QueryResult = mysqli_query($Dbconnect,$SQLstring);
			if(($rowRecord = mysqli_fetch_assoc($QueryResult)) == TRUE)
			{
				//if the administrator exists compare those db credentials to the user entered credentials
				$dbCustName = $rowRecord['custName'];			
				if($dbCustName == $Username AND MD5($UserPassword) == $rowRecord['custPassword'])
				{
					echo "Login Successful";
					setcookie('admin',$dbCustName);
					?>
					<script>
						window.open("admin.php","_self");
					</script>
					<?php
				}
				else
				{
					echo "Invalid Credentials. Please Try Again";					
				}				
			}				
		}
		//---------------------------------------------------------------------------//
	?>
</body>
</html>