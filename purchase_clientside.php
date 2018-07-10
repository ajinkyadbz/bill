<?php
require("load_html.php");
$call = new loads;
$call->read_head();
?>

<!-- ----------------------------------------------------------------------------------------------------------------------------------------- -->

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<div class="bs-example widget-shadow" data-example-id="bordered-table"> 
						<h4>Purchases</h4>
						<table class="table table-bordered">
						<tbody>
						<tr>
						<td>
						<input type="text" class="form-control1" placeholder="Attendant" />						
						</td>						
						
						<td>
						<select class="form-control1" id="vd_name" onclick="load_products()">
							<?php
							require("purchase_serverside.php");
							$get_vendor_names = new purchase_serverside;
							$get_vendor_names->list_vendor_names();
							?>
						</select>
						</td>

						<td>
						<select class="form-control1" id="pd_name" onkeypress="return load_table_rows();"></select>
						<div hidden="true" id="pd_cost"></div>
						</td>
						</tr>
						</tbody>
						</table>
						
						<table class="table table-bordered" id="bills">
						<col width="50%">
						<col width="20%">
						<col width="20%">
						<thead>
							<th>Product</th>
							<th>Quantity</th>
							<th>Cost</th>
							<th></th>
						</thead>
						<tbody id="payment_area">
							<tr>
								<td colspan="2">Cash:</td>
								<td colspan="1"></td>
								<td colspan="1"><input type="text" id="cash" value="0"  onchange="track_balance('cash')" /></td>
							</tr>

							<tr>
								<td colspan="2">Card 1:</td>
								<td colspan="1">
								<select id="card1_bank">
									<option></option>
									<option>IDBI BANK</option>
									<option>ICIC BANK</option>
									<option>HDFC BANK</option>
									<option>HSBC BANK</option>
								</select></td>
								<td colspan="1"><input type="text" id="card1" value="0"  onchange="track_balance('card1')" /></td>
							</tr>
							
  							<tr>
								<td colspan="2">Card 2:</td>
								<td colspan="1">
								<select id="card2_bank">
									<option></option>
									<option>IDBI BANK</option>
									<option>ICIC BANK</option>
									<option>HDFC BANK</option>
									<option>HSBC BANK</option>
								</select></td>
								<td colspan="1"><input type="text" id="card2" value="0"  onchange="track_balance('card2')" /></td>
							</tr>
							
							<tr>
								<td colspan="2">Card 3:</td>
								<td colspan="1">
								<select id="card3_bank">
									<option></option>
									<option>IDBI BANK</option>
									<option>ICIC BANK</option>
									<option>HDFC BANK</option>
									<option>HSBC BANK</option>
								</select></td>
								<td colspan="1"><input type="text" id="card3" value="0" onchange="track_balance('card3')" /></td>
							</tr>

							<tr>
								<td colspan="2">Cheque 1:</td>
								<td colspan="1">
								<select id="cheque4_bank">
									<option></option>
									<option>IDBI BANK</option>
									<option>ICIC BANK</option>
									<option>HDFC BANK</option>
									<option>HSBC BANK</option>
								</select></td>
								<td colspan="1"><input type="text" id="cheque4" value="0"  onchange="track_balance('cheque4')"/></td>
							</tr>


							<tr>
								<td colspan="2">Cheque 2:</td>
								<td colspan="1">
								<select  id="cheque5_bank">
									<option></option>
									<option>IDBI BANK</option>
									<option>ICIC BANK</option>
									<option>HDFC BANK</option>
									<option>HSBC BANK</option>
								</select></td>
								<td colspan="1"><input type="text" id="cheque5" value="0"  onchange="track_balance('cheque5')"/></td>
							</tr>
							
							<tr>
								<td colspan="3">Balance :</td>
								<td colspan="2" id="balance"></td>					
							</tr>

							
							<tr onclick="generate_total()">
								<td colspan="3">Total :</td>
								<td colspan="2" id="total_final"></td>					
							</tr>
					
						</tbody>
						</table>
							<button class="btn btn-primary" style="float: right; margin: 1%;" onclick="submit_form()">Print and Save</button>

					</div>

					</div>
			</div>
			</div>
			


<!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->

<script type="text/javascript" >
var xhttp_request = new XMLHttpRequest();
var product_list_array = [];
var total_amount = 0;
var balance;

var product_exists = false;

function load_products() {
xhttp_request.onreadystatechange = function () {
		       if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById("pd_name").innerHTML = receive_data;
             document.getElementById("pd_cost").innerHTML = receive_data;
	     		  }
   			};
