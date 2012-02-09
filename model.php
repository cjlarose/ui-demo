<?php

abstract class Model {

	const host = 'localhost';
	const user = 'root';
	const pass = '';
	const db = 'atmo_test';
	public static $connection;

	public static function init() {
		self::$connection = mysql_connect(self::host, self::user, self::pass)
			or die ('Could not connect: ' . mysql_error());
		mysql_select_db(self::db) or die('Could not select database');
	}

	public static function query($query) {
		if (!self::$connection) 
			self::init();
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		return new ResultSet($result);
	}

	public static function get_all() {
		$query = "SELECT * FROM " . static::$table_name;
		return self::query($query);	
	}

	public function example_query() {
		$query = 'SELECT * FROM instances';
		return self::query($query);
	}

}

class ResultSet {
	
	private $result;
	public $length; 

	public function __construct($result) {
		$this->result = $result;	
		$this->length = mysql_num_rows($result);
	}

	public function to_table() {

	}

	public function to_json() {
		$result_array = array();
		while ($row = mysql_fetch_assoc($this->result)) {
			$result_array[] = $row;
		}
		echo json_encode($result_array);
	}

}

class Image  extends Model {
	public static $table_name = 'instances';	
	
	public static function get_all_images() {
		return self::get_all();
	}
}

//$model = new Model();
//$results = Image::get_all();
//$results->to_json();
