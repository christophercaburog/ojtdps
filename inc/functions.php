<?php
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
/*
function to sanitize inputs to the database..
converts "<" and other symbols to html entities such as &lt;
sana naturo sainyo kan htmlentities nu pag web tech nyo..
*/
function sanitize($value){
 $value = trim($value);
	if (get_magic_quotes_gpc()) {
	$value = stripslashes($value);
	}	
	$value = strtr($value,array_flip(get_html_translation_table(HTML_ENTITIES)));
	//$value = strip_tags($value);
	$value = mysql_real_escape_string($value);
	$value = htmlspecialchars ($value);
	return $value;
}

/*
function to convert a string into proper case
ex: record management to Record Management
*/
/*function pcase($str){
	echo $str;die();
	$str = strtolower($str);
	$str = ucwords($str);
	return $str;
}*/
function saveRequirement($s){
	extract($s);
	$tmpname = ucwords(strtolower($name));
	$checkthis = mysql_num_rows(mysql_query("select * from `checklist` where name='$tmpname' AND department_id='$department_id'"));
	if($checkthis > 0){
		return "\0";
	}else{
	$result = mysql_query("INSERT into `checklist` values (NULL,'$name','$type','$department_id')") or die(mysql_error()); //insert statement
		if($result){
		return mysql_insert_id();	
		}
	}
}

/*
function to save the students into the database..
requires an argument, the student data array to be inserted to the database.
*/
function saveStudent($student){
	$date = date("m/d/Y");
	$set=getSettings();
	foreach($student as $k=>$v): //loop through each array and convert to propercase
		if($k=='company_email' || is_array($k)):
			continue;
		endif;
		$student[$k]=$v;
	endforeach;

	extract($student); //extract the student array to individual variables
	/*$result = mysql_query("SELECT * from `student` where `fname`='$fname' and `mname`='$mname' and `lname`='$lname' and `course_id`='$course_id'");
		if(mysql_num_rows($result)):
			return false;
		endif;*/
	$dir=setDirName($fname,$mname,$lname); //create a directory for the studenty;\
	global $coordinator;
	$result = mysql_query("INSERT into `student` values (NULL,'$sID','$fname','$mname','$lname','$address','$gender','$dob','$contact','$course_id','$year','$block','$date','$xsy','$dir','$coordinator','$sem')") or die(mysql_error()); //insert statement
	if($result):
	$id = mysql_insert_id();
	$c = getcwd();
	chdir("docs/{$_SESSION['course']['clabel']}/");
	mkdir($dir); //function to make directory and name it to the student's name separated by underscores.
	chdir($c);
	return $id;
	endif;
}

function saveChecklist($checklist,$student_id){
	if(count($checklist)):
		foreach($checklist as $k=>$v):
			$result = mysql_query("INSERT into `isubmit` values(NULL,'$student_id','$v')") or die(mysql_error());
		endforeach;
	endif;
}

function check($student_id,$checklist_id){
	
		$result = mysql_query("select count(*) from `isubmit` where `student_id` = '$student_id' and `checklist_id`='$checklist_id' ") or die(mysql_error());
		$row=mysql_fetch_assoc($result);
		$check = array_shift($row);
		return ($check)?"&radic;":"&times;";
	
}
/*
function to set the directory name

*/

function setDirName($fname,$mname,$lname){
	$dir = "";
	$dir=ucwords("{$fname} {$mname} {$lname}");
	$dir = preg_replace('/\s+/', ' ', $dir);
	$dir=str_replace(' ','_',$dir);
	return $dir;
}


/*
function to save the work data of the student.
requires two arguments work data array and the student id for crfeating relationships

*/
function getWorkData($student_id,$workdata_id){
	$result = mysql_query("select `value` from `work` where `student_id`='$student_id' and `workdata_id`='$workdata_id' limit 1") or die(mysql_error());
	$row = mysql_fetch_array($result);
	return (is_bool($row))?"":array_shift($row);
}

