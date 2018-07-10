<?php

require("database_link.php");

class bill_complete extends link_db{
	protected $query_data;
	protected $query_rows;
	protected $sql;
	protected $fetch;
	protected $get_id;
	protected $get_table;
	protected $say;
	public $last_id;

	function __construct() {
	$this->say = new link_db;
	$this->say->connect_database();	
	
	$this->query_rows = "SELECT COUNT(*) FROM invoice";  
	$this->sql= mysqli_query($this->say->connect_form,$this->query_rows);
	$this->fetch = mysqli_fetch_array($this->sql);
	
	$this->last_id = $this->fetch[0];
	
	$this->to_invoice_table();
	$this->to_invoice_items_table();

	header("location: /billing.php");	
	
	}
	
	function to_invoice_table () {
		$cost = $_POST["total_final"];
		echo $cost;
		$date = date("dmy");
		$time = date("hms");
		$bill_no = $this->last_id;
		echo $date. "<br />"	. $time . "<br />"	. $cost . "<br />"	. $bill_no . "<br />";
		$this->query_data = "INSERT INTO invoice (total,date,time,bill_no) VALUES ('$cost','$date','$time','$bill_no')";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
	}
	
	function to_invoice_items_table() {
		for($i=0;$i<= $_POST["length"]-1;$i++) {
		$names = $_POST["item_".$i];
		$qty = $_POST[$names . "qty"];
		$rate = $_POST[$names . "SPrice"];
		$hsn = $_POST[$names . "HSNCode"];
		$bill_no = $this->last_id;
		echo $qty . "<br />"	. $rate . "<br />" . $hsn . "<br />". $bill_no; 	
		$this->query_data = "INSERT INTO invoice_items (product,quantity,rate,hsn,bill_no) VALUES ('$names','$qty','$rate','$hsn','$bill_no')";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		}
	}
	
	function to_printer() {
	
	}
}

$call_this = new bill_complete;

?>