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
	
	private $recource;
	public $length; 
	public $results;

	public function __construct($resource) {
		$this->resource = $resource;	
		$this->length = mysql_num_rows($resource);

		$this->results = array();
		while ($row = mysql_fetch_assoc($this->resource)) {
			$this->results[] = $row;
		}
	}

	public function to_table() {
//echo "<pre>";		var_dump($this->results); echo "</pre>";
		$table_headers = array_keys($this->results[0]);
		echo "<table><thead><tr>";
		foreach ($table_headers as $header)
			echo "<td>{$header}</td>";
		echo "</tr></thead><tbody>";
		foreach ($this->results as $result) {
			echo "<tr>";
			foreach ($result as $value)
				echo "<td>" . (is_null($value) ? "<em>NULL</em>" : $value) .  "</td>";
			echo "</tr>";
		}
		echo "<tbody></table>";
	}

	public function to_json() {
		echo json_encode($this->results);
	}

}

class Image  extends Model {
	public static $table_name = 'instances';	
	
	public static function get_all_images() {
		return self::get_all();
	}
}

class Volume extends Model {
	public static $table_name = 'volumes';
}
//$model = new Model();
$results = Volume::get_all();
$results->to_json();
$results->to_table();