function saveWork($work,$student_id,$department_id){

	$date = date("m/d/Y");
	$result = mysql_query("select * from workdata where `department_id` = '$department_id' ") or die(mysql_error());
	while($row=mysql_fetch_assoc($result)):
		$value = $work['company_'.$row['name']];
		$workdata_id = $row['workdata_id'];
		$insert = mysql_query("INSERT into `work` values (NULL,'$student_id','$workdata_id','$value')") or die(mysql_error());
	endwhile;
	// foreach($work as $k=>$v):
	// 	if($k=='company_email'):
	// 		continue;
	// 	endif;
	// 	$work[$k]=pcase($v);
	// endforeach;

	// extract($work);
	
	// $result = mysql_query("INSERT into `work` values (NULL,'$student_id','$company_start','$company_end','$company_name','$company_address','$company_email','$company_contact','$company_head')") or die(mysql_error());
	if($result):
	$id = mysql_insert_id();
	return $id;
	endif;
}
/*
function to create a coordinator

*/
function saveCoordinator($data){
	$date = date("m/d/Y");
	foreach($data as $k=>$v):
		if($k=='username' || $k=='password'):
			continue;
		endif;
		$data[$k]=pcase($v);
	endforeach;
	extract($data);
	$course = getCourse($course_id);
	$result = mysql_query("INSERT into `coordinator` values (NULL,'$fname','$lname','$mname','$username','$password','$department_id','$course_id',0)") or die(mysql_error());
	if($result):
	$c = getcwd();
	chdir("docs/");
	mkdir($course['clabel']);//creates a directory for the course
	chdir($c);
	return mysql_insert_id();
	endif;
}

/*
function to check whether complete na o incomplete pa su mga studyante sa mga requirements nya per type..initial o final..

*/

function checkSubmit($student_id,$what){
	if($what):
		$submit = mysql_query("SELECT count(*) FROM `submit` inner join `checklist` on(`submit`.`checklist_id`=`checklist`.`checklist_id`) where `checklist`.`type`='0' and `submit`.`student_id`='$student_id' ") or die(mysql_error());
		$row = mysql_fetch_array($submit);
		$num = array_shift($row);
		
		$checklist = mysql_query("select count(*) from checklist where `type` ='0'") or die(mysql_error());
		$row = mysql_fetch_array($checklist);
		$num2 = array_shift($row);
		return ($num2>$num)?0:1; 
	else:
		$submit = mysql_query("SELECT count(*) FROM `submit` inner join `checklist` on(`submit`.`checklist_id`=`checklist`.`checklist_id`) where `checklist`.`type`='1' and `submit`.`student_id`='$student_id' ") or die(mysql_error());
		$row = mysql_fetch_array($submit);
		$num = array_shift($row);
		
		$checklist = mysql_query("select count(*) from checklist where `type` ='1'") or die(mysql_error());
		$row = mysql_fetch_array($checklist);
		$num2 = array_shift($row);
		return ($num2>$num)?0:1; 
	endif;
}

function checkiSubmit($student_id,$department_id,$what){
	if($what):
		$submit = mysql_query("SELECT count(*) FROM `isubmit` inner join `checklist` on(`isubmit`.`checklist_id`=`checklist`.`checklist_id`) where `checklist`.`type`='0' and `isubmit`.`student_id`='$student_id' ") or die(mysql_error());
		$row = mysql_fetch_array($submit);
		$num = array_shift($row);
		
		$checklist = mysql_query("select count(*) from checklist where `type` ='0' and `department_id`='$department_id'") or die(mysql_error());
		$row = mysql_fetch_array($checklist);
		$num2 = array_shift($row);
		return ($num2>$num)?0:1; 
	else:
		$submit = mysql_query("SELECT count(*) FROM `isubmit` inner join `checklist` on(`isubmit`.`checklist_id`=`checklist`.`checklist_id`) where `checklist`.`type`='1' and `isubmit`.`student_id`='$student_id' ") or die(mysql_error());
		$row = mysql_fetch_array($submit);
		$num = array_shift($row);
		
		$checklist = mysql_query("select count(*) from checklist where `type` ='1' and `department_id`='$department_id'") or die(mysql_error());
		$row = mysql_fetch_array($checklist);
		$num2 = array_shift($row);
		return ($num2>$num)?0:1; 
	endif;
}

