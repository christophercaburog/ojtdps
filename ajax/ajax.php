
<?php
require_once("../inc/dbconnect.php");
require_once("../inc/functions.php");
session_start();
$id = $_SESSION['coordinator'];
$me = getPersonData($id,1);
$course = $_SESSION['course'];
$dept = getDepartment($me['department_id']);
$department_id = $me['department_id'];
extract($_REQUEST);
$return_arr = array();

if(isset($_GET['getInitialDocs'])):
	?>
	
<script>
    $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
</script>
	<table class="table table-bordered table-condensed table-hover">
                          
                            <tbody>
							<?php
							$student_id = (int)$student_id;
							$result = mysql_query("select * from checklist where `type` = 1 and `department_id`='$department_id'") or die(mysql_error());
							while($row=mysql_fetch_array($result)):
							extract($row);
							$dir = getStudent($student_id,$_SESSION['course']['course_id']);
							$file = isubmitted($student_id,$checklist_id);
							if($file):
							?>
							 <tr>
                               
                                <td><?=$name; ?></td>
                                <td><i class="icon-check icon64"></i></td>
                              
                            </tr>
							<?php
							else:
							?>
							 <tr>
                                
                                 <td>
							<label for="<?=$checklist_id; ?>"><?=$name; ?></label> </td>
                               <td> <input type="checkbox" name="checklist[]" id="<?=$checklist_id; ?>" value="<?=$checklist_id; ?>" /></i></td>
                              
                            </tr>
							<?php
							endif;
							?>
							 
							<?php
							endwhile
							?>
							<input type="hidden" name="student_id" value="<?=$student_id; ?>" />
							
                           
                            
                            </tbody>
                        </table>
	<?php	
endif;



if(isset($_GET['getInitialDocsX'])):
	?>
<script>
	
    $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
</script>
	<table class="table table-bordered table-condensed table-hover">
                          
                            <tbody>
							<?php
							$student_id = (int)$student_id;
							$result = mysql_query("select * from checklist where `type` = 1") or die(mysql_error());
							while($row=mysql_fetch_array($result)):
							extract($row);
							$dir = getStudent($student_id,$_SESSION['course']['course_id']);
							$file = submitted($student_id,$checklist_id);
							if($file['file']!=""):
							?>
							 <tr>
                                <td><i class="icon-check icon32"></i></td>
                                <td><a href="#"class="download" data-href="docs/<?="{$_SESSION['course']['clabel']}/{$dir['dir']}/{$file['file']}"; ?>"><?=$name; ?></a></td>
                                <td><span class="badge badge-success" title="<?=$file['date']; ?>" data-rel="tooltip">Submitted</span></td>
                                <td> <span class="btn fileinput-button">
                                        <i class="icon-plus"></i>
                                        <span>Replace <?=$name; ?>.</span>
                                        <input type="file" name="<?=$checklist_id; ?>"  />
                                    </span></td>
                              
                            </tr>
							<?php
							else:
							?>
							<tr>
                                <td><i class="icon-check-empty icon32"></i></td>
                                <td><?=$name; ?></td>
                                <td><span class="badge badge-warning">Unsubmitted</span></td>
                                <td><span class="btn fileinput-button">
                                        <i class="icon-plus"></i>
                                        <span>Submit <?=$name; ?>.</span>
                                        <input type="file" name="<?=$checklist_id; ?>"  />
                                    </span></td>
                              
                            </tr>
							<?php
							endif;
							?>
							 
							<?php
							endwhile
							?>
							<input type="hidden" name="student_id" value="<?=$student_id; ?>" />
							
                           
                            
                            </tbody>
                        </table>
	<?php	
endif;
if(isset($_GET['getFinalDocs'])):
	?>
<script>
	
    $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
</script>
	<table class="table table-bordered table-condensed table-hover">
                          
                            <tbody>
							<?php
							$student_id = (int)$student_id;
							$result = mysql_query("select * from checklist where `type` = 0 and `department_id`='$department_id'") or die(mysql_error());
							while($row=mysql_fetch_array($result)):
							extract($row);
							$dir = getStudent($student_id,$_SESSION['course']['course_id']);
							$file = isubmitted($student_id,$checklist_id);
							if($file):
							?>
							 <tr>
                               
                                <td><?=$name; ?></td>
                                <td><i class="icon-check icon64"></i></td>
                              
                            </tr>
							<?php
							else:
							?>
							 <tr>
                                
                                 <td>
							<label for="<?=$checklist_id; ?>"><?=$name; ?></label> </td>
                               <td> <input type="checkbox" name="checklist[]" id="<?=$checklist_id; ?>" value="<?=$checklist_id; ?>" /></i></td>
                              
                            </tr>
							<?php
							endif;
							?>
							 
							<?php
							endwhile
							?>
							<input type="hidden" name="student_id" value="<?=$student_id; ?>" />
							
                           
                            
                            </tbody>
                        </table>
	<?php	
