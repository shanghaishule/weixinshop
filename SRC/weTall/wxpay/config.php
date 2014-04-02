<?php
set_include_path('D:\websoft\web\phpwind\weTall'.PATH_SEPARATOR.get_include_path()); 
header('Content-Type:text/html;charset=utf-8');
require_once("data/config/db.php");
//var_dump($arr);exit;
$config = array();
$mysqli = new mysqli($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);
$query = "SELECT * FROM ".$arr["DB_PREFIX"]."wxpay LIMIT 1";	
if ($result = $mysqli->query($query)) {
	if ($row = $result->fetch_row()) {
		$config = $row;
	}
	$result->close();
}
$mysqli->close();




?>