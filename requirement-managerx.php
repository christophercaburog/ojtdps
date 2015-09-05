<?php
session_start();
require_once("inc/dbconnect.php");
require_once("inc/functions.php");
logged(1);

$id = $_SESSION['admin'];
$me = getPersonData($id,1);


if(isset($_GET['delete'])):
   $id = $_GET['delete'];
    $result = mysql_query("DELETE from `checklist` where `checklist_id`='$id'") or die(mysql_error());
    header("location:requirement-managerx.php");
endif;

if(isset($_POST['edit'])):
  if(editCourseDatain($_POST)):
        header("location:requirement-managerx.php");
    endif;
endif;

if(isset($_POST['account'])):
	if(editFaculty($_POST)):
		header("location:requirement-managerx.php");
	endif;
	
endif;

function SaveCourse($cname,$dname,$ddes){
$dbhost = 'localhost'; // is the standard hostname given to the address of the loopback network interface..meaning ito ang computer na ginagamit nyo..ang host ng mysql nyo eh itong computer na ito mismo
$dbuser = 'root'; //default user ng mysql
$dbpass = '';//wala tayong sinet na password para kay root..ok lang yan..
$dbname = 'ojt';
$mysqldb = mysql_connect($dbhost, $dbuser, $dbpass); //name ng database nyo..pwede nyong palitan databse name nyo sa phpmyadmin,basta baguhin nyo rin dito..
mysql_select_db($dbname,mysql_connect($dbhost, $dbuser, $dbpass)) or die ('Error connecting to mysql');//function to select the database..needs two arguments, the db name and resource data ng mysql connect function.
	$cname = cleanthis($cname);$dname = cleanthis($dname);$ddes = cleanthis($ddes);
	$tmpcname = ucwords(strtolower($cname));$tmpdname = ucwords(strtolower($dname));$tmpddes = ucwords(strtolower($ddes));
	$check = mysql_num_rows(mysql_query("select * from course where clabel = '$tmpcname' AND cname = '$tmpdname' AND department_id = '$tmpddes'", $mysqldb));
	if($check > 0){
		return false;
	}else{
		$result = mysql_query("INSERT into `course` values(NULL,'$tmpcname','$tmpdname','$tmpddes')") or die(mysql_error());
		if($result){
		   return true;
		}
	}
}

$ans = false;
if(isset($_POST['cname'])){
$ans = SaveCourse($_POST['cname'],$_POST['dname'],$_POST['department_id']);
	if($ans == true){
			?>
	<script>
	alert("You successfully added new record");
	window.location = "requirement-managerx.php";
	</script>

			<?php	
	}else{
	?>
	<script>
	alert("This record is already exist");
	window.location = "requirement-managerx.php";
	</script>

	<?php
	}

}