endif;

if(isset($_GET['getFinalDocsX'])):
	?>
<script>
	
    $('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
</script>
	<table class="table table-bordered table-condensed table-hover">
                          
                            <tbody>
							<?php
							$student_id = (int)$student_id;
							$result = mysql_query("select * from checklist where `type` = 0") or die(mysql_error());
							while($row=mysql_fetch_array($result)):
							extract($row);
							$dir = getStudent($student_id,$_SESSION['course']['course_id']);
							$file = submitted($student_id,$checklist_id);
							if($file['file']!=""):
							?>
							 <tr>
                                <td><i class="icon-check icon32"></i></td>
                                <td><a href="#"class="download" data-href="docs/<?="{$_SESSION['course']['clabel']}/{$dir['dir']}/{$file['file']}"; ?>"><?=$name; ?></a></td>
                                <td><span class="badge badge-success">Submitted</span></td>
                                <td> <span class="btn fileinput-button">
                                        <i class="icon-plus"></i>
                                        <span>Replace <?=$name; ?>.</span>
                                        <input type="file" name="<?=$checklist_id; ?>"  />
                                    </span></td>
                              
                            </tr>
							<?php
							else:
							?>
							<tr>
                                <td><i class="icon-check-empty icon32"></i></td>
                                <td><?=$name; ?></td>
                                <td><span class="badge badge-warning">Unsubmitted</span></td>
                                <td><span class="btn fileinput-button">
                                        <i class="icon-plus"></i>
                                        <span>Submit <?=$name; ?>.</span>
                                        <input type="file" name="<?=$checklist_id; ?>"  />
                                    </span></td>
                              
                            </tr>
							<?php
							endif;
							?>
							 
							<?php
							endwhile
							?>
							<input type="hidden" name="student_id" value="<?=$student_id; ?>" />
							
                           
                            
                            </tbody>
                        </table>
	<?php	
endif;

if(isset($_GET['getWorkInfo'])):
$result = mysql_query("select * from workdata where `department_id` = '$department_id' ") or die(mysql_error());
if(isset($_GET['s'])):
	$a = [];
	while($row=mysql_fetch_assoc($result)):
		$workdata_id = $row['workdata_id'];
		$a[$row['name']]=getWorkData($student_id,$workdata_id); 
	endwhile;
	$a['student_id']=$student_id;
echo json_encode($a);
else:
?>
<table class="table table-bordered table-condensed table-hover table-striped">
<tbody>
<?php

	$x=1;
	while($row=mysql_fetch_assoc($result)):
		$workdata_id = $row['workdata_id'];
		?>
		<tr><td width="40%"><?=$row['label'];?>:</td><td><?=getWorkData($student_id,$workdata_id); ?></td></tr>
		<?php
		$x++;
	endwhile;
?>

</tbody>
</table>
<?php
endif;
endif;

if(isset($_GET['getStudentInfo'])):
$course = $_SESSION['course'];
$student = getStudent($student_id,$course['course_id']);
if(isset($_GET['s'])):
?>
<script>
$('#dob').datepicker();
$("#contact").mask("+999-999-999-999");
$("#sID").mask("-99-9999");
</script>
<input type="hidden" name="student_id" value="<?=$student_id; ?>" />
<table class="table table-bordered table-condensed table-hover table-striped">
<tbody>
<tr><td width="40%">Student number:</td><td><input type="text" name="sID" value="<?=$student['sID']; ?>" id="sID" class="span3"/></td></tr>
<tr><td width="40%">First Name:</td><td><input type="text" name="fname" value="<?=$student['fname']; ?>" id="fname" class="span3"/></td></tr>
<tr><td>Middle Name:</td><td><input type="text" name="mname" value="<?=$student['mname']; ?>" id="mname" class="span3"/></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="lname" value="<?=$student['lname']; ?>" id="lname" class="span3"/></td></tr>
<tr><td>Gender:</td><td>
<select name="gender" id="gender" class="span3">
<option value="1" <?=($student['gender']==1)?"selected":""; ?> >Male</option>
<option value="0" <?=($student['gender']==0)?"selected":""; ?> >Female</option>
</select>
</td></tr>
<tr><td>Address:</td><td><input type="text" name="address" value="<?=$student['address']; ?>" id="address" class="span3"/></td></tr>
<tr><td>Contact #:</td><td><input type="text" name="contact" value="<?=$student['contact']; ?>" id="contact" class="span3"/></td></tr>
<tr><td>Date of Birth #:</td><td><input type="text" name="dob" value="<?=$student['dob']; ?>" id="dob" class="span3"/></td></tr>
<tr><td>Course:</td><td><input class="span3" type="text" name="course" value="<?=$course['clabel']; ?> <?=$student['year']; ?> <?=$student['block']; ?>" disabled /></td></tr>
<tr><td>Year:</td><td>
 <select name="year" id="year" required>
    <option value="2" <?=($student['year']==2)?"selected":""; ?> >2</option>
<option value="3" <?=($student['year']==3)?"selected":""; ?> >3</option>
<option value="4" <?=($student['year']==4)?"selected":""; ?> >4</option>
                                    </select>
</td></tr>
<tr><td>Block:</td><td>
  <select  id="block" name="block">
     <option value="A" <?=($student['block']=='A')?"selected":""; ?> >A</option>
<option value="B" <?=($student['block']=='B')?"selected":""; ?> >B</option>
<option value="C" <?=($student['block']=='C')?"selected":""; ?> >C</option>
                                    </select>

</td></tr>
<tr><td>Semester:</td><td>
  <select  id="semi" name="semi">
     <option value="First Sem" <?=($student['sem']=='First Sem')?"selected":""; ?> >First Sem</option>
<option value="Second Sem" <?=($student['sem']=='Second Sem')?"selected":""; ?> >Second Sem</option>
<option value="Summer" <?=($student['sem']=='Summer')?"selected":""; ?> >Summer</option>
<option value="" <?=($student['sem']=='')?"selected":""; ?> ></option>
                                    </select>

</td></tr>
</tbody>
</table>


<?php
else:

?>
<table class="table table-bordered table-condensed table-hover table-striped">
<tbody>
<tr><td width="40%">Student Number:</td><td><?=$student['sID']; ?></td></tr>
<tr><td width="40%">First Name:</td><td><?=$student['fname']; ?></td></tr>
<tr><td>Middle Name:</td><td><?=$student['mname']; ?></td></tr>
<tr><td>Last Name:</td><td><?=$student['lname']; ?></td></tr>
<tr><td>Gender:</td><td><?=gender($student['gender']); ?></td></tr>
<tr><td>Address:</td><td><?=$student['address']; ?></td></tr>
<tr><td>Contact #:</td><td><?=$student['contact']; ?></td></tr>
<tr><td>Date of Birth #:</td><td><?=$student['dob']; ?></td></tr>
<tr><td>Course/Yr/Block:</td><td><?=$course['clabel']; ?> <?=$student['year']; ?> <?=$student['block']; ?></td></tr>
<tr><td>Semester:</td><td> <?=$student['sem']; ?></td></tr>
</tbody>
</table>
<?php
endif;
endif;

if(isset($_GET['getWorkData'])):
	$name = getWorkDataX($workdata_id);
	
	?>
	<tr><td>Name:</td><td><input type="text" name="name" id="name" required value="<?=$name; ?>"/></td></tr>
	<input type="hidden" name="workdata_id" value="<?=$workdata_id; ?>"/>
	<?php
endif;


if(isset($_GET['getReqDetails'])):
	$data = getReqData($checklist_id);
	extract($data);
	?>
	<tr><td>Name:</td><td><input type="text" name="name" id="name" required value="<?=$name; ?>"/></td></tr>

	<tr><td>Type:</td><td>
<select  id="type" name="type" required>  
                                  <option value="1" <?=($type==1)?"selected":""; ?>>Initial Requirement</option>
                                   <option value="0" <?=($type==0)?"selected":""; ?>>Final Requirement
                                    </select>
	</td></tr>
	<input type="hidden" name="checklist_id" value="<?=$checklist_id; ?>"/>
	<?php
endif;
//edit course start
if(isset($_GET['editCourse'])):
	$data = getCourseDataAll($course_id);
	extract($data);
	?>
	<tr><td>Course Label:</td><td><input type="text" name="ccname" id="ccname" required value="<?=$clabel; ?>"/></td></tr>
	<tr><td>Course Description:</td><td><input type="text" name="dcname" id="dcname" required value="<?=$cname; ?>"/></td></tr>
	<tr><td>Department:</td><td>
<select  id="type"  name="depp" required>  
                                  <option value="00001" <?=($department_id==00001)?"selected":""; ?>>CESD</option>
								  <option value="00002" <?=($department_id==00002)?"selected":""; ?>>TED</option>
								  <option value="00003" <?=($department_id==00003)?"selected":""; ?>>TEdD</option>
                                   <option value="00004" <?=($department_id==00004)?"selected":""; ?>>NHSD
                                    </select>
	</td></tr>
	<input type="hidden" name="course_id" value="<?=$course_id; ?>"/>
	<?php
endif;
//edit course end

if(isset($_GET['getCoorDetails'])):
	$data = getPersonData($coordinator_id,1);
	echo json_encode($data);
endif;

if(isset($_GET['setPrint'])):
	$student_id =  explode(",",$data);
	$other = explode(",",$other);
	session_start();
	$_SESSION['print'][]=$student_id;
	$_SESSION['print'][]=$other;
	echo 1;
endif;

if(isset($_GET['getCourses'])):
?>
<option value="" >Select Course</option>
<?php
	 $result = mysql_query("select * from `course` where `course_id` not in(select `course_id` from `coordinator` ) and `department_id` = '$department_id' ") or die(mysql_error());
								 while($row=mysql_fetch_array($result)):
								 extract($row);
								 ?>
                                        <option value="<?=$course_id; ?>" ><?=$clabel; ?></option>
                                  <?php
									endwhile;
endif;



if(isset($_GET['search'])):
	$result = mysql_query("SELECT *, concat(lname ,' ',fname,' ',mname) as name FROM student where lname like '%" . sanitize($term) . "%'");
	while ($row = mysql_fetch_array($result)):
	echo $row['name'];
	endwhile;
endif;

if(isset($_GET['download'])):
	$result = mysql_query("select * from downloads where `did` = '$id' ");
	$row = mysql_fetch_array($result);
	echo json_encode(array("name"=>$row['docname'],"description"=>$row['description']));
endif;

if(isset($_GET['getSubjectData'])):
	$result = mysql_query("select * from course_subject where cid='$cid' and subjid not in(select subjid from `grades` where `sid`='$sid')");
	?>
	<option value="">Select Subject</option>
	<?php
	while($row=mysql_fetch_array($result)):
		$subject = getSubjectData($row['subjid']);
		?>
		<option value="<?php echo $row['subjid']; ?>"><?php echo $subject['code']; ?> - <?php echo $subject['title']; ?></option>
		<?php
	endwhile;
endif;

if(isset($_GET['viewGrades'])):
	$result = mysql_query("select * from grades where `sid` = '$sid' and `sem` = '$sem' and `ay`='$ay' ");
	$num = mysql_num_rows($result);
	if($num):
		?>
		<table border="1"  align="center" cellpadding="5" cellspacing="5">
		<tr><td>Course Code</td><td>Course Title</td><td>Units</td><td>Midterm</td><td>Tentative Final</td><td>Final</td><td>Remarks</td></tr>
		<?php
		while($row = mysql_fetch_array($result)):
		$subject = getSubjectData($row['subjid']);
		?>
		<tr><td><?php echo $subject['code']; ?></td><td><?php echo $subject['title']; ?></td><td><?php $subject['units']; ?></td><td><?php echo $row['midterm']; ?></td><td><?php echo $row['tfinal']; ?></td><td><?php echo $row['final']; ?></td><td><?php echo getRemarks($row['final']); ?></td></tr>
		<?php
		endwhile;
		?>
		</table>
		<?php
	else:
		?>
		<center><h1>No Data Found!</h1>
		<?php
	endif;
	
endif;


if(isset($_GET['addGrade'])):
	foreach($_POST as $key=>$value):
			$_POST[$key]=sanitize($value);
		endforeach;
	$sql ="INSERT INTO `grades` VALUES (NULL, '$sid', '$subjid', '$sem', '$ay', '$midterm', '$tfinal', '$final','$prof');";
		$result = mysql_query($sql) or die(mysql_error());
		echo 1;
endif;

if(isset($_GET['deleteResource'])):
	$sql ="delete from resource where rid = '$rid' ";
		$result = mysql_query($sql) or die(mysql_error());
		echo 1;
endif;

if(isset($_GET['deleteCourse'])):
	$sql ="delete from course where cid = '$cid' ";
		$result = mysql_query($sql) or die(mysql_error());
		echo 1;
endif;

if(isset($_GET['getCourse'])):
	$sql ="select * from course where cid = '$cid' ";
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_array($result);
		echo json_encode(array('cname'=>$row['cname'],'clabel'=>$row['clabel']));

endif;



if(isset($_GET['removeLog'])):
	$sql ="DELETE from `log` where `log_id` = '$log_id'  limit 1";
		$result = mysql_query($sql) or die(mysql_error());
		echo 1;
endif;


if(isset($_GET['deleteStudent'])):
	$sql ="delete from student where sid = '$sid' ";
		$result = mysql_query($sql) or die(mysql_error());
		echo 1;
endif;


if(isset($_GET['getDetails'])):
	echo $sid;
endif;


if(isset($_GET['getFile'])):
	$file = getFile($did);
	$download =  "<a href='../download.php?file=".$file."'>".$file."</a>";
	$result = mysql_query("select * from downloads where `did` = '$did' ") or die(mysql_error());
	$row = mysql_fetch_array($result);
	echo json_encode(array('docname'=>$row['docname'],'description'=>$row['description'],'attachment'=>$row['attachment'],'download'=>$download));
endif;
?>
