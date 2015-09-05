<?php
error_reporting(0);
require_once("inc/dbconnect.php");
require_once("inc/functions.php");
$p = '/^[\w-]+(\.[\w-]+)*@[a-z0-9-]+'
.'(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i';/* check if email is valid or not*/
$letter = "/^[A-Za-z ]+$/";
$fname = cleanthis($_POST['fname']);$mname = cleanthis($_POST['mname']);$lname = cleanthis($_POST['lname']);
$address = cleanthis($_POST['address']);$sID = cleanthis($_POST['sID']);$contact = cleanthis($_POST['contact']);
$email = cleanthis($_POST['company_email']);
$dob = cleanthis($_POST['dob']);$sem = cleanthis($_POST['sem']);
$sql = "select * from student where sID = '$sID'";
$res = mysql_query($sql, $mysqldb);
$result = "";
	if(isblank($fname) or isblank($mname) or isblank($lname) or isblank($address) or isblank($sID) or isblank($contact) or isblank($dob) or isblank($sem)){
		$result = "Student Details field are all required!";
	}else if(mysql_num_rows($res)){
		$result = "This student ID is already exist!";
	}else if(!preg_match($letter, $fname)){
	$result = "First name field contain only alphabetic value";
	}else if(!preg_match($letter, $mname)){
	$result = "Middle name field contain only alphabetic value";
	}else if(!preg_match($letter, $lname)){
	$result = "Last name field contain only alphabetic value";
	}else if(!isblank($email)){
			if(!preg_match($p, $email)){
			$result = "Please provide a valid email address for Work details";
			}
	}else{
	$result = "\0";
	}

echo $result;
