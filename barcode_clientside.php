<?php

require("load_html.php");
$call = new loads;
$call->read_head();

require "barcode/vendor/autoload.php";
//require "autocomplete.php";
/*
class generate extends link_db{
	protected $query_data;
	protected $sql;
	protected $fetch;
	protected $get_id;
	protected $get_table;
	protected $say;
	public $code;
	public $Bar;
	
function __construct() {
	$this->say = new link_db;
	$this->say->connect_database();
//	$shop_name = $product = $price = $tax = $expiry = $quantity = "";


	
if($_GET["check"] != "") {
	$this->query_data = "SELECT * FROM mytable WHERE Item_Name='$_GET[check]'";
	$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
	$this->fetch = mysqli_fetch_assoc($this->sql);
	
	$this->Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
	$this->code = $this->Bar->getBarcode($_GET['check'], $this->Bar::TYPE_CODE_128);
	echo $this->code;
	if($_GET["shop"]) {
		echo "Shop : Gigmoz <br />";
	}
	if($_GET["product"]) {
		echo "Product : " . $_GET["check"] . "<br />";
	}
	if($_GET["price"]) {
		echo "Price : " . $this->fetch["unit"] . "<br />";
	}
	if($_GET["tax"]) {
		echo "GST : " . $this->fetch["tax"] . "<br />";
	}
	if($_GET["expiry"]) {
		echo "Expiry date: " . $this->fetch["date"] . "<br />";
	}
	if($_GET["quantity"]) {
		$quantity = "Quantity :" . $this->fetch["stock"] . "<br />";
	}
}
else {
	$code = "Please enter product name to generate barcode";
}
}

}
*/
?>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->


			<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Print Labels</h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Print Section</h4>
						</div>
						<div class="form-body">
							<form>
							<div class="form-group">
							<label for="exampleInputEmail1">Enter Product Name:</label>
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Product Name" name="check" list="products">
							<datalist id="products">
							<?php 
								require("barcode_serverside.php");
								$generate_code = new generate;
								$generate_code->list_products();								
							 ?>
							</datalist>						
							</div>
							</form>
						<div class="buttons_w3ls_agile">
								<button typeclass="btn btn-success" onclick="load_barcode_data()">Generate Label</button>
							</div>
  					</div>
						<div class="col-md-12 panel-grids">
							<div class="panel panel-primary">
							 <div class="panel-heading">
							 <h3 class="panel-title">Preview</h3>
							 </div>
							 <div class="panel-body" id="barcode_image" style="width: 300px;">
							 </div>
							 <div class="panel-body" id="print_button">
							 
							 </div>
							 
							 	<img id="textScreenshot" src="">
						   </div>
						</div>						
					</div>
				 </div>
			</div>
			</div>



<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
				<!--footer-->
		<div class="footer">
		   <p>&copy; 2018 Gigmoz. All Rights Reserved</p>
	   </div>
        <!--//footer-->
        
        
<script src="//cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript" >
var xhttp_request = new XMLHttpRequest();
function load_barcode_data() {
	xhttp_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById("barcode_image").innerHTML = receive_data;
         }
   	};
        xhttp_request.open("POST", "barcode_serverside.php?what=barcode", false);
        xhttp_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp_request.send("name_of_product=" + document.getElementById("exampleInputEmail1").value);
     var button = document.createElement("button");
     button.innerHTML = "Print Sticker";
     document.getElementById("print_button").appendChild(button);
     
    button.onclick = function () {
	  html2canvas(document.getElementById("barcode_image"), {
    	onrendered: function(canvas) {
      var screenshot = canvas.toDataURL("image/png");
      document.getElementById("textScreenshot").setAttribute("src", screenshot);
    }
  });
    }
 }
</script>
        
<?php
$call->read_foot();
?>