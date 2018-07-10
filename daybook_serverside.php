<?php

require("database_link.php");

class daybook extends link_db
{
protected $query_data;
protected $max_sells;
protected $max_purchases;
protected $sql;
protected $fetch;
protected $say;
protected $rows;
protected $date;

	function __construct() {
		$this->say = new link_db;
		$this->say->connect_database();
		
		$this->date = $_POST["date"];
		
		$this->query_data = "SELECT MAX(id) FROM invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		echo "Total Sells: " . $this->fetch[0]. "<br />";

		
		$this->query_data = "SELECT MAX(id) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		$this->max_purchases = $this->fetch[0];
		echo "Total Purchases:" . $this->max_purchases . "<br />";

		$this->load_sells_data();
		$this->load_purchase_data();
	}

	function load_sells_data() {
		$this->date = $_POST["date"];
		echo "Sells : ---------------------------------------------------------------<br />";
		
		$this->query_data = "SELECT SUM(total) FROM invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		echo "Total=" . $this->fetch[0] . "<br /><br />";
	}

	function load_purchase_data() {
		$this->date = $_POST["date"];
		echo "Purchases : -----------------------------------------------------------<br />";
		$this->query_data = "SELECT SUM(cash) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		echo "Cash: " . $this->fetch[0]. "<br /><br />";
		
		$this->query_data = "SELECT SUM(card1) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		$card1 = $this->fetch[0];
		echo "Card1: " . $card1  . "<br />";
		
		$this->query_data = "SELECT SUM(card2) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		$card2 = $this->fetch[0];
		echo "Card2: " . $card2 . "<br />";
		
		$this->query_data = "SELECT SUM(card3) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		$card3 = $this->fetch[0];
		echo "Card3: " . $card3 . "<br />";
		
		echo "Card Total:";
		echo $card1 + $card2 + $card3;
		echo "<br /><br />";
		
		$this->query_data = "SELECT SUM(cheque1) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		echo "Cheque1: " . $this->fetch[0] . "<br />";
		
		$this->query_data = "SELECT SUM(cheque2) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		echo "Cheque2: " . $this->fetch[0] . "<br /><br />";
		
		$this->query_data = "SELECT SUM(total) FROM purchase_invoice WHERE date='$this->date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_array($this->sql);
		echo "Total: " . $this->fetch[0] . "<br />";	
	}
}
$load_daybook_ajax = new daybook;
?>