<?php
session_start();
require_once("inc/dbconnect.php");
require_once("inc/functions.php");
logged(2);

 //$file = "jquery.min.js";
//$ext = str_replace('.', '', strrchr($file, '.'));
// $ext = pathinfo($file, PATHINFO_EXTENSION);
//echo $ext;
// $dir=ucwords("DFDS SDG");
// $dir = preg_replace('/\s+/', ' ', $dir);
// $dir=str_replace(' ','_',$dir);

//echo $dir;
$id = $_SESSION['coordinator'];
$me = getPersonData($id,1);
$course = $_SESSION['course'];
$dept = getDepartment($me['department_id']);
$department_id = $dept['department_id'];
if(isset($_GET['delete'])):
    $id = $_GET['delete'];
    $result = mysql_query("delete from `student` where `student_id` = '$id' ") or die(mysql_error());
    header("location:./");
endif;

if(isset($_POST['initial'])):
$student_id=$_POST['student_id'];
saveChecklist($_POST['checklist'],$student_id);
// $dir = getStudent($student_id,$_SESSION['course']['course_id']);
// $path = "docs/{$_SESSION['course']['clabel']}/{$dir['dir']}/";
// $c = getcwd();
// $t = time();
// $date = date("m/d/Y");
// 	$result = mysql_query("select * from `checklist` where `type` = 1") or die(mysql_error());
// 	while($row=mysql_fetch_assoc($result)):
// 		if($_FILES[$row['checklist_id']]['name']!==""):
// 			extract($row);
// 			$submit = submitted($student_id,$checklist_id);
// 				if($submit['file']!=""):
// 				chdir($path);
// 				unlink($submit['file']);
// 				chdir($c);
// 				$ext = pathinfo($_FILES[$row['checklist_id']]['name'], PATHINFO_EXTENSION);
// 				$file = $row['name'].".".$ext;	
// 					if(move_uploaded_file($_FILES[$row['checklist_id']]["tmp_name"],$path.$file) ):
// 					$update = mysql_query("update `submit` set `file`='$file',`date`='$date' where `student_id`='$student_id' and `checklist_id`='{$row['checklist_id']}'") or die(mysql_error());
// 					endif;
// 				else:
// 				$ext = pathinfo($_FILES[$row['checklist_id']]['name'], PATHINFO_EXTENSION);
// 				$file = $row['name'].".".$ext;	
// 					if(move_uploaded_file($_FILES[$row['checklist_id']]["tmp_name"],$path.$file) ):
// 					$insert = mysql_query("insert into `submit` values(NULL,'$student_id','{$row['checklist_id']}','$file','$date')") or die(mysql_error());
// 					endif;
// 				endif;
// 		endif;
// 	endwhile;
endif;

if(isset($_GET['delallthis'])):
	$keyin = $_GET['delallthis'];
	$res = mysql_query("delete from student where course_id='$keyin'") or die(mysql_error());
	if($res):
?>
	<script>
		alert("You successfully deleted all the record!");
		window.location = "index.php";
	</script>
<?php
	endif;
endif;

if(isset($_POST['final'])):
$student_id=$_POST['student_id'];
saveChecklist($_POST['checklist'],$student_id);
// $dir = getStudent($student_id,$_SESSION['course']['course_id']);
// $path = "docs/{$_SESSION['course']['clabel']}/{$dir['dir']}/";
// $c = getcwd();
// $t = time();
// $date = date("m/d/Y");
// 	$result = mysql_query("select * from `checklist` where `type` = 0") or die(mysql_error());
// 	while($row=mysql_fetch_assoc($result)):
// 		if($_FILES[$row['checklist_id']]['name']!==""):
// 			extract($row);
// 			$submit = submitted($student_id,$checklist_id);
// 				if($submit['file']!=""):
// 				chdir($path);
// 				unlink($submit['file']);
// 				chdir($c);
// 				$ext = pathinfo($_FILES[$row['checklist_id']]['name'], PATHINFO_EXTENSION);
// 				$file = $row['name'].".".$ext;	
// 					if(move_uploaded_file($_FILES[$row['checklist_id']]["tmp_name"],$path.$file) ):
// 					$update = mysql_query("update `submit` set `file`='$file',`date`='$date' where `student_id`='$student_id' and `checklist_id`='{$row['checklist_id']}'") or die(mysql_error());
// 					endif;
// 				else:
// 				$ext = pathinfo($_FILES[$row['checklist_id']]['name'], PATHINFO_EXTENSION);
// 				$file = $row['name'].".".$ext;	
// 					if(move_uploaded_file($_FILES[$row['checklist_id']]["tmp_name"],$path.$file) ):
// 					$insert = mysql_query("insert into `submit` values(NULL,'$student_id','{$row['checklist_id']}','$file','$date')") or die(mysql_error());
// 					endif;
// 				endif;
// 		endif;
// 	endwhile;
endif;

