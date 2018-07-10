<?php
require("database_link.php");

class stock_serverside extends link_db {

protected $query_data;
protected $query_rows;
protected $sql;
protected $fetch;
protected $say;
protected $rows;
protected $total_rows;
protected $stock_array;

function list_stock(){
		//provides a list of products.
		$this->stock_array = array();
		$this->say = new link_db;
		$this->say->connect_database();
		$this->query_rows = "SELECT COUNT(*) FROM mytable";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_rows);

		$this->rows = mysqli_fetch_row($this->sql);
		for($i=0;$i<=$this->rows[0];$i++) {
			$this->query_data = "SELECT Item_Name FROM mytable WHERE SlNo=$i";
			$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
			$this->fetch = mysqli_fetch_array($this->sql);
				if(!array_search($this->fetch,$this->stock_array)) {
					array_push($this->stock_array,$this->fetch);
				}
		}
		sort($this->stock_array);
		for($k=1;$k<=count($this->stock_array)-1;$k++) 
		{
			echo "<option value='" .$this->stock_array[$k][0]. "'></option>" ;
		}
}

//-------------------------------------------------------------------------------------------------------------------------


function update_stock($name) {
		$this->say = new link_db;
		$this->say->connect_database();
		$this->query_rows = "SELECT SlNo FROM mytable where Item_Name='$name'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_rows);
		$this->rows = mysqli_fetch_row($this->sql);
		$this->total_rows = mysqli_num_rows($this->sql);
		$totalrows = $this->total_rows +1;
			$hsn = $_POST["hsn"];
			$ean = $_POST["ean"];
			$upc = $_POST["upc"];
			$partyname = $_POST["partyname"];
			$pprice = $_POST["pprice"];
			$sprice = $_POST["sprice"];
			$size = $_POST["size"];
			$quantity = $_POST["quantity"];

		if($this->rows == 0) {
			$this->query_data = "INSERT INTO mytable (Item_Name,HSNCode,EAN_CODE,Barcode,Party_Name,PPrice,SPrice,Size,Quantity) VALUES ('$name','$hsn' , '$ean' , '$upc' , '$partyname' , '$pprice','$sprice','$size','$quantity')";		
					if(mysqli_query($this->say->connect_form,$this->query_data)){
						echo "Record created successfully";
						header("location:stock_clientside.php");	
					}
					else {
						echo "Error creating record &nbsp" . mysqli_error($this->say->connect_form);	
					}
		}
		else {
			$this->query_data = "UPDATE mytable SET HSNCode='$hsn',EAN_CODE='$ean',Barcode='$upc',Party_Name='$partyname',PPrice='$pprice',SPrice='$sprice',Size='$size',Quantity='$quantity' WHERE Item_Name='$name'";
			mysqli_query($this->say->connect_form,$this->query_data);
			echo mysqli_error($this->say->connect_form);
			echo "Record updated";
			header("location:stock_clientside.php");	
		}

}

//-------------------------------------------------------------------------------------------------------------------------
function load_stock_ajax ($name_of_product,$what) {
		switch($what) {
			case "hsn":
				$this->query_data = "SELECT HSNCode FROM mytable where Item_Name='$name_of_product'";
				break;
			case "ean":
				$this->query_data = "SELECT EAN_CODE FROM mytable where Item_Name='$name_of_product'";
				break;
			case "sprice":
				$this->query_data = "SELECT SPrice FROM mytable where Item_Name='$name_of_product'";
				break;
			case "pprice":
				$this->query_data = "SELECT PPrice FROM mytable where Item_Name='$name_of_product'";
				break;
			case "size":
				$this->query_data = "SELECT Size FROM mytable where Item_Name='$name_of_product'";
				break;
			case "partyname":
				$this->query_data = "SELECT Party_Name FROM mytable where Item_Name='$name_of_product'";
				break;
			case "upc":
				$this->query_data = "SELECT Barcode FROM mytable where Item_Name='$name_of_product'";
				break;
			case "qty":
				$this->query_data = "SELECT Quantity FROM mytable where Item_Name='$name_of_product'";
				break;
			default:
		}		
		$this->say = new link_db;
		$this->say->connect_database();
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		echo $this->fetch[0];
	}
}

$call_stock_functions = new stock_serverside;
switch($_GET["type"]) {
	case "product_form":
		$call_stock_functions->update_stock($_POST["name_of_product"]);
		break;
		
	case "stock_ajax":
		$call_stock_functions->load_stock_ajax($_POST["name_of_product"],$_POST["what"]);
		break;
		
	default:
		echo "Incorrect parameters";
}
?>