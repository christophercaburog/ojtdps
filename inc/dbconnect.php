<?php
$dbhost = 'localhost'; // is the standard hostname given to the address of the loopback network interface..meaning ito ang computer na ginagamit nyo..ang host ng mysql nyo eh itong computer na ito mismo
$dbuser = 'root'; //default user ng mysql
$dbpass = '';//wala tayong sinet na password para kay root..ok lang yan..
$dbname = 'ojt';
$mysqldb = mysql_connect($dbhost, $dbuser, $dbpass); //name ng database nyo..pwede nyong palitan databse name nyo sa phpmyadmin,basta baguhin nyo rin dito..
mysql_select_db($dbname,mysql_connect($dbhost, $dbuser, $dbpass)) or die ('Error connecting to mysql');//function to select the database..needs two arguments, the db name and resource data ng mysql connect function.
?>