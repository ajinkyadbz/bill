<?php
require "barcode/vendor/autoload.php";
require "autocomplete.php";

class generate extends link_db{
protected $query_data;
protected $query_rows;
protected $sql;
protected $fetch;
protected $say;
protected $rows;
protected $total_rows;
protected $stock_array;

protected $bar;
protected $code;
	
	function list_products(){
		$this->stock_array = array();
		$this->query_rows = "SELECT COUNT(*) FROM mytable";
		$this->say = new link_db;
		$this->say->connect_database();
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
	
	function load_barcode_ajax() {
	$product = $_POST['name_of_product'];
	
	$this->say = new link_db;
	$this->say->connect_database();	
	$this->query_data = "SELECT * FROM mytable WHERE Item_Name='$product'";
	$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
	$this->fetch = mysqli_fetch_array($this->sql);
	$this->Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
	$this->code = $this->Bar->getBarcode($this->fetch["Barcode"], $this->Bar::TYPE_CODE_128);
	echo "Kalatra Dry Fruits Pvt. Ltd.<br />" . $this->code . "Item Name: " . $product ."<br />Price: ".$this->fetch["SPrice"];
	}
}
if($_GET["what"] == "barcode") {
	$load_barcode = new generate;
	$load_barcode->load_barcode_ajax();
}
?>