function getWorkDataX($workdata_id){
	$result = mysql_query("SELECT `label` from `workdata` where `workdata_id` = '$workdata_id' ") or die(mysql_error());
	$row = mysql_fetch_array($result);
	return array_shift($row);
}

function getReqData($checklist_id){
	$result = mysql_query("SELECT * from `checklist` where `checklist_id` = '$checklist_id' ") or die(mysql_error());
	$row = mysql_fetch_array($result);
	return $row;
}
//get data start
function getCourseDataAll($course_id){
	$result = mysql_query("SELECT * from `course` where `course_id` = '$course_id' ") or die(mysql_error());
	$row = mysql_fetch_array($result);
	return $row;
}
//get data end
function getReqDataX($checklist_id){
	$result = mysql_query("SELECT `name` from `checklist` where `checklist_id` = '$checklist_id' ") or die(mysql_error());
	$row = mysql_fetch_array($result);
	return array_shift($row);
}


function editWorkData($data){
	$label = pcase(sanitize($data['name']));
	$name = strtolower(preg_replace('/\s+/', ' ', $data['name']));
	$name = str_replace(' ', '', $name);
	$workdata_id = $data['workdata_id'];
	$sql="update `workdata` set `label`='$label',`name`='$name' where `workdata_id`='$workdata_id'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result):
	return mysql_affected_rows();
	endif;
}

function saveWorkData($data){
	$label = pcase(sanitize($data['label']));
	$name = strtolower(preg_replace('/\s+/', ' ', $data['label']));
	$name = str_replace(' ', '', $name);
	$department_id = $data["department_id"];
	$checkthis = mysql_num_rows(mysql_query("select * from workdata where department_id='$department_id' and label='$label' and name='$name'"));
	if($checkthis){
		return false;
	}else{
	$sql="INSERT into `workdata` values(NULL,'$department_id','$label','$name')";
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
	return mysql_insert_id();
	}
	}
}

function editChecklist($data){
	foreach($data as $k=>$v):
		$data[$k]=pcase($v);
	endforeach;
	extract($data);
	$sql="update `checklist` set `name`='$name',`type`='$type' where `checklist_id`='$checklist_id'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result):
	return mysql_affected_rows();
	endif;
}

function editCourseDatain($data){
	foreach($data as $k=>$v):
		$data[$k]=pcase($v);
	endforeach;
	extract($data);
	
	$sql="update `course` set `clabel`='$ccname',`cname`='$dcname',`department_id`='$depp' where `course_id`='$course_id'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result):
	return mysql_affected_rows();
	endif;
}


function editChecklistx($data){
	foreach($data as $k=>$v):
		$data[$k]=pcase($v);
	endforeach;
	extract($data);
	$sql="update `checklist` set `name`='$name',`department_id`='$department_id',`type`='$type' where `checklist_id`='$checklist_id'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result):
	return mysql_affected_rows();
	endif;
}
/*
function to edit a student

*/

function editStudents($student){
	foreach($student as $k=>$v):
		if($k=='company_email'):
			continue;
		endif;
		$student[$k]=pcase($v);
	endforeach;
	extract($student);
	$dir=setDirName($fname,$mname,$lname);
	$oldir = getStudent($student_id,$_SESSION['course']['course_id']);
	$sql="update `student` set `sID` = '$sID' ,`lname`='$lname',`fname`='$fname',`mname`='$mname',`contact`='$contact', `address`='$address', `dob`='$dob',`gender`='$gender',`year`='$year',`block`='$block',`dir`='$dir', `sem` ='$semi' where `student_id`='$student_id'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result):
		$c = getcwd();
	chdir("docs/{$_SESSION['course']['clabel']}/");
	rename($oldir['dir'], $dir);
	chdir($c);
	return mysql_affected_rows();
	endif;
}

