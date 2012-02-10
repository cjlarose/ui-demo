<?php

abstract class Model {

	const host = 'localhost';
	const user = 'root';
	const pass = '';
	const db = 'atmo_test';
	public static $connection;

	public static function init() {
		self::$connection = new PDO("mysql:host=" . self::host . ";dbname=" . self::db, self::user, self::pass);
	}

	public static function query($query) {
		if (!self::$connection) 
			self::init();
		$result = self::$connection->query($query); 
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
		//$this->length = mysql_num_rows($resource);
		$this->resource->setFetchMode(PDO::FETCH_OBJ);
		$this->results = array();
		while ($row = $resource->fetch()) {
			//$this->results[] = $row;
			$result = new stdClass();
			$i = 0;
			foreach ($row as $key => $value) {
				$meta = $this->resource->getColumnMeta($i);
				//var_dump($meta);
				switch ($meta['native_type']) {
					case "LONG":
						$result->$key = $value * 1;
						break;
					case "DATETIME":
						$result->$key = new DateTime($value);
					default:
						$result->$key = $value;
				}
				$i++;
			}
			$this->results[] = $result;
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
	
	public static function get_unattached() {
		$query =  "SELECT * FROM volumes where instance_id is NULL";
		return self::query($query);
	}
}

//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');
//$results = Instance::get_all_with_volumes();
//$results->to_json();
