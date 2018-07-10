<?php
require("database_link.php");
class auto_load extends link_db{

protected $query_data;
protected $sql;
protected $fetch;
protected $get_nos;
protected $say;


	function load_what($what) {
		$this->say = new link_db;
		$this->say->connect_database();
		
		$this->query_data = "SELECT * FROM mytable";
		$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->get_nos = mysqli_num_rows($this->sql);
		for($loop=1;$loop<= $this->get_nos;$loop++) {
			$this->query_data = "SELECT * FROM mytable WHERE SlNo='$loop'";
			$this->sql = mysqli_query($this->say->connect_form,$this->query_data);
			$this->fetch = mysqli_fetch_assoc($this->sql);
			echo "<option name='".$this->fetch[$what]."'>" .$this->fetch[$what]. "</option>";
		}
	}
	
	function load_ajax_data($what,$what2){
		$this->say = new link_db;
		$this->say->connect_database();
		$this->query_data = "SELECT * FROM mytable WHERE Item_Name='$what2'";
	   $this->sql = mysqli_query($this->say->connect_form,$this->query_data);
		$this->fetch = mysqli_fetch_assoc($this->sql);
		print $this->fetch[$what];
	}
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
$call = new auto_load;
$call->load_ajax_data($_POST["val"],$_POST["pdname"]);
}
?>