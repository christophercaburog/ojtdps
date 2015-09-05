<?php
require_once("inc/dbconnect.php");
require_once("inc/functions.php");
$cname = cleanthis($_POST['cname']);
$name = cleanthis($_POST['dname']);
$department_id = cleanthis($_POST['department_id']);
$result = "";
if(!isset($department_id)){
	$result = "Please select department";
}else{
	$result = "\0";
}
echo $result;
?>
