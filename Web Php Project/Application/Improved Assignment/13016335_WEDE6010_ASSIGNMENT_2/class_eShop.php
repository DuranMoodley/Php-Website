<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Class</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
	include("DBConn.php");
	class FactoryClass
	{		
		private $dbConnect = NULL;
		private $allStock = array();
		public $userCart = array();
		//*************************************************
		function _construct()
		{			
			include("DBConn.php");		
			$this->dbConnect = $DbConnect;
		}
		//*************************************************
		public function showTable()
		{
			include("aShopStyling.css");
			if(count($this->allStock)>0)
			{
				echo "<table width = '100%' height = '50%' id= tblShop>\n";
				echo "<tr><th>Item Id</th>
					 <th>Image</th>
					 <th>Description</th>
					 <th>Cost Price</th>
					 <th>Quantity</th>
					 <th>Sell Price</th>
					 <th>Add To Cart</th></tr>\n"; 
				foreach ($this->allStock as $itemID => $Infomation) 
				{
					  echo "<tr><td>".htmlentities($Infomation['itemId']). "</td>\n";
					  echo "<td><img src= images/$itemID.jpg width = 60 height = 60/></td>\n";
					  echo "<td>".htmlentities($Infomation['Description'])."</td>\n";
					  printf("<td class='currency'>R%.2f </td>\n", $Infomation['CostPrice']);
					  echo "<td>".htmlentities($Infomation['Quantity'])."</td>\n"; 
					  printf("<td class='currency'>R%.2f </td>\n", $Infomation['SellPrice']);
					  echo "<td><a href='".$_SERVER['SCRIPT_NAME']."?PHPSESSID=".session_id()."&Item=$itemID'>Add Item</a></td>\n"; 
				}
				"</table>";
			}			
		}
		//*************************************************
		public function showAdminTable()
		{
			if(count($this->allStock)>0)
			{
				echo "<table width = '100%' height = '50%' id= tblShop>\n";
				echo "<tr><th>Item Id</th>
					 <th>Image</th>
					 <th>Description</th>
					 <th>Cost Price</th>
					 <th>Quantity</th>
					 <th>Sell Price</th>
					 <th>Admin Actions</th></tr>\n"; 
				foreach ($this->allStock as $itemID => $Infomation) 
				{
					  echo "<tr><td>".htmlentities($Infomation['itemId']). "</td>\n";
					  echo "<td><img src= images/$itemID.jpg width = 60 height = 60/></td>\n";
					  echo "<td>".htmlentities($Infomation['Description'])."</td>\n";
					  printf("<td class='currency'>R%.2f </td>\n", $Infomation['CostPrice']); 
					  echo "<td>".htmlentities($Infomation['Quantity'])."</td>\n"; 
					  printf("<td class='currency'>R%.2f </td>\n", $Infomation['SellPrice']); 
					  echo "<td><a href='".$_SERVER['SCRIPT_NAME']."?PHPSESSID=".session_id()."&Item=$itemID'>Edit Item</a><br>\n"; 	
					  echo "<a href='".$_SERVER['SCRIPT_NAME']."?PHPSESSID=".session_id()."&DeleteItem=$itemID'>Delete Item</a></td>\n";					  
				}
				"</table>";
			}			
		}
		//*************************************************
		private function addUserItem()
		{
			//Check get response, increment cart element
			$itemId = $_GET['Item'];
			if (array_key_exists($itemId, $this->userCart)) 
			{
				$this->userCart[$itemId] += 1; 
			}
		}
		//*************************************************
		public function setValues()
		{
			//Retrieve values from item table and initialize stock array
			include("DBConn.php");
			$SQLString = "SELECT * FROM tbl_item";
			$QueryResult =  mysqli_query($Dbconnect,$SQLString);
			if($QueryResult == FALSE)
			{
				echo "error";
			}
			else
			{
				 $this->allStock = array();               
				 $this->userCart = array(); 
				 while(($rowRecord = $QueryResult->fetch_assoc()) !==NULL)
				 {
					   $this->allStock[$rowRecord['itemId']] = array();
					   $this->allStock[$rowRecord['itemId']]['itemId'] = $rowRecord['itemId'];
					   $this->allStock[$rowRecord['itemId']]['Description'] = $rowRecord['Description'];
					   $this->allStock[$rowRecord['itemId']]['CostPrice'] = $rowRecord['CostPrice']; 
					   $this->allStock[$rowRecord['itemId']]['Quantity'] = $rowRecord['Quantity'];
					   $this->allStock[$rowRecord['itemId']]['SellPrice'] = $rowRecord['SellPrice'];
					   $this->userCart[$rowRecord['itemId']] = 0; 
				 }
			}
		}
		//**************************************************
		private function ItemToRemove() 
		{    
			$itemsID = $_GET['RemoveItem']; 
			if (array_key_exists($itemsID, $this->userCart))   
			{				
				if ($this->userCart[$itemsID]>0) 
				{					
					$this->userCart[$itemsID] -= 1; 
				}
			}
		} 
		//*************************************************************
		private function emptyUserCart() 
		{    
			foreach ($this->userCart as $keyValue => $value) 
			{
				$this->userCart[$keyValue] = 0; 
			}
		} 
		//*************************************************************
		public function processInput() 
		{     
			if (!empty($_GET['Item']))  
			{				
				$this->addUserItem();     
			}
			if (!empty($_GET['RemoveItem'])) 
			{
				$this->ItemToRemove();
			}
			if (!empty($_GET['ClearCart'])) 
			{
				$this->emptyUserCart();
			} 
		}
		//*************************************************************
		function _wakeup()
		{
			include("DBConn.php");
			$this->dbConnect = $DbConnect;
		}
		//*************************************************************
		function _destruct()
		{
			if(!$this->dbConnect->connect_error)
				$this->dbConnect->close();
		}
	}
?>
</body>
</html>