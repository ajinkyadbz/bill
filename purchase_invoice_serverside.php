<?php

require("database_link.php");
class purchase_invoice extends link_db {
protected $query_data;
protected $sql;
protected $fetch;
protected $say;
protected $rows;
protected $date;

	function list_bills() {
		$this->say = new link_db;
		$this->say->connect_database();				
		$from_date = $_POST["from_date"];
		$to_date = $_POST["to_date"];
		$this->query_data = "SELECT id FROM purchase_invoice WHERE date BETWEEN '$from_date' AND '$to_date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		while($this->fetch = mysqli_fetch_array($this->sql)) {
			echo "<option>" . $this->fetch["id"] . "</option>"; 			
		}
	}

	function display_bills() {	
		$this->say = new link_db;
		$this->say->connect_database();
		$bill_no = $_POST["bill_no"];
		$this->query_data = "SELECT * FROM purchase_invoice WHERE id='$bill_no'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		
		$raw_date = $this->fetch["date"];
		$create_readable_date = str_split($raw_date, 2);
		$date = implode('/',$create_readable_date); 

		echo "<table  border='2' class='table table-bordered'>";

		echo "<tr><td><h2>Kallatra Dry Fruits</h2><p>shop no 325 nawab building,<br />Dr D N Road,Opp Thomas Cook,<br />Near City Bank,<br /> Fort,<br /> Mumbai, Maharashtra 400001</p></td><td>";
		echo "Bill No." . $this->fetch["id"]. "<br />Date: " . $date . "<br />Time: " . $this->fetch["time"]. "</td><td></td><td></td></tr>";

		echo "<tr><td>Cash: " . $this->fetch["cash"] . "</td><td>card1: " . $this->fetch["card1"] . "</td><td>Cash2: " . $this->fetch["card2"] . "</td><td></td></tr>";
		echo "<tr><td>card3: " . $this->fetch["card3"] . "</td><td>Cheque 1: " . $this->fetch["cheque1"]. "</td><td>Cheque 2: " . $this->fetch["cheque2"] . "</td><td>Total:" .$this->fetch["total"] . "</td></tr>";
		
		
		$this->query_data = "SELECT * FROM purchase_items WHERE bill_no='$bill_no'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		echo "<tr><td>Product</td><td>Quantity</td><td>Rate</td><td>Cost</td></tr>";
		while($this->fetch = mysqli_fetch_array($this->sql)){
			echo "<tr><td>" . $this->fetch["product"] . "</td><td>" . $this->fetch["quantity"] . "</td><td>" . $this->fetch["rate"] . "</td><td>" . $this->fetch["cost"] . "</td></tr>";  
		}	
	}
}

$get_bills = new purchase_invoice;
if($_POST["load_what"] == "bill_no") {
$get_bills->list_bills();
}
elseif($_POST["load_what"] == "bill") {
$get_bills->display_bills();
}
?>