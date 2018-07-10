<?php
require("auto_load_bill.php");
require("load_html.php");
$call = new loads;
$call->read_head();
?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<div class="bs-example widget-shadow" data-example-id="bordered-table"> 
						<h4>Billing</h4>
						<table class="table table-bordered">
						<tbody>
						<tr>
						<td>
						<!-- <input type="text" list="products" class="form-control1" placeholder="Product name" onkeypress="return enter_product()" id="pd_name" />-->
						<select class="form-control1" placeholder="Product name" onkeypress="return enter_product()" id="pd_name">
						<?php $y = new auto_load;
						$y->load_what("Item_Name")?>
						</select>
						</td>

						<td>
						<input list="barcode" type="text" class="form-control1" placeholder="Scan barcode" onkeypress="return enter_product()" id="bd_code" />
						<datalist id="barcode">
						<?php $y->load_what("Barcode"); ?>
						</datalist>
						</td>
						</tr>
						</tbody>
						</table>
						
						<table class="table table-bordered" id="bills">
						  <col width="30%">
  							<col width="20%">
							<col width="20%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
						<thead>
							<th>Product</th>
							<th>Quantity</th>
							<th>Rate</th>
							<th>Hsn</th>
							<th>Tax</th>
							<th>Cost</th>
						</thead>
						<tbody id="payment_area">
							<tr id="select_payment">
								<td colspan="2">Payment Type:</td>
								<td colspan="1" "select_card">
								  <select name="payment" onchange="payment_mode()" id="payment_mode" class="form-control1">
									<option></option>
    								<option value="Cash">Cash</option>
    								<option value="Card">Card</option>
    								<option value="Composite">Composite</option>
								  </select>
								 </td>
							</tr>
							<tr>
								<td colspan="4">Total :</td>
								<td colspan="2" id="total_final"></td>					
							</tr>
					
						</tbody>
						</table>
							<button class="btn btn-primary" style="float: right; margin: 1%;" onclick="print_only()">Print Only</button>
							<button class="btn btn-primary" style="float: right; margin: 1%;" onclick="save_print()">Print and Save</button>
							<button class="btn btn-primary" style="float: right; margin: 1%;" onclick="save_only()">Save Only</button>

					</div>

					</div>
			</div>
			</div>


<script type="text/javascript" >

var included = []; //Keeps track of products included. 
var total = 0;
//--------------------cash or composite------------


function payment_mode() {	
	this.total = 0;
	var count;
	var row = document.getElementById("select_payment");

	if (row.cells.length  > 2) {
		row.deleteCell(2);
		row.deleteCell(3);
		row.deleteCell(4);
		row.deleteCell(5);
	}
	else {
		
	}	
	
	for(count=0; count<this.included.length; count++) {
	this.total += parseInt(document.getElementById(this.included[count] + "cost").innerHTML);
	}
	
	document.getElementById("total_final").innerHTML = this.total;	
	var table = document.getElementById("bills");


	
	if (document.getElementById("payment_mode").value == "Card") {
		var select_bank = row.insertCell(2);
		select_bank.innerHTML = '<select name="payment" id="payment_mode" class="form-control1"><option value="HDFC">HDFC</option><option value="ICICI">ICICI</option><option value="BOB">BOB</option></select>';
	}
	else {
		
	}
	
	if (document.getElementById("payment_mode").value == "Composite") {
		var select_bank = row.insertCell(2);
		select_bank.innerHTML = '<select name="payment" id="payment_mode" class="form-control1"><option value="HDFC">HDFC</option><option value="ICICI">ICICI</option><option value="BOB">BOB</option></select>';
		var cash_amount = row.insertCell(3);
		cash_amount.innerHTML = '<input type="text" placeholder="Cash amount" class="form-control1" />';
		var card_amount = row.insertCell(4);
		card_amount.innerHTML = '<input type="text" placeholder="Card amount " class="form-control1" />';
	}
	else {
	}	
}
//-------------------------------------------------

var form_data = ["SPrice","HSNCode"]; // array for retriving fields in database.
var form_feild = []; //this array holds data temporary for the table cells.
function splice_array(btn_name){
	var item_id;
	for (var z=0; z<=this.included.length; z++){
	 item_id = this.included.indexOf(btn_name);	
		if (btn_name == this.included[z]) {
			this.included.splice(item_id);
			break;
		}
	}
}


function enter_product() {
var array_s = 0
var index=1;
var id;
var qty=1;
var roll=1;
var attrib = [];
var set;

var do_not_execute = 1;
var http_req = new XMLHttpRequest();

for(array_s;array_s <= this.included.length;array_s++){
	if (this.included[array_s] == document.getElementById("pd_name").value) {
			var val = document.getElementById(document.getElementById("pd_name").value + "qty").value;
			
			document.getElementById(document.getElementById("pd_name").value + "qty").value = ++val;

			http_req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	 var new_cost = this.responseText;
                document.getElementById(document.getElementById("pd_name").value + "cost").innerHTML = new_cost * val;
            }
        };
        http_req.open("POST", "auto_load_bill.php", false);
        http_req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http_req.send("val=HSNCode" + "&pdname=" + document.getElementById("pd_name").value);

			document.getElementById("pd_name").value = "";
			document.getElementById("pd_name").placeholder = "Product Name";
			document.getElementById("bd_code").value = "";
			document.getElementById("bd_code").placeholder = "Barcode";			
			do_not_execute = 0;
			break;
	}
	else {

	}
}

