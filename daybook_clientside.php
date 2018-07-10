<?php
require("load_html.php");
$call = new loads;
$call->read_head();
?>
//----------------------------------------------------------------------

		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<div class="form-grids row widget-shadow" onchange="load_daybook()" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Select Date:</h4>
						</div>
						<div class="form-body">
							<input class="form-control" id="date" type="date"/>
						</div>

						<div class="col-md-12 panel-grids">
							<div class="panel panel-primary">
							 <div class="panel-heading">
							 <h3 class="panel-title">Daybook</h3>
							 </div>
							 <div class="panel-body" id="daybook" style="width: 300px;">
							 <div id="show_date"></div>
							 </div>
							 <div id="show_data"></div>
						   </div>
						</div>
					</div>						
				</div>
			  </div>
			</div>

<!--footer-->
<div class="footer">
	   <p>&copy; 2018 Gigmoz. All Rights Reserved</p>
</div>
<!--//footer-->

<script type="text/javascript" >
var http_request = new XMLHttpRequest();
function load_daybook() {

	get_date = new Date(document.getElementById("date").value);
	
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

	document.getElementById("show_date").innerHTML = "Date:" + document.getElementById("date").value;
	http_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById("show_data").innerHTML = receive_data;
         }
   	};
        http_request.open("POST", "daybook_serverside.php", false);
        http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http_request.send("date=" + day + month + year);
}
</script>

<?php
$call->read_foot();
?>