<?php
require("load_html.php");
$call = new loads;
$call->read_head();
?>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->

		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Vendor Profile</h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Enter Vendor Data :</h4>
						</div>
						<div class="form-body">
							<form action="vendors_serverside.php?type=vendor_form" method="post"> 
								<div class="form-group">
									<div class="row">																				
										<div class="col-md-5 grid_box1">
										<label for="exampleInputEmail1">Company Name</label>
										<input type="text" list="vendors" name="name" id="name" class="form-control1" placeholder="Name" onkeyup="load_data()">
										<datalist id="vendors">
												<?php
												require("vendors_serverside.php");
												$get_vendors = new vendors;
												$get_vendors->list_vendors();
												?>
										</datalist>
										</div>
				
										<div class="col-md-5">
										<label for="exampleInputEmail1">Email Address</label>
										<input type="text" class="form-control1" name="email" placeholder="Email" id="email">
										</div>
									</div>
										
									<div class="row">
										<div class="col-md-5">
										<label for="exampleInputEmail1">Phone No.</label>
										<input type="text" class="form-control1" name="mobile" placeholder="Phone" id="mobile">
										</div>
																													
										<div class="col-md-5">
										<label for="exampleInputEmail1">Address</label>
										<input type="text" class="form-control1" id="address" name="address" placeholder="Address">
										</div>
									</div>
									
									
									<div class="row">								
										<div class="col-md-5">
										<label for="exampleInputEmail1">GSTN No.</label>
										<input type="text" class="form-control1" name="gstn" placeholder="GSTN No." id="gstn">
										</div>
									</div>

								<div class="clearfix"> </div>

						  <button type="submit" class="btn btn-default" name="submit">Submit</button> 
							  </form>
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
var fields = ["email","mobile","address","gstn"];
function load_data() {
for (var i=0;i<=3;i++) {
	xhttp_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          	 var receive_data = this.responseText;
             document.getElementById(fields[i]).value = receive_data;
         }
   	};
        xhttp_request.open("POST", "vendors_serverside.php?type=vendor_ajax", false);
        xhttp_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp_request.send("name_of_vendor=" + document.getElementById("name").value + "&what=" + fields[i]);
     }
}
</script>
<?php
$call->read_foot();
?>