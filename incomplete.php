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
            
   <h2><?=$course['clabel']; ?> ON-THE-JOB Training <?=$set['year']; ?></h2>
            <h3>Students with Incomplete Requirements</h3>
   <table width="700" style="border-collapse: collapse; border-color: rgb(0, 0, 0);" border="1">
   <thead >
    <tr style="border:1px solid #618fb0; font-size:9px;" >
    <th>No.</th>
    <th>Names</th>
    <th>Submit the ff:</th>
    </tr>
   </thead>
               <tbody >
      <?php
      $x=1;
      $result = mysql_query("select *,concat(`lname`,', ',`fname`,' ',`mname`) as `name` from student where `course_id` = '{$course['course_id']}' and `sy` = '{$set['year']}' order by `gender`,`lname` ") or die(mysql_error());
   
      while($row=mysql_fetch_array($result)):
      if(!checkiSubmit($row['student_id'],$department_id,1) || !checkiSubmit($row['student_id'],$department_id,0)):
        $charr=[];
        $check = mysql_query("select * from `checklist` where `department_id`='$department_id'") or die(mysql_error());
        while($row2=mysql_fetch_array($check)):
          if(check($row['student_id'],$row2['checklist_id'])==="&times;"):
            $charr[]=getReqDataX($row2['checklist_id']);
          endif;
        endwhile;
     ?>
  <tr style="border:1px solid #618fb0; font-size:9px;"><td><?=$x; ?>.</td><td><?=$row['name']; ?></td>
       <td><?php echo implode(', ', $charr); ?></td>        
               </tr>
    <?php
     $x++;
       endif;
    
      ?>
      
      <?php
     
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