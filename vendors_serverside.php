<?php

require("database_link.php");

class vendors extends link_db{

protected $query_data;
protected $query_rows;
protected $sql;
protected $fetch;
protected $say;
protected $rows;
protected $vendor_array;

	function list_vendors(){
		//provides a list of vendors.
		$this->vendor_array = array();
		$this->say = new link_db;
		$this->say->connect_database();
		$this->query_rows = "SELECT COUNT(*) FROM mytable";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_rows);

		$this->rows = mysqli_fetch_row($this->sql);
		for($i=0;$i<=$this->rows[0];$i++) {
			$this->query_data = "SELECT party_name FROM mytable WHERE SlNo=$i";
			$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
			$this->fetch = mysqli_fetch_array($this->sql);
				if(!array_search($this->fetch,$this->vendor_array)) {
					array_push($this->vendor_array,$this->fetch);
				}
		}
		sort($this->vendor_array);
		for($k=1;$k<=count($this->vendor_array)-1;$k++) 
		{
			echo "<option value='" .$this->vendor_array[$k][0]. "'></option>" ;
			//echo "<option value='hello'></option>";
		}
	}

	function update_vendor($name) {		
		$this->say = new link_db;
		$this->say->connect_database();
		$this->query_rows = "SELECT id FROM vendors where name='$name'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_rows);
		$this->rows = mysqli_fetch_row($this->sql);
		
			$mobile = $_POST["mobile"];
			$gstn = $_POST["gstn"];
			$address = $_POST["address"];
			$email = $_POST["email"];

		if($this->rows == 0) {
			$this->query_data = "INSERT INTO vendors (name,mobile,gstn,address,email) VALUES ('$name' , '$mobile' , '$gstn' , '$address' , '$email' )";		
					if(mysqli_query($this->say->connect_form,$this->query_data)){
						echo "Record created successfully";			
					}
					else {
						echo "Error creating record &nbsp" . mysqli_error($this->say->connect_form);	
					}
		}
		else {
			$this->query_data = "UPDATE vendors SET mobile='$mobile',gstn='$gstn',address='$address',email='$email' WHERE name='$name'";
			mysqli_query($this->say->connect_form,$this->query_data);
			echo mysqli_error($this->say->connect_form);
			echo "Record updated";
		}
	}
	
	function load_vendor_ajax($name_of_vendor,$what) {
		
		switch($what) {
			case "email":
				$this->query_data = "SELECT email FROM vendors where name='$name_of_vendor'";
				break;
			case "address":
				$this->query_data = "SELECT address FROM vendors where name='$name_of_vendor'";
				break;
			case "mobile":
				$this->query_data = "SELECT mobile FROM vendors where name='$name_of_vendor'";
				break;
			case "gstn":
				$this->query_data = "SELECT gstn FROM vendors where name='$name_of_vendor'";
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


$call_vendor_functions = new vendors;
switch($_GET["type"]) {
	case "vendor_form":
		$call_vendor_functions->update_vendor($_POST["name"]);
		break;
		
	case "vendor_ajax":
		$call_vendor_functions->load_vendor_ajax($_POST["name_of_vendor"],$_POST["what"]);
		break;
		
	default:
		echo "Incorrect parameters";
}

?>