if(isset($_POST['student'])):
	if(editStudents($_POST)):
		header("location:./");
	endif;
endif;

if(isset($_POST['work'])):
  //  print_r($_POST);
//die();
	if(editWork($_POST['student_id'],$department_id,$_POST)):
		header("location:./");
	endif;
	
endif;

if(isset($_POST['account'])):
	if(editFaculty($_POST)):
		header("location:./");
	endif;
	
endif;
?>
<!DOCTYPE html>
<html>
<head>
    <title>.</title>
    <link href="css/application.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.testes{
letter-spacing:2px;
text-shadow:1px 1px 5px rgba(0, 0, 0, 0.5);
 font-size: 35px;
}

@media screen and (max-width: 868px) {
    .testes {
        font-size:28px;
    }
}

@media screen and (max-width: 768px) {
    .testes {
        font-size:25px;
    }
}
 
@media screen and (max-width: 568px) {
    .testes {
        font-size:18px;
    }
}
</style>
<link rel="stylesheet" type="text/css" href="themes/jquery.ui.all.css" />
<style type="text/css">
<!--
.style1 {color: #0000CC}
.style2 {
	color: #267BA4;
}
-->
</style>
</head>
<body class="background-dark">
<div class="logo">
    
</div>

<nav id="sidebar" class="sidebar nav-collapse collapse">
    <ul id="side-nav" class="side-nav">
        <li class="active">
            <a href="./" ><i class="icon-desktop"></i> <span class="name">Stud. Manager</span></a>
			
        </li>
		<li>
            <a href="requirement-manager.php"><i class="icon-folder-open"></i> <span class="name">Req. Manager</span></a>
			
        </li>
        <li>
            <a href="work-manager.php"><i class="icon-paste"></i> <span class="name">Work Details</span></a>
            
        </li>
		
</ul>
    <div id="sidebar-settings" class="settings">
        <button type="button" data-value="icons" class="btn-icons btn btn-transparent btn-small">Icons</button>
        <button type="button" data-value="auto" class="btn-auto btn btn-transparent btn-small">Auto</button>
    </div>
</nav>
<div class="wrap">
    <header class="page-header">
        <div class="navbar">
            <div class="navbar-inner">
				<div class="container-fluid">
			<p class="pull-left testes"><i class="icon-lock icon32"></i> <?=$set['title']; ?></p>
                <ul class="nav pull-right">
          
                    <li class="divider"></li>
                    <li class="hidden-phone">
                        <a href="#" id="settings" title="Settings" data-toggle="popover" data-placement="bottom">
                            <i class="icon-cog"></i>
                        </a>
                    </li>
                    <li class="hidden-phone dropdown">
                        <a href="#" title="Account" id="account" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i>
                        </a>
                       <ul id="account-menu" class="dropdown-menu account" role="menu">
                            <li role="presentation">
                               <a href="" id="account-link" class="link">
							   <i class="icon-edit"></i>
                               <?=$me['fname']; ?>
							   </a>
                            </li>
                           
                          
                            <li role="presentation">
                                <a href="logout.php" class="link">
                                    <i class="icon-signout"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
						   
                    </li>
                 
                 
                </ul>
              
              </div>
            </div>
        </div>
    </header>
    <div class="content container-fluid">
        <div class="row-fluid">
            <div class="span12">
			<ul class="breadcrumb">
					<li>
						<a href="./" class="style2">Dashboard</a> <span class="divider">/</span>					</li>
<li>
						<a href="#" class="style2"><?=$dept['label']; ?>
						<span class="style1"></span></a><span class="divider">/</span>					</li>
<li>
						<a href="#" class="style2"><?=$course['clabel']; ?> Coordinator<span class="style1"></span></a><span class="divider">/</span>					</li>
<li>
                        <a href="#" class="style2">Student Manager</a>
                    </li>
				</ul>
               
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                 <section class="widget">
                    <header>
                        <h4>
                            <i class="icon-file-alt"></i>
                            Student List
                        </h4><div class="pull-right"><div class="btn-group">
                                  <a class="btn btn-success" href="#"><i class="eicon-vcard icon-white"></i>&nbsp; Actions</a>
                                  <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                      <li><a href="student-wizard.php"><i class="eicon-user-add"></i> Add Student</a></li>
									  <li><a href="#"  id="delthis" ><i class="gicon-trash"></i>  &nbsp; Delete All Record</a></li>
                                    <li><a href="#" id="print" ><i class="gicon-file"></i>  &nbsp; Student List</a></li>
                                    <li><a href="#" id="checklist" ><i class="gicon-list"></i> Checklist</a></li>
                                    <li><a href="#" id="complete" ><i class="gicon-ok"></i> Completed</a></li>
                                    <li><a href="#" id="incomplete" ><i class="gicon-remove"></i> Incomplete</a></li>
                                    
                                  </ul>
                                </div></div>
						   <blockquote>
                            Column sorting, live search, pagination.
                        </blockquote>
                    </header>
                    <div class="body">
                        
                        <table id="datatable-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th class="no-sort">&nbsp;</th>
                                <th>Name</th>
                                <!--<th>Course</th>-->
                                <th>Company</th>
								 <th>Initial Docs</th>
								 <th>Final Docs</th>
								
								
                                <th>SY</th>
								<th>Semester</th>
                                <!--th>Added By</th-->
                                <th class="no-sort">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                           <?php
						   $x=1;
						   $students = getStudent(0,$course['course_id']);
						   foreach($students as $k=>$v):
						   extract($v);
						   $work = getWork($student_id);
						  
						   ?>
                            <tr>
                                <td><?=$x; ?></td>
                                <td><a href="#" class="student" id="<?=$student_id; ?>" data-name="<?=$name; ?>"><?=$name; ?></a></td>
								  <!-- td><?=$course['clabel']; ?> <?=$year; ?>/<?=$block; ?></td -->
                           <td><a href="#" class="work" id="<?=$student_id; ?>" data-name="<?=$name; ?>">Work Details</a></td>
                              
                              <td><a href="#" class="initial" id="<?=$student_id; ?>" data-name="<?=$name; ?>"><?=(checkiSubmit($student_id,$dept['department_id'],0))?"<span class='label label-success arrowed'>Complete</span>":"<span class='label label-important arrowed'>Incomplete</span>"; ?></a></td>
							  <td><a href="#" class="final" id="<?=$student_id; ?>" data-name="<?=$name; ?>"><?=(checkiSubmit($student_id,$dept['department_id'],1))?"<span class='label label-success arrowed'>Complete</span>":"<span class='label label-important arrowed'>Incomplete</span>"; ?></a></td>
								
								
                                <td><?=$sy; ?></td>
								<td><?=$sem; ?></td>
                                <!--td><?=$coordinator; ?></td-->
                                <td><div class="btn-group">
								  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i></a>
								  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								  <ul class="dropdown-menu">
									<li><a href="#" class="edit-student" id="<?=$student_id; ?>" data-name="<?=$name; ?>"><i class="icon-edit"></i> Edit Student Data</a></li>
									<li><a href="#" class="edit-work" id="<?=$student_id; ?>" ><i class="icon-building"></i> Edit Work Data</a></li>
                                    <li><a href="./?delete=<?=$student_id; ?>" class="delete" id="<?=$student_id; ?>" data-name="<?=$name; ?>"><i class="icon-remove"></i> Delete Student</a></li>
									
									
								  </ul>
								</div></td>
                            </tr>
							<?php
							$x++;
							endforeach;
							?>
                            </tbody>
                        </table>
                    </div>
                </section>
          
                
                
            </div>
            
        </div>
    </div>
</div>
<!-- modals -->
						<div id="modal-initial" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="./" method="post" id="form-initial" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Initial Documents of <span id="initial-name"></span></h4>
                            </div>
                            <div class="modal-body" id="initial-body">
                               
                               
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit" name="initial" id="initial-submit">Save changes</button>
                            </div>
						</form>
                        </div>
						
						
						<div id="modal-final" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="./" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Final Documents of <span id="final-name"></span></h4>
                            </div>
                            <div class="modal-body" id="final-body">
                               
                               
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit" name="final" id="initial-submit">Save changes</button>
                            </div>
						</form>
                        </div>
						
						<div id="modal-work" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="./" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Work Info of <span id="work-name"></span></h4>
                            </div>
                            <div class="modal-body" id="work-body">
                               
                               
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                              
                            </div>
						</form>
                        </div>
						
						<div id="modal-student" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="./" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2"><span id="student-name"></span></h4>
                            </div>
                            <div class="modal-body" id="student-body">
                               
                               
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                              
                            </div>
						</form>
                        </div>
						
						<div id="modal-edit-student" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="./" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Edit <span id="student-edit-name"></span></h4>
                            </div>
                            <div class="modal-body" id="student-edit-body">
                             <!-- edit -->  
							   <?php
							   $student = getStudent($student_id,$course['course_id']);
							   ?>
							   
                              <!-- edit -->   
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" type="submit" name="student">Save changes</button>
                            </div>
						</form>
                        </div>
						
						<div id="modal-account" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="./" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Edit Account</h4>
                            </div>
                            <div class="modal-body" id="work-edit-body">
                               <table class="table table-bordered table-condensed table-hover table-striped">
								<tbody>
								<tr><td width="40%">First Name:</td><td><input type="text" name="firstname" id="fname" class="span4" required value="<?=$me['fname']; ?>"/></td></tr>
								<tr><td width="40%">Middle Name:</td><td><input type="text" name="mname" id="mname" class="span4" required value="<?=$me['mname']; ?>"/></td></tr>
								<tr><td width="40%">Last Name:</td><td><input type="text" name="lname" id="lname" class="span4" required value="<?=$me['lname']; ?>"/></td></tr>
								<tr><td width="40%">Username:</td><td><input type="text" name="username" id="username" class="span4" required value="<?=$me['username']; ?>"/></td></tr>
								<tr><td width="40%">Password:</td><td><input type="text" name="password" id="password" class="span4" required value="<?=$me['password']; ?>"/></td></tr>
								</tbody>
								</table>
                               <input type="hidden" name="coordinator_id" id="coordinator_id" value="<?=$me['coordinator_id']; ?>" />
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" type="submit" name="account">Save changes</button>
                            </div>
						</form>
                        </div>
						
						<div id="modal-edit-work" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="./" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Edit Work Data</h4>
                            </div>
                            <div class="modal-body" id="work-edit-body">
                               <table class="table table-bordered table-condensed table-hover table-striped">
								<tbody>
							
                            <?php
                            $result = mysql_query("select * from workdata where `department_id` = '$department_id' ") or die(mysql_error());
                            $arrworkdata=[];
                            while($row=mysql_fetch_assoc($result)):
                               $arrworkdata[]=$row['name'];
                            ?>
                         
                                <tr><td width="40%"><?=$row['label']; ?>:</td><td><input type="text" name="<?=$row['name']; ?>" id="<?=$row['name']; ?>" class="span4"/></td></tr>
                                
                            </tr>
                            <?php
                            endwhile;
                            ?>
                              
       
       
                            </tbody>
								</table>
                               <input type="hidden" name="student_id" id="student_id" />
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" type="submit" name="work">Save changes</button>
                            </div>
						</form>
                        </div>
						
						

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
<script src="jquery-ui-1.8.23.custom.min.js"></script>
<!-- basic application js-->
<script src="js/app.js"></script>
<script src="js/settings.js"></script>
<script src="js/jquery.printPage.js"></script>

<!-- page-specific js -->
<script src="js/tables-dynamic.js"></script>
<script>
$(document).ready(function(){
$.fx.speeds._default = 500;
	
	$( "#delthis" )
			.click(function() {
				$( "div#deleteall" ).dialog( "open" );
			});
			
		$( "div#deleteall" ).dialog({
			autoOpen: false,
			height: "auto",
			width: "450",
			modal: true,
			show: "slide",
			hide: "slide",
			buttons: {
				"Yes": function() {
							window.location = "index.php?delallthis="+<?=$me['course_id'];?>;
							return true;
							
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				window.location = "index.php";
			}
		});
$("#print").attr("href","print.php").printPage();
$("#checklist").attr("href","checklist.php").printPage();
$("#complete").attr("href","complete.php").printPage();
$("#incomplete").attr("href","incomplete.php").printPage();

$('#start').datepicker();
$('#end').datepicker();

$("#wcontact").mask("+999-999-999-999");


	$("#account-link").click(function(e){

	$("#modal-account").modal("show");
	e.preventDefault();
	
	});
	$(".delete").live("click",function(e){
        var name = $(this).data("name");
        if(!confirm("Do you want to delete "+name+"?")){
            return false;
        }
    });
	$(".initial").click(function(e){
		var name = $(this).attr("data-name");
		var student_id = $(this).attr("id");
		$("#initial-name").text(name);
			$.post("ajax/ajax.php?getInitialDocs","student_id="+student_id,function(data){
			$("div#initial-body").html(data);
		});
		$("#modal-initial").modal("show");
		e.preventDefault();

	});
	
	$(".final").click(function(e){
		var name = $(this).attr("data-name");
		var student_id = $(this).attr("id");
		$("#final-name").text(name);
			$.post("ajax/ajax.php?getFinalDocs","student_id="+student_id,function(data){
			$("div#final-body").html(data);
		});
		$("#modal-final").modal("show");
		e.preventDefault();

	});
	
		
	$(".work").click(function(e){
		var name = $(this).attr("data-name");
		var student_id = $(this).attr("id");
		 $("#work-name").text(name);
			$.post("ajax/ajax.php?getWorkInfo","student_id="+student_id,function(data){
			$("div#work-body").html(data);
		});
		$("#modal-work").modal("show");
		e.preventDefault();
	});
	
	$(".student").click(function(e){
		var name = $(this).attr("data-name");
		var student_id = $(this).attr("id");
		 $("#student-name").text(name);
			$.post("ajax/ajax.php?getStudentInfo","student_id="+student_id,function(data){
			$("div#student-body").html(data);
		});
		$("#modal-student").modal("show");
		e.preventDefault();
	});
	
	$(".edit-student").click(function(e){
		var name = $(this).attr("data-name");
		var student_id = $(this).attr("id");
			$("#student-edit-name").text(name);
			$.post("ajax/ajax.php?getStudentInfo&s=1","student_id="+student_id,function(data){
			$("div#student-edit-body").html(data);
		});
		$("#modal-edit-student").modal("show");
		e.preventDefault();
	});
	
	$(".edit-work").click(function(e){
		var name = $(this).attr("data-name");
		var student_id = $(this).attr("id");
			$("#work-edit-name").text(name);
			$.post("ajax/ajax.php?getWorkInfo&s=1","student_id="+student_id,function(data){
			 <?php
                foreach($arrworkdata as $v):
                ?>
                $("#<?=$v; ?>").val(data.<?=$v; ?>);
                <?php
                endforeach;
                ?>
			$("#student_id").val(data.student_id);
		},'json');
		$("#modal-edit-work").modal("show");
		e.preventDefault();
	});
	
	$(".download").live("click",function(e){
		var path = $(this).attr("data-href");
		location.href="download.php?file="+path;
		e.preventDefault();
	});
	

});
</script>


<script type="text/template" id="settings-template">
    <div class="setting clearfix">
        <div>Background</div>
        <div id="background-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% dark = background == 'dark'; light = background == 'light';%>
            <button type="button" data-value="dark" class="btn btn-small btn-transparent <%= dark? 'active' : '' %>">Dark</button>
            <button type="button" data-value="light" class="btn btn-small btn-transparent <%= light? 'active' : '' %>">Light</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar on the</div>
        <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% onRight = sidebar == 'right'%>
            <button type="button" data-value="left" class="btn btn-small btn-transparent <%= onRight? '' : 'active' %>">Left</button>
            <button type="button" data-value="right" class="btn btn-small btn-transparent <%= onRight? 'active' : '' %>">Right</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar</div>
        <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% display = displaySidebar%>
            <button type="button" data-value="true" class="btn btn-small btn-transparent <%= display? 'active' : '' %>">Show</button>
            <button type="button" data-value="false" class="btn btn-small btn-transparent <%= display? '' : 'active' %>">Hide</button>
        </div>
    </div>
</script>

<script type="text/template" id="sidebar-settings-template">
    <% auto = sidebarState == 'auto'%>
    <% if (auto) {%>
    <button type="button"
            data-value="icons"
            class="btn-icons btn btn-transparent btn-small">Icons</button>
    <button type="button"
            data-value="auto"
            class="btn-auto btn btn-transparent btn-small">Auto</button>
    <%} else {%>
    <button type="button"
            data-value="auto"
            class="btn btn-transparent btn-small">Auto</button>
    <% } %>
</script>


</body>
</html>
<!--delete all record-->
	<div id="deleteall" title="Alert">
				Are you sure you want to delete all this record?
	</div>
	<!--delete all record-->