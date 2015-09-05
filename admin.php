<?php
session_start();
require_once("inc/dbconnect.php");
require_once("inc/functions.php");
logged(1);

$id = $_SESSION['admin'];
$me = getPersonData($id,1);

if(isset($_POST['coordinator'])):
	if(saveCoordinator($_POST)):
	header("location:admin.php");
	endif;
endif;

if(isset($_POST['edit'])):
    if(editFaculty($_POST)):
    header("location:admin.php");
    endif;
endif;

if(isset($_GET['delete'])):
    $id = $_GET['delete'];
    $result = mysql_query("DELETE from `coordinator` where `coordinator_id` = '$id' limit 1") or die(mysql_error());
    if($result):
    header("location:admin.php");
    endif;
endif;

if(isset($_POST['account'])):
	if(editFaculty($_POST)):
		header("location:admin.php");
	endif;
	
endif;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin :)</title>
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
.style1 {color: #267BA4}
</style>
</head>
<body class="background-dark">
<div class="logo">
    
</div>
<nav id="sidebar" class="sidebar nav-collapse collapse">
    <ul id="side-nav" class="side-nav">
       
       
		 <li class="active">
            <a href="#"><i class="icon-user"></i> <span class="name">Coordinators</span></a>
			
        </li>
         <li>
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
						<a href="#" class="style1">Coordinator Manager</a>					</li>
			  </ul>
               
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                 <section class="widget">
                    <header>
                        <h4>
                            <i class="icon-file-alt"></i>
                            Coordinator List
                        </h4>
                        <div class="pull-right"><button class="btn btn-danger btn-large" id="add"><i class=" icon-user" > </i> &nbsp;Add Coordinator</button></div>
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
                                <th>Course</th>
                                <th># of Students</th>
								
								 <th>Username</th>
								 <th>Password</th>
								<th class="no-sort">&nbsp;</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                           <?php
						   $y=1;
						   $result = mysql_query("select *,concat(`fname`,' ',`mname`,' ',`lname`) as name from coordinator where x<>1") or die(mysql_error());
						   while($row=mysql_fetch_array($result)):
						   extract($row);
						   $course = getCourse($course_id);
						   $count = countByCourse($course_id);
						  ?>
						  <tr><td><?=$y; ?></td><td><?=$name; ?></td><td><?=$course['clabel']; ?></td><td><?=$count; ?></td><td><?=$username; ?></td><td><?=$password; ?></td>
                        <td><div class="btn-group">
                                  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i></a>
                                  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#" class="edit" id="<?=$coordinator_id; ?>" name="<?=$name; ?>"><i class="icon-edit"></i> Edit </a></li>
                                    <li><a href="#" data-href="admin.php?delete=<?=$coordinator_id; ?>" class="delete" id="<?=$coordinator_id; ?>" name="<?=$name; ?>"><i class="icon-remove"></i> Delete</a></li>
                                    
                                    
                                  </ul>
                                </div></td>
                          </tr>
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
	<div id="modal-account" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="admin.php" method="post" id="form-final" enctype="multipart/form-data" >
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
					
						
						<div id="modal-add" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="admin.php" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Add Coordinator</h4>
                            </div>
                            <div class="modal-body" id="body">
                                 <table class="table table-bordered table-condensed table-hover table-striped">
								<tbody>
								<tr><td width="40%">First Name:</td><td><input type="text" name="fname" id="fname" class="span3" required/></td></tr>
								<tr><td>Middle Name:</td><td><input type="text" name="mname" id="mname" class="span3" required/></td></tr>
								<tr><td>Last Name:</td><td><input type="text" name="lname" id="lname" class="span3" required/></td></tr>
								<tr><td>Department:</td><td>
								 <select class="selectpicker" data-style="btn-warning" tabindex="-1" id="department_id" name="department_id" required>
								 <option value="" />Select Department
								 <?php
								 $result = mysql_query("select * from `department`") or die(mysql_error());
								 while($row=mysql_fetch_array($result)):
								 extract($row);
								 ?>
                                        <option value="<?=$department_id; ?>" /><?=$label; ?>
                                  <?php
									endwhile;
									?>
                                    </select>
								</td></tr>
								<tr><td>Course:</td><td>
								 <select class="selectpicker" data-style="btn-success" tabindex="-1" id="course_id" name="course_id" required>
								 <option value="" />Select Course
								 
                                    </select>
								</td></tr>
								<tr><td>Username:</td><td><input type="text" name="username" id="username" class="span3" required/></td></tr>
								<tr><td>Password:</td><td><input type="text" name="password" id="password" class="span3" required/></td></tr>
								</tbody>
								</table>
                               
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" type="submit" name="coordinator">Save changes</button>
                            </div>
						</form>
                        </div>
						

                        <div id="modal-edit" class="modal hide fade" tabindex="-1" role="dialog">
                        <form action="admin.php" method="post" id="form-edit" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Edit <span id="rname"></span></h4>
                            </div>
                            <div class="modal-body" id="requirement-edit-body">
                               <table class="table table-bordered table-condensed table-hover table-striped">
                                <tbody id="tbody">
                                  <tr><td>Last Name:</td><td><input type="text" name="lname" id="elname" required /></td></tr>
                            <tr><td>First Name:</td><td><input type="text" name="firstname" id="efname" required /></td></tr>
                             <tr><td>Middle Name:</td><td><input type="text" name="mname" id="emname" required /></td></tr>
                             <tr><td>Username:</td><td><input type="text" name="username" id="eusername" required /></td></tr>
                             <tr><td>Password:</td><td><input type="text" name="password" id="epassword" required /></td></tr>
                             <input type="hidden" name="coordinator_id" id="coordinator_id" />
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


						   <div id="modal-delete" class="modal hide fade" tabindex="-1" role="dialog">
                      
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Delete Coordinator</h4>
                            </div>
                            <div class="modal-body" id="work-edit-body">
                               <h3>Are you sure you want to delete <span id="rname"></span>?<br>
                               </h3>
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

	$("#modal-add").modal("show");
	e.preventDefault();
	
	});

      $(".edit").live("click",function(e){
    href=$(this).attr("data-href");
        var coordinator_id = $(this).attr("id");
         var name=$(this).attr('name');
         $("#rname").text(name);
        $.post('ajax/ajax.php?getCoorDetails', "coordinator_id="+coordinator_id, function(data) {
           $("#efname").val(data.fname);
           $("#emname").val(data.mname);
           $("#elname").val(data.lname);
           $("#eusername").val(data.username);
           $("#epassword").val(data.password);
            $("input#coordinator_id").val(data.coordinator_id);
            $("#modal-edit").modal("show");
        },'json');
   
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