if(do_not_execute){
var get_table = document.getElementById("bills");
var add_row = get_table.insertRow(index);

this.form_feild[0] = add_row.insertCell(0);// product
this.form_feild[1] = add_row.insertCell(1);// qty
this.form_feild[2] = add_row.insertCell(2);// rate
this.form_feild[3] = add_row.insertCell(3);// HSN
this.form_feild[4] = add_row.insertCell(4);// cost
this.form_feild[5] = add_row.insertCell(5);// tax
this.form_feild[6] = add_row.insertCell(6);// remove btn

add_row.id = "b" + index;

var qty = document.createElement("input");
var button = document.createElement("button");
button.innerHTML = "X Remove";


this.form_feild[0].innerHTML = document.getElementById("pd_name").value;
this.included.push(document.getElementById("pd_name").value);
this.form_feild[0].id = document.getElementById("pd_name").value;
attrib[0] = this.form_feild[2].id = document.getElementById("pd_name").value + form_data[0];
attrib[1] = this.form_feild[3].id = document.getElementById("pd_name").value + form_data[1];
this.form_feild[5].id = document.getElementById("pd_name").value + "cost";

qty.id = document.getElementById("pd_name").value + "qty";
qty.name = document.getElementById("pd_name").value;
qty.setAttribute("parent-node", document.getElementById("pd_name").value);

button.id = index;
button.name = document.getElementById("pd_name").value;
 
button.onclick = function () {
	id = this.parentNode.parentNode.rowIndex;
	document.getElementById("bills").deleteRow(id);
	splice_array(button.getAttribute("name"));
	index--;
}

this.form_feild[6].appendChild(button);
document.getElementById("pd_name").value = "";
document.getElementById("bd_code").value = "";
index++;


for (var i=0;i<=1;i++) {
	set = attrib[i];		//Remember in the function below the parent changes as a result we are passing array elements to a variable. 
 	http_req.onreadystatechange = function() { 	//Used to obtain rate and HSNCode.
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(set).innerHTML = this.responseText;
            }
        };
        http_req.open("POST", "auto_load_bill.php", false);
        http_req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http_req.send("val=" + this.form_data[i] + "&pdname=" + this.form_feild[0].getAttribute("id"));
}
     
this.form_feild[1].appendChild(qty);
qty.defaultValue = 1;
var rate = document.getElementById(this.form_feild[2].getAttribute("id")).innerHTML; //get rate
document.getElementById(this.form_feild[5].getAttribute("id")).innerHTML = 1 * rate; 
var cost = this.form_feild[5].getAttribute("id");
qty.onkeyup = function () {
	var nos = this.value;
	document.getElementById(this.getAttribute("parent-node") + "cost").innerHTML = rate*nos;
	}
 }
}

function create_temp_form() {
	var temp_form = document.createElement("form");
	temp_form.method = "POST";
	temp_form.action = "billing_complete.php";
	var elements = [];
	var costs = [];
	var quantity = [];
	var hsn = [];
	var rate = [];
	
	document.body.appendChild(temp_form);
	for (var i=0;i<= this.included.length - 1; i++) {
		elements[i] = document.createElement("input");
		elements[i].name = "item_" + i;
		elements[i].value = this.included[i];
		elements[i].type = "hidden";
		temp_form.appendChild(elements[i]);
	}
	
/*	for (var j=0;j<= this.included.length - 1; j++) {
		costs[j] = document.createElement("input");
		costs[j].name = this.included[j] + "cost";
		costs[j].value = document.getElementById(this.included[j] + "cost").innerHTML;
		costs[j].type = "hidden";
		temp_form.appendChild(costs[j]);
	}*/
	
	for (var k=0;k<= this.included.length - 1; k++) {
		quantity[k] = document.createElement("input");
		quantity[k].name = this.included[k] + ".qty";
		quantity[k].value = document.getElementById(this.included[k] + "qty").value;
		quantity[k].type = "hidden";
		temp_form.appendChild(quantity[k]);				
	}
	
	for (var l=0;l<= this.included.length - 1; l++) {
		hsn[l] = document.createElement("input");
		hsn[l].name = this.included[l] + ".HSNCode";
		hsn[l].value = document.getElementById(this.included[l] + "HSNCode").innerHTML;
		hsn[l].type = "hidden";
		temp_form.appendChild(hsn[l]);
	}
	
	for (var m=0;m<= this.included.length - 1; m++) {
		rate[m] = document.createElement("input");
		rate[m].name = this.included[m] + ".SPrice";
		rate[m].value = document.getElementById(this.included[m] + "SPrice").innerHTML;
		rate[m].type = "hidden";
		temp_form.appendChild(rate[m]);
	}
	
	var total_items = document.createElement("input");
	total_items.name = "length";
	total_items.value = this.included.length;	
	total_items.type = "hidden";
	temp_form.appendChild(total_items);	

	
	var total_cost =  document.createElement("input");
	total_cost.name = "total_final";
	total_cost.value = document.getElementById("total_final").innerHTML;
	temp_form.appendChild(total_cost);
	total_cost.type = "hidden";
	temp_form.submit();
}

function save_only() {
	if (this.included.length < 1) {
		alert("Cannot save, No items included!");
	}
	else {
		this.create_temp_form();
	}
}

function print_only() {
	if (this.included.length < 1) {
		alert("Cannot print, No items included!");
	}
	else {
		alert(document.getElementsByName("item_2").innerHTML);
	}
}

function save_print() {
	if (this.included.length < 1) {
		alert("Cannot save and print, No items included!");
	}
	else {
	
	}
}
</script>



<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<?php
$call->read_foot();
?>