xhttp_request.open("POST", "purchase_serverside.php?type=pdname", false);
xhttp_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp_request.send("pd_name=" + document.getElementById("vd_name").value);
}


function check_if_product_exists(){
	for (var i=0; i<=product_list_array.length-1; i++) {
		if (document.getElementById("pd_name").value == this.product_list_array[i]) {
			this.product_exists = true;
		}
	}
}


function load_table_rows() {

	check_if_product_exists();

	

	if (this.product_exists) {
	 var scrolltv = document.getElementById(document.getElementById("pd_name").value + "name");
	 scrolltv.scrollIntoView();
	 var original_background = scrolltv.style.backgroundColor;

	scrolltv.style.backgroundColor = "#42e5f4";
	
	setTimeout(function(){
       scrolltv.style.backgroundColor = original_background;
    },(1000)); 
    this.product_exists = false;
	}
	
	else {	
	var products_table = document.getElementById("bills");
	var row_cells = products_table.insertRow(1);
	var button = document.createElement("button");
	
	var qty_input = document.createElement("input");
	
	this.product_list_array.push(document.getElementById("pd_name").value);
	
	button.innerHTML = "X Remove";
	button.onclick = function () {
		document.getElementById("bills").deleteRow(this.parentNode.parentNode.rowIndex);// removes current row.
		
		//The code below removes the element form the array.
		for (var len=0; len<=product_list_array.length-1 ;len++) {
			if (this.getAttribute("common") == product_list_array[len]) {
				this.product_list_array.splice(len,1);
			}
		}
	}
	
	for (var i=0; i<=3; i++) {
		var get_cell = row_cells.insertCell(i);
		switch(i) {
			case 0:
				get_cell.innerHTML = document.getElementById("pd_name").value;
				get_cell.setAttribute("name", document.getElementById("pd_name").value + "name");
				get_cell.setAttribute("id", document.getElementById("pd_name").value + "name");
				break;
			case 1:
				get_cell.appendChild(qty_input);
				qty_input.value = 1;
				qty_input.setAttribute("name", document.getElementById("pd_name").value + "qty");
				qty_input.setAttribute("id", document.getElementById("pd_name").value + "qty");
				qty_input.setAttribute("common", document.getElementById("pd_name").value); //**created an attribute common to 
				break;
			case 2:
				get_cell.setAttribute("name", document.getElementById("pd_name").value + "cost");
				get_cell.setAttribute("id", document.getElementById("pd_name").value + "cost");
				get_cell.setAttribute("common", document.getElementById("pd_name").value); //**this
				var price = document.getElementById(document.getElementById("pd_name").value + "price").innerHTML;
				var tax = 0.18 * parseFloat(price, 10);
				get_cell.innerHTML = parseFloat(tax, 10) + parseFloat(price, 10);

				document.getElementById(document.getElementById("pd_name").value + "qty").onchange = function () {
					document.getElementById(this.getAttribute("common") + "cost").innerHTML = (parseFloat(tax, 10) * document.getElementById(this.getAttribute("common") + "qty").value) + (parseFloat(price, 10) * document.getElementById(this.getAttribute("common") + "qty").value);
				}
				break;
			case 3:
				get_cell.appendChild(button);// **and this
				button.setAttribute("common", document.getElementById("pd_name").value);
				break;
		}
	  }
	}
}

function generate_total() {
	for (var fin_len=0; fin_len<= this.product_list_array.length-1; fin_len++) {
		this.total_amount = this.total_amount + parseFloat(document.getElementById(this.product_list_array[fin_len] + "cost").innerHTML, 10);
		this.balance = this.total_amount;
		document.getElementById("balance").innerHTML = this.balance;
	}
	document.getElementById("total_final").innerHTML = this.total_amount;
}

function track_balance(pay_type) {
	switch(pay_type) {
		case "cash":
			balance = balance-document.getElementById("cash").value;
			document.getElementById("balance").innerHTML = this.balance;
			break;
			
		case "card1":
			balance = balance-document.getElementById("card1").value;
			document.getElementById("balance").innerHTML = this.balance;
			break;
			
		case "card2":
			balance = balance-document.getElementById("card2").value;
			document.getElementById("balance").innerHTML = this.balance;
			break;
			
		case "card3":
			balance = balance-document.getElementById("card3").value;
			document.getElementById("balance").innerHTML = this.balance;
			break;
		case "cheque4":
			balance = balance-document.getElementById("cheque4").value;
			document.getElementById("balance").innerHTML = this.balance;
			break;

		case "cheque5":
			balance = balance-document.getElementById("cheque5").value;
			document.getElementById("balance").innerHTML = this.balance;
			break;
	}
}