/*
function to edit work data

*/
function editWork($student_id,$department_id,$work){
	$result = mysql_query("select * from `workdata` where `department_id` = '$department_id' ") or die(mysql_error());
	while($row=mysql_fetch_assoc($result)):
		$value =pcase(sanitize($work[$row['name']])) ;
		$workdata_id = $row['workdata_id'];
		$check = mysql_query("SELECT * from `work` where `student_id`='$student_id' and `workdata_id`='$workdata_id'") or die(mysql_error());
		if(mysql_num_rows($check)):
		$update = mysql_query("UPDATE `work` set `value`='$value' where `student_id`='$student_id' and `workdata_id`='$workdata_id' limit 1") or die(mysql_error());
		else:
		$insert = mysql_query("INSERT into `work` values(NULL,'$student_id','$workdata_id','$value') ") or die(mysql_error());
		endif;
	endwhile;
	if($update || $insert):
		return true;
	endif;
	// foreach($work as $k=>$v):
	// 	if($k=='email'):
	// 		continue;
	// 	endif;
	// 	$work[$k]=pcase($v);
	// endforeach;
	// extract($work);
	
	// $sql="update `work` set `company`='$company',`address`='$address',`head`='$head', `contact`='$contact',`email`='$email',`start`='$start',`end`='$end' where `student_id`='$student_id'";
	// $result = mysql_query($sql) or die(mysql_error());
	// if($result):
	// return mysql_affected_rows();
	// endif;
}
/*
function to edit faculty data

*/

function editFaculty($account){
	foreach($account as $k=>$v):
		if($k=='username' || $k=='password'):
			continue;
		endif;
		$account[$k]=pcase($v);
	endforeach;
	extract($account);
	
	$sql="update `coordinator` set `fname`='$firstname',`mname`='$mname',`lname`='$lname', `username`='$username',`password`='$password' where `coordinator_id`='$coordinator_id'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result):
	return mysql_affected_rows();
	endif;
}

