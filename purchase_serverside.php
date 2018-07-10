<?php

require("database_link.php");

class purchase_serverside extends link_db {

	protected $query_data;
	protected $query_rows;
	protected $sql;
	protected $fetch;
	protected $say;
	protected $rows;
	protected $total_rows;
	protected $stock_array;

	function list_vendor_names() {
		$this->say = new link_db;
		$this->say->connect_database();
		$this->query_data = "SELECT DISTINCT Party_Name from mytable";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		while($this->fetch = mysqli_fetch_array($this->sql)){
			echo "<option>".$this->fetch[$i=0]."</option>" ;
		}
	}
	
	function list_product_names($vd_name)
	{
		$this->say = new link_db;
		$this->say->connect_database();
		$this->query_data = "SELECT * from mytable WHERE Party_Name='$vd_name'";
		$this->sql = mysqli_query($this->say->connect_form, $this->query_data);
		
		while($this->fetch = mysqli_fetch_array($this->sql)) {
			echo "<div id='" . $this->fetch["Item_Name"] ."price'>". $this->fetch["PPrice"] . "</div>";
			echo "<option>" . $this->fetch["Item_Name"] . "</option>";
		}
	}

	function to_purchase_invoice() { // feed data to purchase invoice table.
		$this->say = new link_db;
		$this->say->connect_database();

		$cash = $_POST["cash"];
		$card1 = $_POST["card1"];
		$card2 = $_POST["card2"];
		$card3 = $_POST["card3"];
		$cheque1 = $_POST["cheque4"];
		$cheque2 = $_POST["cheque5"];
		$total = $_POST["total"];
		$balance = $_POST["balance"];
		
		$card1_bank = $_POST["card1bank"];
		$card2_bank = $_POST["card2bank"];
		$card3_bank = $_POST["card3bank"];
		$cheque1_bank = $_POST["cheque4bank"];
		$cheque2_bank = $_POST["cheque5bank"];
		
		$date = date("dmy");
		$time = date("h:i:s");
		
		$this->query_data = "INSERT INTO purchase_invoice(cash,card1,card2,card3,cheque1,cheque2,card1_bank,card2_bank,card3_bank,cheque1_bank,cheque2_bank,total,balance,date,time) VALUES ('$cash','$card1','$card2','$card3','$cheque1','$cheque2','$card1_bank','$card2_bank','$card3_bank','$cheque1_bank','$cheque2_bank','$total','$balance','$date','$time')";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		}
	
	function to_purchase_items() { //feed data to purchase items table.
		$this->say = new link_db;
		$this->say->connect_database();

		$this->query_rows = "SELECT COUNT(*) FROM purchase_invoice";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_rows);
		$this->total_rows = mysqli_fetch_array($this->sql);
		$bill_no = $this->total_rows[0];
		
				
		$no_of_products = $_POST["total_products"];
			for($i=0; $i<=$no_of_products; $i++ ){
				$name_of_item = $_POST["item_" . $i];
				$quantity_of_one_product = $_POST['qty_' . $i];
				$cost_including_tax = $_POST['cost_' . $i];
				$rate_of_one_item = $cost_including_tax/$quantity_of_one_product;
				$this->query_data = "INSERT INTO purchase_items (product,quantity,rate,cost,bill_no) VALUES ('$name_of_item','$quantity_of_one_product','$rate_of_one_item','$cost_including_tax','$bill_no')";
				$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
			}
			header("location:purchase_clientside.php");
	}
}

$call_func = new purchase_serverside;
if($_GET["type"] == "pdname"){
	$call_func->list_product_names($_POST["pd_name"]);
}
elseif($_GET["type"] == "form") {
	$call_func->to_purchase_invoice();
	$call_func->to_purchase_items();
	
}
?>