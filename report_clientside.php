<?php
require("load_html.php");
$call = new loads;
$call->read_head();
?>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Reports</h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Enter Report Data</h4>
						</div>
						<div class="form-body">
							
							<div class="form-group">
									<div class="row">									
										<div class="col-md-5 grid_box1">
										<label for="exampleInputEmail1">Report Type: </label>
										<select class="form-control1" name="report_type" id="report_type" onchange="load_payment_type()">
										<option></option>
										<option>Sells Report</option>
										<option>Purchase Report</option>
										</select>
										</div>
										
										<div class="col-md-5">
										<label for="exampleInputEmail1">From Date: </label>
										<input class="form-control1" id="from_date" type="date"/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-5">
										<label for="exampleInputEmail1">Payment Type: </label>
										<select class="form-control1" placeholder="Payment type" id="payment_type">
										
										</select>
										</div>
										<div class="col-md-5">
										<label for="exampleInputEmail1">To Date: </label>
										<input class="form-control1" id="to_date" type="date"/>
										</div>
									</div>
									
									<div class="row">
										<button class="btn btn-default" onclick="generate_report()">Generate Report</button>									
									</div>
								</div>
	
						</div>
					</div>
			</div>

			<div class="forms">
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4 id="report_data"></h4>
						</div>
						<div class="form-body">
							<div id="report">
							
							</div>
							<button class="btn btn-default" onclick="print_report()">Print Report</button>
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

	document.addEventListener("keydown",key_check,true)
	
	function key_check(e) {
		if (e.keyCode == 80 || e.keyCode == 17) {
			print_report();
		}
	}

	function print_report() {

		var report_type = document.getElementById("report_type");
		var obtain_from_list = report_type.options[report_type.selectedIndex].value;
		
		var payment_type = document.getElementById("payment_type");
		var obtain_payment_type = payment_type.options[payment_type.selectedIndex].value;		
		
		var mywindow = window.open("","Print");
		mywindow.document.write("<html><body>");
		mywindow.document.write("<h2>Kallatra Dry Fruits</h2><p>shop no 325 nawab building,<br />Dr D N Road,Opp Thomas Cook,<br />Near City Bank,<br /> Fort,<br /> Mumbai, Maharashtra 400001</p>");
		mywindow.document.write(obtain_from_list + " - " + obtain_payment_type + " - " + document.getElementById("from_date").value + " to " + document.getElementById("to_date").value);
		mywindow.document.write(document.getElementById("report").innerHTML);
		mywindow.document.write("</body></html>");
		mywindow.print();
		mywindow.close();
	}

	function load_payment_type() {
		var report_type = document.getElementById("report_type");
		var obtain_from_list = report_type.options[report_type.selectedIndex].value;
		if (obtain_from_list == "Sells Report") {
			document.getElementById("payment_type").innerHTML = "<option>Cash</option><option>card</option>"; 
		}
		else {
			document.getElementById("payment_type").innerHTML = "<option>Cash</option><option>card</option><option>cheque</option>";
		}
	}
	
	function generate_report() {
		
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
	
	
		var report_type = document.getElementById("report_type");
		var obtain_from_list = report_type.options[report_type.selectedIndex].value;
		
		var payment_type = document.getElementById("payment_type");
		var obtain_payment_type = payment_type.options[payment_type.selectedIndex].value;
 		
		xhttp_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById("report").innerHTML = receive_data;
         }
   	};
        xhttp_request.open("POST", "report_serverside.php" , false);
        xhttp_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp_request.send("report_type=" + obtain_from_list + "&payment_type=" + obtain_payment_type + "&from_date=" + from_date + "&to_date=" + to_date);
        
        
        document.getElementById("report_data").innerHTML = obtain_from_list + " -  " + obtain_payment_type + " payments";  
     }
</script>

<?php
$call->read_foot();
?>