/*
if(isset($_POST['requirement'])):
    if(saveRequirement($_POST)):
        header("location:requirement-managerx.php");
    endif;
    
endif;*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
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
.style1 {color: #267BA4}
-->
</style>
</head>
<body class="background-dark">
<div class="logo">
    
</div>
<nav id="sidebar" class="sidebar nav-collapse collapse">
    <ul id="side-nav" class="side-nav">
       
       
		 <li>
            <a href="admin.php"><i class="icon-user"></i> <span class="name">Coordinators</span></a>
            
        </li>
         <li class="active">
            <a href="requirement-managerx.php"><i class="icon-building"></i> <span class="name">Course List</span></a>
            
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
                               <a href="#" id="account-link" class="link">
							   <i class="icon-edit"></i>
                               Admin
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
						<a href="admin.php" class="style1">Admin</a> <span class="divider">/</span>					</li>
<li>
						<a href="#" class="style1">Course List</a>					</li>
			  </ul>
               
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                 <section class="widget">
                    <header>
                        <h4>
                            <i class="icon-file-alt"></i>
                            Course List
                        </h4> <div class="pull-right"><button class="btn btn-danger btn-large" id="add"><i class=" icon-building" > </i> &nbsp;Add Course</button></div>
						   <blockquote>
                            Column sorting, live search, pagination.
                        </blockquote>
                    </header>
                    <div class="body">
                        
                        <table id="datatable-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th class="no-sort">&nbsp;</th>
                                <th>Department</th>
                                <th>Course Label</th>
                                <th>Description</th>
                                <th class="no-sort">&nbsp;</th>
								
                               
                            </tr>
                            </thead>
                            <tbody>
                           <?php
						   $y=1;
						   $result = mysql_query("select * from course order by `department_id` asc") or die(mysql_error());
						   while($row=mysql_fetch_array($result)):

						 extract($row); 
						  ?>
						  <tr><td><?=$y; ?></td><td><?=getDepartmentName($department_id); ?></td><td><?=$clabel; ?></td><td><?=$cname ?></td>
						  <td><div class="btn-group">
                                  <a href="#" class="edit btn btn-primary" id="<?=$course_id; ?>" name="<?=$cname; ?>"><i class="icon-edit"></i> Edit </a>
                                </div></td></tr>
                          <?php
						  $y++;
						  endwhile;
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
	<div id="modal-edit" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="requirement-managerx.php" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Edit "<span id="rname"></span>"</h4>
                            </div>
                            <div class="modal-body" id="requirement-edit-body">
                               <table class="table table-bordered table-condensed table-hover table-striped">
								<tbody id="tbody">
							
								</tbody>
								</table>
                             <br><br>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" type="submit" name="edit">Save changes</button>
                            </div>
						</form>
    </div>
					

                    <div id="modal-requirement" class="modal hide fade" tabindex="-1" role="dialog">
                        <form action="requirement-managerx.php" method="post" id="form-file" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Add Course</h4>
                            </div>
                            <div class="modal-body" id="requirement-edit-body">
                               <table class="table table-bordered table-condensed table-hover table-striped">
                                <tbody>
                                <tr><td width="60%">Course Label:</td><td><input type="text" name="cname" id="cname" required /></td></tr>
								<tr><td width="60%">Course Description:</td><td><input type="text" name="dname" id="dname" required /></td></tr>
                                <tr><td >Department:</td> <td><select class="selectpicker" data-style="btn-warning" tabindex="-1" id="type" name="department_id" required>
                                 <option value="" />Select Department
                                <?php
    $result = mysql_query("select * from `department`") or die(mysql_error());
    while($row=mysql_fetch_array($result)):
        ?>
<option value="<?=$row['department_id']; ?>" /><?=$row['label']; ?>
    <?php
    endwhile;
                                ?>
                                    </select></td></tr>
                                <!--<tr><td >Type:</td> <td><select class="selectpicker" data-style="btn-warning" tabindex="-1" id="type" name="type" required>
                                 <option value="" />Select Type
                                
                                        
                                  <option value="1" />Initial Requirement
                                   <option value="0" />Final Requirement
                                    </select></td></tr>
									-->
                                </tbody>
                                </table>
                             <br><br><br>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" type="submit" name="getcourse">Save </button>
                            </div>
                        </form>
                        </div>

					<div id="modal-account" class="modal hide fade" tabindex="-1" role="dialog">
                        <form action="requirement-managerx.php" method="post" id="form-final" enctype="multipart/form-data" >
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
						
						
                        <div id="modal-delete" class="modal hide fade" tabindex="-1" role="dialog">
                      
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Delete Course</h4>
                            </div>
                            <div class="modal-body" id="work-edit-body">
                               <h3>Are you sure you want to delete <span id="rname"></span>?<br>
                               All associated files will also be deleted.</h3>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" id="delete">Delete</button>
                            </div>
                        
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

<!-- basic application js-->
<script src="js/app.js"></script>
<script src="js/settings.js"></script>
<script src="js/jquery.printPage.js"></script>

<!-- bootstrap custom plugins -->

<script src="lib/bootstrap-select/bootstrap-select.js"></script>
<script src="lib/jquery.bootstrap.wizard.js"></script>
<script src="lib/bootstrap-datepicker.js"></script>
<script src="lib/bootstrap-select/bootstrap-select.js"></script>
<script src="lib/wysihtml5/wysihtml5-0.3.0_rc2.js"></script>
<script src="lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="jquery-ui-1.8.23.custom.min.js"></script>
<!-- page-specific js -->
<script src="js/tables-dynamic.js"></script>
<script src="js/forms.js"></script>
<script>
$(document).ready(function(){

var href="";
	$("#account-link").click(function(e){

	$("#modal-account").modal("show");
	e.preventDefault();
	
	});

	$("#add").click(function(e){

	$("#modal-requirement").modal("show");
	e.preventDefault();
	
	});

    $(".edit").live("click",function(e){
    href=$(this).attr("data-href");
        var course_id = $(this).attr("id");
         var name=$(this).attr('name');
         $("#rname").text(name);
        $.post('ajax/ajax.php?editCourse', "course_id="+course_id, function(data) {
            $("#tbody").html(data);
            $("#modal-edit").modal("show");
        });
   
    e.preventDefault();
    
    });

    $("a.delete").live("click",function(e){
    href=$(this).attr("data-href");
    var name=$(this).attr('name');
    $("#rname").text(name);
   $("#modal-delete").modal("show");
    e.preventDefault();
    
    });

     $("button#delete").click(function(e){
   window.location = href;
    });
	
	$("#department_id").change(function(){
	var department_id = $(this).val();
		$.post("ajax/ajax.php?getCourses","department_id="+department_id,function(data){
			$("#course_id").html(data);
		});
	});
	$.fx.speeds._default = 500;
	
	
				
	

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