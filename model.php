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
		while ($row = mysql_fetch_object($this->resource)) {
			$this->results[] = $row;
		}
	}

	public function to_table() {
//echo "<pre>";		var_dump($this->results); echo "</pre>";
		$table_headers = array_keys(get_object_vars($this->results[0]));
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

class Instance extends Model {
	public static $table_name = 'instances';	
	
	public static function get_all_with_volumes() {
		$instances = self::get_all();
		//$instances->to_json();
		foreach ($instances->results as $instance) {
			$attached_volumes = Volume::get_all_by_parent($instance->id);
			//var_dump($instance);
			$instance->Volume = $attached_volumes->results;
		}
		return $instances;
	}
}

class Volume extends Model {
	public static $table_name = 'volumes';

	public static function get_all_by_parent($instance_id) {
		$query = "SELECT * FROM volumes where instance_id = '{$instance_id}'";
		return self::query($query);
	}
}

$results = Instance::get_all_with_volumes();
$results->to_json();