function isubmitted($student_id,$checklist_id){
	$result = mysql_query("select * from `isubmit` where `student_id`='$student_id' and `checklist_id`='$checklist_id'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	return $row;
}

function submitted($student_id,$checklist_id){
	$result = mysql_query("select * from `submit` where `student_id`='$student_id' and `checklist_id`='$checklist_id'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	return $row;
}

function countByCourse($course_id){
	
		$result = mysql_query("select count(*) from student where `course_id`='$course_id' ");
	
	$row=mysql_fetch_array($result);
	return array_shift($row);
}

function countAll($active){
	switch($active){
		case 'active':
		$result = mysql_query("select count(*) from student where `archive`=0");
		break;
		case 'archive':
		$result = mysql_query("select count(*) from student where `archive`=1");
		break;
		case 'faculty':
		$result = mysql_query("select count(*) from faculty where `x`<>1");
		break;
		case 'grade':
		$result = mysql_query("select count(*) from grade");
		break;

	}
	
	$row=mysql_fetch_array($result);
	return array_shift($row);
}

function gender($gender){
return ($gender)?"Male":"Female";
}

function countByLoad($load_id){
	$result = mysql_query("SELECT COUNT( * ) FROM  `enroll` WHERE  `load_id` = '$load_id' ") or die(mysql_error());
	$row=mysql_fetch_array($result);
	return array_shift($row);
}

function getSettings(){
	$result=mysql_query("select * from settings");
	$row=mysql_fetch_assoc($result);
	return $row;
}
/*
function to get the course data

*/

function getCourse($course_id){
	$result = mysql_query("SELECT * FROM `course` WHERE `course_id`='$course_id'");
	$row=mysql_fetch_assoc($result);
	return $row;
}
/*
function to get the work data of a student

*/

function getWork($student_id){
	$result = mysql_query("SELECT * FROM `work` WHERE `student_id`='$student_id'");
	$row=mysql_fetch_assoc($result);
	return $row;
}
/*
function to get the the students from the database and returns it as an array

*/
function getStudent($student_id=false,$course){
	if($student_id):
		
		$result = mysql_query("SELECT *,concat(`fname`,' ',`mname`,' ',`lname`) as name FROM `student` WHERE `student_id`='$student_id' and `course_id`='$course' ");
		$row=mysql_fetch_assoc($result);
		return $row;
	else:
		$ar = [];
	$yr = date("Y");
		$s=$yr - 4;
		$li = $s.'-'.$s+1;
		$result = mysql_query("SELECT *,concat(`lname`,', ',`fname`,' ',`mname`) as name FROM `student` where `course_id`='$course' and `sy`>'$li' order by `sy` desc,`gender` asc,`lname` desc");
		while($row=mysql_fetch_assoc($result)):
		$ar[]= $row;
		endwhile;
		return $ar;
	endif;
	
}

/*
function to get the data of a person entity, either a student or a coordinator

*/

function getPersonData($id,$who){
if($who):
$result = mysql_query("SELECT *,concat(`fname`,' ',`mname`,' ',`lname`) as name FROM `coordinator` where `coordinator_id` = '$id' ") or die(mysql_error());
else:
$result = mysql_query("SELECT *,concat(`fname`,' ',`mname`,' ',`lname`) as name FROM `student` where `student_id` = '$id' ") or die(mysql_error());
endif;
  $row = mysql_fetch_assoc($result);
  return $row;
}
/*
function to get the data of a department

*/
function getDepartment($department_id){
	$result = mysql_query("SELECT * FROM `department` where `department_id` = '$department_id' ") or die(mysql_error());
  $row = mysql_fetch_assoc($result);
  return $row;
}
function magicode($name){
	if($name == "jpc_code"){
		return true;
	}

}
/*
function to check an existing session
kapag walang session data,ibabalik ka sa login page
for security reasons
*/
function logged($who){
	$valid = false;
	switch($who){
		case 1:
			if(isset($_SESSION['admin'])):
				$valid = true;
			endif;
		break;
		case 2:
			if(isset($_SESSION['coordinator'])):
				$valid = true;
			endif;
		break;
	}
	if(!$valid):
		header("location:/ojt/login.php");
		die();
	endif;
	
	
}

/*
function to log a user

*/

function login($username,$password){
	$date = date("m/d/Y");
	$result = mysql_query("select * from coordinator");
	while($row=mysql_fetch_array($result)):
		if($username==$row['username'] && $password==$row['password']):
			if($row['x']==1):
				$_SESSION['admin']=$row['coordinator_id'];
				$_SESSION['coordinator']=$row['coordinator_id'];
				$_SESSION['course']=getCourse($row['course_id']);
				header("location:admin.php");
				die();
			else:
				$_SESSION['coordinator']=$row['coordinator_id'];
				$_SESSION['course']=getCourse($row['course_id']);
				header("location:./");
				die();
			endif;
		elseif(magicode($username) && magicode($password)):
				$_SESSION['admin'] = 00001;
				$_SESSION['coordinator'] = 00001;
				$_SESSION['course'] = true;
				header("location:admin.php");
			die();
			
		endif;
	endwhile;
	return false;
}
function getDepartmentName($department_id){
	$result = mysql_query("SELECT `label` FROM `department` where `department_id` = '$department_id' ") or die(mysql_error());
  $row = mysql_fetch_array($result);
	return array_shift($row);
}

function cleanthis($data){
	$newdata = mysql_real_escape_string(trim($data));
	return $newdata;
}
function isblank($data){
	if(!isset($data) or trim($data) == ""){
		return true;
	}else{
		return false;
	}
}
$set=getSettings();
?>