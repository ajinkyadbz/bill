<?php
require("load_html.php");
$call = new loads;
$call->read_head();
?>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Purchase Invoices</h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Enter Dates</h4>
						</div>
						<div class="form-body">
							
							<div class="form-group">
									<div class="row">									
										<div class="col-md-5">
										<label for="exampleInputEmail1">From Date: </label>
										<input class="form-control1" id="from_date" type="date"/>
										</div>

										<div class="col-md-5">
										<label for="exampleInputEmail1">To Date: </label>
										<input class="form-control1" id="to_date" type="date" onchange="get_bills()"/>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-5">
										<label for="exampleInputEmail1">Select Bill </label>
										<select class="form-control1" id="select_bill">
										
										</select>
										</div>									
									</div>
									
									<div class="row">
										<button class="btn btn-default" onclick="display_selected_bill()">Load Bills</button>									
									</div>
								</div>
						</div>
					</div>
					
					<div class="forms">
					<h2 class="title1"> </h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Bills</h4>
						</div>
						<div class="form-body">
							<div class="form-group">
								<div id="bills"></div>
							</div>
						<div class="row">
							<button class="btn btn-default" onclick="print_bill()">Load Bills</button>									
						</div>
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

<script type="text/javascript" >
var xhttp_request = new XMLHttpRequest();
var http_request = new XMLHttpRequest();
function get_bills() {
	var get_date = new Date(document.getElementById("from_date").value);
	var day = get_date.getDate();

	if (day < 10) {
		day = "0" + day;
	}
	
	var month = get_date.getMonth();
	month++;
	if (month < 10) {
		month = "0" + month;
	}
	var year = get_date.getFullYear();
	var year = year-2000;
	var from_date = "" + day + month + year;
	
	get_date = new Date(document.getElementById("to_date").value);
	day = get_date.getDate();
	if (day < 10) {
		day = "0" + day;
	}
	
	month = get_date.getMonth();
	month++;
	if (month < 10) {
		month = "0" + month;
	}
	year = get_date.getFullYear();
	year = year-2000;
	var to_date = ""+ day + month + year;
	
	 		
		xhttp_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById("select_bill").innerHTML = receive_data;
         }
   	};
        xhttp_request.open("POST", "purchase_invoice_serverside.php" , false);
        xhttp_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp_request.send("load_what=bill_no&from_date=" + from_date + "&to_date=" + to_date);
}

function display_selected_bill() {
	var d = document.getElementById("select_bill");
	var bill_no = d.options[d.selectedIndex].value;	
		http_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById("bills").innerHTML = receive_data;
         }
   	};
        http_request.open("POST", "purchase_invoice_serverside.php" , false);
        http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http_request.send("load_what=bill&bill_no=" + bill_no);
}

function print_bill() {		
		var mywindow = window.open("","Print");
		mywindow.document.write("<html><body>");
		mywindow.document.write(document.getElementById("bills").innerHTML);
		mywindow.document.write("</body></html>");
		mywindow.print();
		mywindow.close();
}
</script>

<?php
$call->read_foot();
?>