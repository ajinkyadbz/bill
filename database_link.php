<?php

define("SQL_CONNECTION_DEFAULT_STATUS", false);

class link_db{
	private $server_name = "localhost";
	private $user_name = "root";
	private $password = "apache8812";
	private $database_name = "bill";
	protected $connect_form = SQL_CONNECTION_DEFAULT_STATUS;
	protected $db_select;
	
	function connect_database() {
		$this->connect_form = new mysqli($this->server_name, $this->user_name, $this->password);		
		if(mysqli_connect_error()) {
			    die('Connect Error: ' . mysqli_connect_error());
		}
		else {
				 //echo "Connected";
				 $this->db_select = mysqli_select_db($this->connect_form,"bill");				 
		}
	}	
}
?>