<?php
session_start();
require_once("inc/dbconnect.php");
require_once("inc/functions.php");
logged(2);
$id = $_SESSION['coordinator'];
$me = getPersonData($id,1);
$course = $_SESSION['course'];
$dept = getDepartment($me['department_id']);
$department_id = $dept['department_id'];
?>
<!DOCTYPE html>
<html>
<head>
   
<style type="text/css">
<!--
-->
table{
	color:#000000;
	border-top-color: #333333;
	border-right-color: #333333;
	border-bottom-color: #333333;
	border-left-color: #333333;
	background-color: #FFFFFF;
}
.style2 {color: #000000}
</style>
</head>
<body>

<center>
 

    <div class="content container-fluid">
        <div class="row-fluid">
            <div class="span12">

            <?php 
            switch($dept['label']){
            	case 'CESD':
            	?>
            	<img src="img/cesd.jpg" />
            	<?php
            	break;
            	case 'TED':
            	?>
            	<img src="img/ted.jpg" />
            	<?php
            	break;
            	case 'TEdD':
            	?>
            	<img src="img/tedd.jpg" />
            	<?php
            	break;
            	case 'NHSD':
            	?>
            	<img src="img/nhsd.jpg" />
            	<?php
            	break;
            	
            }
            ?>
            <?php
			$tempsql = "select * from workdata where department_id = '$department_id' and name = 'end'";
			$temprow = mysql_query($tempsql,$mysqldb);
			$tempres = mysql_fetch_assoc($temprow);
			$last = $tempres['workdata_id'];
			$start_date = $last - 1;
			$contact_num = $start_date - 2;
			$company_title = $contact_num - 3;
			?>
			<h3><?=$course['clabel']; ?> OJT/Internship/Practicum <?=$set['year']; ?></h3>
			<table width="700" bordercolor="#000000" style="border-collapse: collapse; color:#000000;" border="1">
			<thead>
				<tr style="border:1px solid #618fb0;">
				<th>No.</th>
				<th>Names</th>
				<th>Company</th>
				<th>Contact No.</th>
				<th>Start Date</th>
				<th>End Date</th>
				</tr>
			</thead>
               <tbody style="font-size:12px">
			   <?php
			   $x=1;
			   $result = mysql_query("select *,concat(`lname`,', ',`fname`,' ',`mname`) as `name` from student where `course_id` = '{$course['course_id']}' and `sy` = '{$set['year']}' order by `gender`,`lname` ") or die(mysql_error());
			   while($row=mysql_fetch_array($result)):
			   extract($row);
			   ?>
			   
			   <?php
			   ?>
			   <tr style="border:1px solid #618fb0;"><td><?=$x; ?>.</td><td><?=$name; ?></td><td><?=getWorkData($student_id,$company_title); ?></td><td><?=getWorkData($student_id,$contact_num); ?></td><td><?=getWorkData($student_id,$start_date); ?></td><td><?=getWorkData($student_id,$last); ?></td></tr>
			   <?php
				if(($x%16) == 0){
			   ?>
			   </tbody>
			<table width="700" bordercolor="#000000" style="border-collapse: collapse;border-color:#000000" border="1"><br/>
			<h4 align="left">Prepared By:</h4><h3 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$me['name'];?></h3>
			<?php 
            switch($dept['label']){
            	case 'CESD':
            	?>
            	<img src="img/cesd.jpg" />
            	<?php
            	break;
            	case 'TED':
            	?>
            	<img src="img/ted.jpg" />
            	<?php
            	break;
            	case 'TEdD':
            	?>
            	<img src="img/tedd.jpg" />
            	<?php
            	break;
            	case 'NHSD':
            	?>
            	<img src="img/nhsd.jpg" />
            	<?php
            	break;
            	
            }
            ?>
			<h3><?=$course['clabel']; ?> OJT/Internship/Practicum <?=$set['year']; ?></h3>
			<thead>
				<tr style="border:1px solid #618fb0;">
				<th><span class="style2">No.</span></th>
				<th ><span class="style2">Names</span></th>
				<th><span class="style2">Company</span></th>
				<th><span class="style2">Contact No.</span></th>
				<th><span class="style2">Start Date</span></th>
				<th><span class="style2">End Date</span></th>
			  </tr>
			</thead>
				<tbody style="font-size:12px">
			   <?php
			   }
			   $x++;
				endwhile;
			   ?>
			   </tbody>
			</table>
<br/>
			<h4 align="left">Prepared By:</h4><h3 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$me['name'];?></h3>
</div>
        </div>
        
    </div>

<!-- modals -->
						
<!-- jquery and friends -->
<script src="lib/jquery/jquery.1.9.0.min.js"> </script>
<script src="lib/jquery/jquery-migrate-1.1.0.min.js"> </script>

<!-- jquery plugins -->
<script src="lib/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="lib/parsley/parsley.js"> </script>
<script src="lib/uniform/js/jquery.uniform.js"></script>
<script src="lib/select2.js"></script>
<script src="lib/jquery.dataTables.min.js"></script>

<!--backbone and friends -->
<script src="lib/backbone/underscore-min.js"></script>
<script src="lib/backbone/backbone-min.js"></script>
<script src="lib/backbone/backbone-pageable.js"></script>
<script src="lib/backgrid/backgrid.js"></script>
<script src="lib/backgrid/backgrid-paginator.js"></script>
<script src="lib/bootstrap-datepicker.js"></script>
<script src="lib/bootstrap-select/bootstrap-select.js"></script>
<!-- bootstrap default plugins -->
<script src="js/bootstrap/bootstrap-transition.js"></script>
<script src="js/bootstrap/bootstrap-collapse.js"></script>
<script src="js/bootstrap/bootstrap-alert.js"></script>
<script src="js/bootstrap/bootstrap-tooltip.js"></script>
<script src="js/bootstrap/bootstrap-popover.js"></script>
<script src="js/bootstrap/bootstrap-button.js"></script>
<script src="js/bootstrap/bootstrap-dropdown.js"></script>
<script src="js/bootstrap/bootstrap-modal.js"></script>
<script src="js/bootstrap/bootstrap-tab.js"> </script>

<!-- basic application js-->
<script src="js/app.js"></script>
<script src="js/settings.js"></script>

<!-- page-specific js -->
<script src="js/tables-dynamic.js"></script>
<script>
$(document).ready(function(){

});
</script>

</body>
</html>