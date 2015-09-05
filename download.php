<?php
if(isset($_GET['file'])):
$file = $_GET['file'];
	


header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=\"".basename($file)."\";" );  
readfile("$file");	// this line of code does the reading and interpreting 
exit();				//terminates execution of the code in the program
endif;
header("location:./");
?>