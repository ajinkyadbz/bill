<?php

class loads {
	protected $file_data;
	
	function read_head() {
		$this->file_data = fopen("start.html", "r");
		echo fread($this->file_data,filesize("start.html"));
		fclose($this->file_data);
	}
	
	function read_foot() {
		$this->file_data = fopen("end.html", "r");
		echo fread($this->file_data,filesize("end.html"));
		fclose($this->file_data);
	}
}
?>