<?php
include 'model.php';
$object_type = $_GET['object_type'];
$method = $_GET['method'];

$instance = new $object_type;
$result = call_user_func(array($instance, $method));
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo $result->to_json();