function submit_form() {
	
	var no_of_products = this.product_list_array.length - 1;
	var temporary_form = document.createElement("form");
	temporary_form.method = "POST";
	temporary_form.action = "purchase_serverside.php?type=form";
	
	document.body.appendChild(temporary_form);
	
	var list_of_products = [];
	var qty_of_each_product = [];
	var cost_of_each_product = [];
	
	
	var modes_of_payment = ["cash","card1","card2","card3","cheque4","cheque5"];
	var fake_input_for_mode_of_payment = [];
	var banks = [];
	var submit_balance;
	var submit_total;
	var length_of_product_array;
	var i = 0;
	var j = 0;	
	
	for (i=0;i<=no_of_products;i++) {
		list_of_products[i] = document.createElement("input");
		list_of_products[i].name = "item_" + i;
		list_of_products[i].value = this.product_list_array[i];
		list_of_products[i].type = "hidden";
		temporary_form.appendChild(list_of_products[i]);
	}
	
	for (var k=0;k<=no_of_products;k++) {
		qty_of_each_product[k] = document.createElement("input");
		qty_of_each_product[k].name = "qty_" + k;
		qty_of_each_product[k].value = document.getElementById(this.product_list_array[k] + "qty").value;
		qty_of_each_product[k].type = "hidden";
		temporary_form.appendChild(qty_of_each_product[k]);
	}
		
	for (var l=0;l<=no_of_products;l++) {
		cost_of_each_product[l] = document.createElement("input");
		cost_of_each_product[l].name = "cost_" + l;
		cost_of_each_product[l].value = document.getElementById(this.product_list_array[l] + "cost").innerHTML;
		cost_of_each_product[l].type = "hidden";
		temporary_form.appendChild(cost_of_each_product[l]);
	}
	 
	 var get_selected;
	 
	while (j<=5){
		switch(j) {
			case 0:
			fake_input_for_mode_of_payment[j] = document.createElement("input");
			fake_input_for_mode_of_payment[j].name = "cash";
			fake_input_for_mode_of_payment[j].type = "hidden";
			fake_input_for_mode_of_payment[j].value = document.getElementById("cash").value;
			temporary_form.appendChild(fake_input_for_mode_of_payment[j]);
			break;
			
			case 1:
			case 2:
			case 3:
			fake_input_for_mode_of_payment[j] = document.createElement("input");
			fake_input_for_mode_of_payment[j].name = "card" + j;
			fake_input_for_mode_of_payment[j].type = "hidden";
			fake_input_for_mode_of_payment[j].value = document.getElementById("card" + j).value;
			temporary_form.appendChild(fake_input_for_mode_of_payment[j]);
			
			banks[j] = document.createElement("input");
			banks[j].name = "card" + j + "bank";
			banks[j].type = "hidden";
			get_selected = document.getElementById("card" + j + "_bank"); 
			banks[j].value = get_selected.options[get_selected.selectedIndex].value;
			temporary_form.appendChild(banks[j]);
			break;
			
			case 4:
			case 5:
			fake_input_for_mode_of_payment[j] = document.createElement("input");
			fake_input_for_mode_of_payment[j].name = "cheque" + j;
			fake_input_for_mode_of_payment[j].type = "hidden";
			fake_input_for_mode_of_payment[j].value = document.getElementById("cheque" + j).value;
			temporary_form.appendChild(fake_input_for_mode_of_payment[j]);
			
			banks[j] = document.createElement("input");
			banks[j].name = "cheque" + j + "bank";
			banks[j].type = "hidden";
			get_selected = document.getElementById("cheque" + j + "_bank");
			banks[j].value = get_selected.options[get_selected.selectedIndex].value;
			temporary_form.appendChild(banks[j]);
			break;						
		}	
		j++;
	}

	submit_balance = document.createElement("input");
	submit_balance.name = "balance";
	submit_balance.value = document.getElementById("balance").innerHTML;
	submit_balance.type = "hidden";
	temporary_form.appendChild(submit_balance);
	
	submit_total = document.createElement("input");
	submit_total.name = "total";
	submit_total.value = this.total_amount;
	submit_total.type = "hidden";
	temporary_form.appendChild(submit_total);
	
	length_of_product_array = document.createElement("input");
	length_of_product_array.name = "total_products";
	length_of_product_array.type = "hidden";
	length_of_product_array.value = no_of_products;
	temporary_form.appendChild(length_of_product_array);
	
	temporary_form.submit();
}
</script>

<?php
$call->read_foot();
?>