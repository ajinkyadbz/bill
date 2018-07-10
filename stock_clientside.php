<?php
require("load_html.php");
$call = new loads;
$call->read_head();
?>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
		
		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<!--<h2 class="title1">Update Stocks</h2>-->
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>ADD/Update/View Stock Information:</h4>
						</div>
						<div class="form-body">
							<form method="post" action="stock_serverside.php?type=product_form"> 
								<div class="form-group">
									<div class="row">																				
										<div class="col-md-5 grid_box1">
										<label for="exampleInputEmail1">Product Name</label>
										<input type="text" list="products" class="form-control1" placeholder="Product Name" name="name_of_product" id="name_of_product" onkeyup="load_stock_data()">
										<datalist id="products">
												<?php
												require("stock_serverside.php");
												$get_stock = new stock_serverside;
												$get_stock->list_stock();
												?>
										</datalist>
										</div>

										<div class="col-md-5">
										<label for="exampleInputEmail1">HSN No.</label>
										<input type="text" value="0" class="form-control1" placeholder="HSN No." id="hsn" name="hsn">
										</div>

									</div>
								</div>
								
								<div class="row">
									<div class="col-md-5">
									<label for="exampleInputEmail1">Selling Price</label>
									<input type="text" class="form-control1" value="0" placeholder="Selling Price" id="sprice" name="sprice">
									</div>
																		
									<div class="col-md-5">
									<label for="exampleInputEmail1">Cost Price</label>
									<input type="text" class="form-control1" value="0" placeholder="Cost Price" id="pprice" name="pprice">
									</div>
								</div>
								
   							<div class="row">
									<div class="col-md-5">
									<label for="exampleInputEmail1">Party Name</label>
									<input type="text" class="form-control1" placeholder="Purchased From" id="partyname" name="partyname">
									</div>
								</div>


								<div class="row">
									<div class="col-md-5">
									<label for="exampleInputEmail1">Size</label>
									<input type="text" class="form-control1" value="0" placeholder="Unit" id="size" name="size">
									</div>
									
									<div class="col-md-5">
									<label for="exampleInputEmail1">UPC (Barcode)</label>
									<input type="text" class="form-control1" value="0" placeholder="Barcode data" id="upc" name="upc">
									</div>
								</div>
								
								<div class="row">
								<div class="col-md-5">								
									<label for="exampleInputEmail1">EAN Code:</label>
									<input type="text" class="form-control1" value="0" placeholder="EAN Code" id="ean" name="ean">
								</div>
								
									<div class="col-md-5">
									<label for="exampleInputEmail1">Quantity</label>
									<input type="text" class="form-control1" value="0" id="qty" placeholder="Quantity" name="quantity">
									</div>
								</div>					
								<div class="clearfix"> </div>

						  <button type="submit" class="btn btn-default">Submit</button> 
							  </form> 
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
        
<script type="text/javascript" >
var xhttp_request = new XMLHttpRequest();
var fields = ["hsn","ean","sprice","pprice","size","partyname","upc","qty"];
function load_stock_data() {
for (var i=0;i<=8;i++) {
	xhttp_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById(fields[i]).value = receive_data;
         }
   	};
        xhttp_request.open("POST", "stock_serverside.php?type=stock_ajax", false);
        xhttp_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp_request.send("name_of_product=" + document.getElementById("name_of_product").value + "&what=" + fields[i]);
     }
}
</script>

        
<?php
$call->read_foot();
?>