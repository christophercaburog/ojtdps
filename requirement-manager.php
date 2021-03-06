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

if(isset($_GET['delete'])):
   $id = $_GET['delete'];
    $result = mysql_query("DELETE from `checklist` where `checklist_id`='$id'") or die(mysql_error());
    header("location:requirement-manager.php");
endif;

if(isset($_POST['edit'])):
  if(editChecklist($_POST)):
        header("location:requirement-manager.php");
    endif;
endif;

if(isset($_POST['account'])):
	if(editFaculty($_POST)):
		header("location:requirement-manager.php");
	endif;
	
endif;

if(isset($_POST['requirement'])){
$boolian = saveRequirement($_POST);
    if($boolian == "\0"){
	?>
	<script>
		alert("Sorry unable to add new requirement because this record is already exist");
		window.location = "requirement-manager.php";
	</script>
     <?php   
    }else{
	?>
	<script>
		alert("You Successfully add new record");
		window.location = "requirement-manager.php";
	</script>
	<?php
	}
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$course['clabel']; ?> Coordinator -  Requirement Manager</title>
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
.style1 {
	color: #267BA4
}
</style>
</head>
<body class="background-dark">
<div class="logo">
    
</div>
<nav id="sidebar" class="sidebar nav-collapse collapse">
    <ul id="side-nav" class="side-nav">
       
       
		  <li>
            <a href="./" ><i class="icon-desktop"></i> <span class="name">Stud. Manager</span></a>
            
        </li>
        <li class="active">
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
                        <a href="./" class="style2 style1">Dashboard</a> <span class="divider">/</span>                    </li>
<li>
                        <a href="#" class="style2 style1"><?=$dept['label']; ?></a><span class="divider">/</span>                    </li>
<li>
                        <a href="#" class="style2 style1"><?=$course['clabel']; ?> Coordinator</a><span class="divider">/</span>                    </li>
<li>
                        <a href="#" class="style2 style1">Requirements Manager</a>                    </li>
              </ul>
               
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                 <section class="widget">
                    <header>
                        <h4>
                            <i class="icon-file-alt"></i>
                            Requirement List
                        </h4> <div class="pull-right"><button class="btn btn-danger btn-large" id="add"><i class=" icon-building" > </i> &nbsp;Add Requirement</button></div>
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
                                <th>Type</th>
                                <th class="no-sort">&nbsp;</th>
								
                               
                            </tr>
                            </thead>
                            <tbody>
                           <?php
						   $y=1;
						   $result = mysql_query("select * from checklist where `department_id` = '$department_id'  order by `type` desc") or die(mysql_error());
						   while($row=mysql_fetch_array($result)):

						 extract($row); 
                        
						  ?>
						  <tr><td><?=$y; ?></td><td><?=$name; ?></td><td><?=($type)?"Initial Documents":"Final Documents"; ?></td>
						  <td><div class="btn-group">
                                  <a class="btn btn-primary" href="#"><i class="icon-building icon-white"></i></a>
                                  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#" class="edit" id="<?=$checklist_id; ?>" name="<?=$name; ?>"><i class="icon-edit"></i> Edit </a></li>
                                    <li><a href="#" data-href="requirement-manager.php?delete=<?=$checklist_id; ?>" class="delete" id="<?=$checklist_id; ?>" name="<?=$name; ?>"><i class="icon-remove"></i> Delete</a></li>
                                    
                                    
                                  </ul>
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
						<form action="requirement-manager.php" method="post" id="form-final" enctype="multipart/form-data" >
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
                        <form action="requirement-manager.php" method="post" id="form-final" enctype="multipart/form-data" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Add a Requirement</h4>
                            </div>
                            <div class="modal-body" id="requirement-edit-body">
                               <table class="table table-bordered table-condensed table-hover table-striped">
                                <tbody>
                                <tr><td width="60%">Requirement Name:</td><td><input type="text" name="name" id="name" required /></td></tr>
                                <input type="hidden" name="department_id" id="department_id" value="<?=$department_id; ?>">
                                <tr><td >Type:</td> <td><select class="selectpicker" data-style="btn-warning" tabindex="-1" id="type" name="type" required>
                                 <option value="" />Select Type
                                
                                        
                                  <option value="1" />Initial Requirement
                                   <option value="0" />Final Requirement
                                    </select></td></tr>
                                </tbody>
                                </table>
                             <br><br><br>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal">Close</button>
                               <button class="btn btn-primary" type="submit" name="requirement">Save</button>
                            </div>
                        </form>
                        </div>

					<div id="modal-account" class="modal hide fade" tabindex="-1" role="dialog">
                        <form action="requirement-manager.php" method="post" id="form-final" enctype="multipart/form-data" >
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
                                <h4 id="myModalLabel2">Delete Requirement</h4>
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
        var checklist_id = $(this).attr("id");
         var name=$(this).attr('name');
         $("#rname").text(name);
        $.post('ajax/ajax.php?getReqDetails', "checklist_id="+checklist_id, function(data) {
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