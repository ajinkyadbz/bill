<?php
require("database_link.php");

class auto_complete extends link_db{
	protected $query_data;
	protected $sql;
	protected $fetch;
	protected $get_id;
	protected $get_table;
	protected $say;
	
function __construct($check_what,$section,$check) {

$this->say = new link_db;
$this->say->connect_database();

//switch($_GET["check_what"]) {
switch($check_what) {
case "stocks":
$this->get_id = "product_id";
$this->get_table = "product";
$this->load_product_data($section,$check);
break;

case "customers":
$this->get_id = "company_id";
$this->get_table = "company";
$this->load_customer_data($section,$check);
break;

default:
break;
}
}
 
function load_customer_data($section,$check) {
 	
//-------------------------------------------------------------------------------------------
switch($section) {
case 1:
if($this->say->connect_form) {
$this->query_data = "SELECT name FROM company";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
$last_id = mysqli_num_rows($this->sql);
for($loop=0;$loop<=$last_id;$loop++) {
$this->query_data = "SELECT * FROM company WHERE company_id='$loop'";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
if($this->fetch["company_id"] != null) {	
	echo "<option value='".$this->fetch["name"]."'>";
}
}
}
else {
	print "Error fetching data";
}
break;
//-------------------------------------------------------------------------------------------	
case 2:	
if(($check !="" || $check != "#") && isset($_POST["check"])) {
$this->query_data = "SELECT * FROM company WHERE name='$check'";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
echo <<<EOF
<div class="card-body"><div class="agileinfo-cdr"><hr class="widget-separator">
<div class="widget-body"><table class="table table-bordered"><thead><tr>
<th>ID</th><th>Name</th><th>Quantity</th></tr></thead><tbody><tr><td>
EOF;
echo $this->fetch["company_id"].'</td><td>'.$this->fetch["name"].'</td><td>'.$this->fetch["mobile"].'</td></tr></tbody></table>';    
echo '</div></div></div>';
}
else {
                               	
}
break;
//-------------------------------------------------------------------------------------------
case 3:
$this->query_data = "SELECT * FROM company";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
$last_id = mysqli_num_rows($this->sql);
echo <<<EOF
<div class="widget-body"><table class="table table-bordered"><thead><tr>
<th>ID</th><th>Name</th><th>Quantity</th></tr></thead><tbody>
EOF;

for($loop=1;$loop<=$last_id;$loop++) {
$this->query_data = "SELECT * FROM company WHERE ".$this->get_id."='$loop'";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
if($this->fetch[$this->get_id] != null && $this->get_id == "company_id") {
echo "<tr><td>".$this->fetch["company_id"]."</td>";
echo "<td>".$this->fetch["name"]."</td>";
echo "<td>".$this->fetch["mobile"]."</td></tr>";
}
}
echo "</tbody></table>";
break;
//-------------------------------------------------------------------------------------------	
}

 	}
 	
 	
 	
 	
 	
function load_product_data($section,$check) {
 	
//-------------------------------------------------------------------------------------------
switch($section) {
case 1:
if($this->say->connect_form) {
$this->query_data = "SELECT product_name FROM product";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
$last_id = mysqli_num_rows($this->sql);
for($loop=0;$loop<=$last_id;$loop++) {
$this->query_data = "SELECT * FROM product WHERE product_id='$loop'";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
if($this->fetch["product_id"] != null) {	
	echo "<option value='".$this->fetch["product_name"]."'>";
}
}
}
else {
	print "Error fetching data";
}
break;
//-------------------------------------------------------------------------------------------	
case 2:	
if(($check !="" || $check != "#") && isset($_POST["check"])) {
$this->query_data = "SELECT * FROM product WHERE product_name='$check'";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
echo <<<EOF
<div class="card-body"><div class="agileinfo-cdr"><hr class="widget-separator">
<div class="widget-body"><table class="table table-bordered"><thead><tr>
<th>ID</th><th>Name</th><th>Quantity</th></tr></thead><tbody><tr><td>
EOF;
echo $this->fetch["product_id"].'</td><td>'.$this->fetch["product_name"].'</td><td>'.$this->fetch["stock"].'</td></tr></tbody></table>';    
echo '</div></div></div>';
}
else {
                               	
}
break;
//-------------------------------------------------------------------------------------------
case 3:
$this->query_data = "SELECT * FROM product";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
$last_id = mysqli_num_rows($this->sql);
echo <<<EOF
<div class="widget-body"><table class="table table-bordered"><thead><tr>
<th>ID</th><th>Name</th><th>Quantity</th></tr></thead><tbody>
EOF;

for($loop=1;$loop<=$last_id;$loop++) {
$this->query_data = "SELECT * FROM product WHERE ".$this->get_id."='$loop'";
$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
$this->fetch = mysqli_fetch_assoc($this->sql);
if($this->fetch[$this->get_id] != null && $this->get_id == "product_id") {
echo "<tr><td>".$this->fetch["product_id"]."</td>";
echo "<td>".$this->fetch["product_name"]."</td>";
echo "<td>".$this->fetch["stock"]."</td></tr>";
}
}
echo "</tbody></table>";
break;
//-------------------------------------------------------------------------------------------	
}

 	}
}
?>