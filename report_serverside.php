<?php
require("database_link.php");
class report extends link_db {
	
protected $query_data;
protected $sql;
protected $fetch;
protected $say;
protected $rows;
protected $date;
	
	function load_sells_report_cash() {
		

	}
	
	function load_sells_report_card() {
		
	}

	function load_purchase_report_cash() {
		$this->say = new link_db;
		$this->say->connect_database();

		echo "<table border='2' class='table table-bordered'><thead><col width='50%'><col width='30%'><col width='30%'><th>Bill No.</th><th>cash</th><th>total</th><thead>";
		$from_date = $_POST["from_date"];
		$to_date = $_POST["to_date"];
		$this->query_data = "SELECT id,cash,total,date FROM purchase_invoice WHERE date BETWEEN '$from_date' AND '$to_date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		while($this->fetch = mysqli_fetch_array($this->sql)) {
			echo "<tr><td>" . $this->fetch["id"] . "</td><td>" . (int)$this->fetch["cash"] . "</td><td>" . $this->fetch["total"] . "</td></tr>";
		}
		echo "</table>";
	}
	
	function load_purchase_report_card() {
		$this->say = new link_db;
		$this->say->connect_database();

		echo "<table border='2' class='table table-bordered'><thead><col width='10%'><col width='20%'><col width='20%'><th>Bill No.</th><th>card1</th><th>card2</th><th>card3</th><th>total</th><thead>";
		$from_date = $_POST["from_date"];
		$to_date = $_POST["to_date"];
		$this->query_data = "SELECT id,card1,card2,card3,total,date FROM purchase_invoice WHERE card1>=1 AND date BETWEEN '$from_date' AND '$to_date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		while($this->fetch = mysqli_fetch_array($this->sql)) {
			echo "<tr><td>" . $this->fetch["id"] . "</td><td>" . (int)$this->fetch["card1"]. "</td><td>" .(int)$this->fetch["card2"]. "</td><td>" .(int)$this->fetch["card3"] . "</td><td>" . $this->fetch["total"] . "</td></tr>";
		}
		echo "</table>";	
	}
	
	function load_purchase_report_cheque() {
		$this->say = new link_db;
		$this->say->connect_database();

		echo "<table border='2' class='table table-bordered'><thead><col width='10%'><col width='20%'><col width='30%'><th>Bill No.</th><th>Date</th><th>cheque1</th><th>cheque2</th><th>total</th><thead>";
		$from_date = $_POST["from_date"];
		$to_date = $_POST["to_date"];
		$this->query_data = "SELECT id,cheque1,cheque2,total,date FROM purchase_invoice WHERE date BETWEEN '$from_date' AND '$to_date'";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		while($this->fetch = mysqli_fetch_array($this->sql)) {
			$raw_date = $this->fetch["date"];
			$create_readable_date = str_split($raw_date, 2);
			$date = implode('/',$create_readable_date); 
			echo "<tr><td>" . $this->fetch["id"] . "</td><td>" .$date . "</td><td>" . (int)$this->fetch["cheque1"] . "</td><td>" . (int)$this->fetch["cheque2"] . "</td><td>" . $this->fetch["total"] . "</td></tr>";
		}
		echo "</table>";	
	}
}

$get_report = new report;
$get_report->load_purchase_report_cheque();

?>