<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
<?php
require("autocomplete.php");
require("load_html.php");
$call = new loads;
$call->read_head();
?>


		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Check <?php echo $_GET["check_what"] ?></h2>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms">
						<div class="form-title">
							<h4>Check Specific <?php echo $_GET["check_what"] ?>:</h4>
						</div>
						<div class="form-body">
							<form action="#" method="POST"> 
								<div class="form-group">
									<div class="row">																				
										<div class="col-md-12 grid_box1">
										<label for="exampleInputEmail1">Enter Name</label>
										<input type="text" list="products" class="form-control1" placeholder="Name" name="check">
										<datalist id="products">
											<?php
											$auto_c = new auto_complete($_GET["check_what"],"1",$_POST["check"]);
											?>
										</datalist>
										</div>
									</div>
									</div>

								<div class="clearfix"> </div>

						  <button type="submit" class="btn btn-default">Check</button> 
						  </form>

						 
						<?php
                     $auto_c = new auto_complete($_GET["check_what"],"2",$_POST["check"]);
						?>
						</div>
														
				</div>
			</div>
						
			<div class="col-sm-14 wthree-crd widgettable">
                            <div class="card">
                                <div class="card-body">
												<div class="agileinfo-cdr">
                                        
                                <div class="card-header">
                                    <h3>Report</h3>
                                </div>
                                <hr class="widget-separator">
                                        
                                       
                                                
																	<?php
																	$auto_c = new auto_complete($_GET["check_what"],"3",$_POST["check"]);
																	?>

                                        </div>
                                    </div>
											</div>
										</div>
									</div>
					</div>
			</div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  -->
<?php
$call->read_foot();
?>