<?php
session_start();
require_once("inc/dbconnect.php");
require_once("inc/functions.php");
logged(2);
$valid = true;
$date = date("m/d/Y");
$t = time();
$id = $_SESSION['coordinator'];
$me = getPersonData($id,1);
$coordinator = $me['name'];
$course = $_SESSION['course'];
$dept = getDepartment($me['department_id']);
$department_id = $dept['department_id'];
if(isset($_POST['fname'])):
extract($_POST);

$submit = [];
	 $student = saveStudent($_POST);

	if($student):
		$work = saveWork($_POST,$student,$department_id);
        $check = saveChecklist($_POST['checklist'],$student);
        header("location:./");
        die();
    else:
        $valid = false;
	endif;
   
	// $dir = getStudent($student,$course['course_id']);
	// $result = mysql_query("select * from `checklist` where `type` = 1") or die(mysql_error());
	// while($row=mysql_fetch_assoc($result)):
	// if($_FILES[$row['checklist_id']]['name']!==""):
	// $ext = pathinfo($_FILES[$row['checklist_id']]['name'], PATHINFO_EXTENSION);
	// $file = $row['name'].".".$ext;	
	// 	if(move_uploaded_file($_FILES[$row['checklist_id']]["tmp_name"],"docs/{$_SESSION['course']['clabel']}/{$dir['dir']}/".$file) ):
	// 	$insert = mysql_query("insert into `submit` values(NULL,'$student','{$row['checklist_id']}','$file','$date')") or die(mysql_error());
	// 	endif;
	
	// endif;
	// endwhile;
	
endif;


if(isset($_POST['account'])):
	if(editFaculty($_POST)):
		header("location:student-wizard.php");
	endif;
	
endif;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$course['clabel']; ?> Coordinator</title>
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

@media screen and (max-width: 768px) {
    .testes {
        font-size:25px;
    }
}
 
@media screen and (max-width: 568px) {
    .testes {
        font-size:15px;
    }
}
</style>
<link rel="stylesheet" type="text/css" href="themes/jquery.ui.all.css" />
<!-- datepicker -- datepicker ---- datepicker ---- datepicker ---- datepicker ---- datepicker ---- datepicker ---- datepicker -->
<script type="text/javascript" src="./datepick/datepicker.js"></script>
<link href="./datepick/datepicker.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		//<![CDATA[

		/*
				A "Reservation Date" example using two datePickers
				--------------------------------------------------

				* Functionality

				1. When the page loads:
						- We clear the value of the two inputs (to clear any values cached by the browser)
						- We set an "onchange" event handler on the startDate input to call the setReservationDates function
				2. When a start date is selected
						- We set the low range of the endDate datePicker to be the start date the user has just selected
						- If the endDate input already has a date stipulated and the date falls before the new start date then we clear the input's value

				* Caveats (aren't there always)

				- This demo has been written for dates that have NOT been split across three inputs

		*/

		function makeTwoChars(inp) {
				return String(inp).length < 2 ? "0" + inp : inp;
		}

		function initialiseInputs() {
				// Clear any old values from the inputs (that might be cached by the browser after a page reload)
				document.getElementById("test-start").value = "";
				document.getElementById("ed").value = "";

				// Add the onchange event handler to the start date input
				datePickerController.addEvent(document.getElementById("test-start"), "change", setReservationDates);
		}

		var initAttempts = 0;

		function setReservationDates(e) {
				// Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
				// until they become available (a maximum of ten times in case something has gone horribly wrong)

				try {
						var sd = datePickerController.getDatePicker("test-start");
						var ed = datePickerController.getDatePicker("ed");
				} catch (err) {
						if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
						return;
				}

				// Check the value of the input is a date of the correct format
				var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

				// If the input's value cannot be parsed as a valid date then return
				if(dt == 0) return;

				// At this stage we have a valid YYYYMMDD date

				// Grab the value set within the endDate input and parse it using the dateFormat method
				// N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
				var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

				// Set the low range of the second datePicker to be the date parsed from the first
				ed.setRangeLow( dt );
				
				// If theres a value already present within the end date input and it's smaller than the start date
				// then clear the end date value
				if(edv < dt) {
						document.getElementById("ed").value = "";
				}
		}

		function removeInputEvents() {
				// Remove the onchange event handler set within the function initialiseInputs
				datePickerController.removeEvent(document.getElementById("test-start"), "change", setReservationDates);
		}

		datePickerController.addEvent(window, 'load', initialiseInputs);
		datePickerController.addEvent(window, 'unload', removeInputEvents);

		//]]>
		</script>

<!-- datepicker -- datepicker ---- datepicker ---- datepicker ---- datepicker ---- datepicker ---- datepicker ---- datepicker end -->
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
                        <a href="./" class="style1">Dashboard</a> <span class="divider">/</span>                    </li>
<li>
                        <a href="#" class="style1"><?=$dept['label']; ?></a><span class="divider">/</span>                    </li>
<li>
                        <a href="#" class="style1"><?=$course['clabel']; ?> Coordinator</a><span class="divider">/</span>                    </li>
<li>
                        <a href="#" class="style1">Student Manager</a><span class="divider">/</span>                    </li>
<li>
                        <a href="#" class="style1">Student Wizard</a>                    </li>
			  </ul>
               
            </div>
        </div>
		
        <div class="row-fluid">
		
            <div class="span12">
          
            <section class="widget">
			<div id="bern">
			
			</div>
            <header>
                <h4>
                    <i class="eicon-window"></i>
                    Add-Student Wizard
                    
                </h4>
            </header>
            <div class="body">
                <div id="wizard" class="form-wizard">
                    <ul class="row-fluid wizard-navigation">
                        <li class="span3"><a class="" href="#tab1" data-toggle="tab"><small>1.</small><strong> Student Details</strong></a></li>
                        <li class="span3"><a class="" href="#tab2" data-toggle="tab"><small>2.</small> <strong>Work Details</strong></a></li>
                        <li class="span3"><a class="" href="#tab3" data-toggle="tab"><small>3.</small> <strong>Initial Requirements</strong></a></li>
                        <li class="span3"><a class="" href="#tab4" data-toggle="tab"><small>4.</small> <strong>Thank you!</strong></a></li>
                    </ul>
                    <div id="bar" class="progress progress-inverse progress-small">
                        <div class="bar"></div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                           <form>
                              
                                    <table class="table table-striped table-hover table-condensed">
                           
                            <tbody>
							<tr>
                                <td width="35%"><label for="sID">Student Number</label></td>
                                <td><input type="text" name="sID" class="span6" id="test-sID" required="required"></td>
                                
                            </tr>
                            <tr>
                                <td width="35%"><label for="fname">First Name</label></td>
                                <td><input type="text" name="fname" class="span6" id="test-fname" required="required"></td>
                                
                            </tr>
                              <tr>
                                <td><label for="mname">Middle Name</label></td>
                                <td><input type="text" name="mname" class="span6" id="test-mname"></td>
                                
                            </tr>
							<tr>
                                <td><label for="lname">Last Name</label></td>
                                <td><input type="text" name="lname" class="span6" id="test-lname"></td>
                                
                            </tr>
							<tr>
                                <td><label for="address">Address</label></td>
                                <td><input type="text" name="address" class="span6" id="test-address"></td>
                                
                            </tr>
							<tr>
                                <td><label for="test-gender">Gender</label></td>
                                <td>
								  <select class="selectpicker" data-style="btn-success" tabindex="-1" id="test-gender" name="gender">
                                        <option value="1" />Male
                                        <option value="0" />Female
                                        
                                    </select>
								</td>
                                
                            </tr>
							<tr>
                                <td><label for="dob">Date of Birth</label></td>
                                <td> 
                                    <input id="test-dob" class="span6 date-picker" type="text" name="dob" value="" />
                               </td>
                                
                            </tr>
							<tr>
                            <td>
							<label for="contact">Contact #</label> </td>
                            <td> 
                                   <input id="test-contact" type="text" class="span6" name="contact"/>
							</td>
                            </tr>
							
							
							  <tr>
                            <td>
							<label for="course">Course</label> </td>
                            <td> 
                                <input id="course" type="text" placeholder="<?=$course['clabel']; ?>"  disabled="disabled" class="span6" name="course"/>
								<input type="hidden" name="course_id" id="course_id" value="<?=$course['course_id']; ?>" />
							</td>
                            </tr>
							 <tr>
                            <td>
							<label for="year">Year/Block</label> </td>
                            <td> 
                             
                                    <select class="selectpicker" data-style="btn-danger" tabindex="-1" name="year" id="test-year">
                                        <option value="4" />4
                                        <option value="3" />3
                                        <option value="2" />2
                                    </select>
                                    <select class="selectpicker" data-style="btn-warning" tabindex="-1" id="test-block" name="block">
                                        <option value="A" />A
                                        <option value="B" />B
                                        <option value="C" />C
                                    </select>
                                    
                               

							</td>
                            </tr>
                            <tr>
                            <td>
                            <label for="sy">SY/ Semester</label> </td>
                            <td> 
                             
                                    <select class="selectpicker" data-style="btn-info" tabindex="-1" name="testsy" id="testsy">
                                       <?php
                                       $x=date("Y");
                                       $y=$x-5;
                                       for(;$x>=$y;$x--):
                                        ?>
        <option value="<?=$x,'-',$x+1; ?>" /><?=$x,'-',$x+1; ?>
                                    <?php
                                        endfor;
                                        ?>
                                    </select>
									
									<select class="selectpicker" data-style="btn-info" tabindex="-1" name="testsem" id="testsem">
										<option value="" ><option>
										<option value="First Sem" />First Sem
										<option value="Second Sem" />Second Sem
										<option value="Summer" />Summer
									</select>
                                    
                             </tr>
                            </tbody>
                        </table>
                             
                            </form>
                        </div>
                        <div class="tab-pane" id="tab2">
                          <form>
                             
                                    <table class="table table-striped table-hover table-condensed">
                           
                            <tbody>
                            <?php
                            $result = mysql_query("select * from workdata where `department_id` = '$department_id' ") or die(mysql_error());
                            $arrworkdata=[];
                            while($row=mysql_fetch_assoc($result)):
                            $arrworkdata[]=$row['name'];    
                            ?>
                            <tr>
                                <td width="35%"><label for="test-<?=$row['name']; ?>"><?=$row['label']; ?></label></td>
                                <td><input type="text" name="<?=$row['name']; ?>" class="span7 <?php if($row['name'] == "start" or $row['name'] == "end" ){echo "w8em format-d-m-y highlight-days-67 range-low-today";}?>" id="test-<?=$row['name']; ?>" <?php if($row['name'] == "start" or $row['name'] == "end"){ echo "readonly='readonly'";}?> ></td>
                                
                            </tr>
                            <?php
                            endwhile;
                            ?>
                              
							
							
                            </tbody>
                        </table>
                              </form> 
                        </div>
                        <div class="tab-pane" id="tab3">
                            <form id="form-main" method="post" enctype="multipart/form-data">
							<input type="hidden" name="sID" id="sID">
                                <input type="hidden" name="fname" id="fname">
                                <input type="hidden" name="mname" id="mname">
                                <input type="hidden" name="lname" id="lname">
                                <input type="hidden" name="address" id="address">
                                <input type="hidden" name="gender" id="gender">
                                <input type="hidden" name="dob" id="dob">
                                <input type="hidden" name="contact" id="contact">
                                <input type="hidden" name="course_id" id="course_id" value="<?=$course['course_id']; ?>">
								<input type="hidden" name="year" id="year">
								<input type="hidden" name="block" id="block">
                                <input type="hidden" name="xsy" id="xsy">
								<input type="hidden" name="sem" id="sem">
                                <?php
                                foreach($arrworkdata as $v):
                                    ?>
                                    <input type="hidden" name="company_<?=$v; ?>" id="company-<?=$v; ?>">
                                    <?php
                                endforeach;
                                ?>
								
                                      <table class="table table-striped table-hover table-condensed">
                           
                            <tbody>
                           
							<?php
						   $result = mysql_query("select * from `checklist` where `type` = 1 and `department_id`='".$dept['department_id']."'") or die(mysql_error());
                          
						   while($row=mysql_fetch_assoc($result)):
						   extract($row);
						   ?>
							<tr>
                            <td>
							<label for="<?=$checklist_id; ?>"><?=$name; ?></label> </td>
                            <td> 
                                 
                                        
                                        <input type="checkbox" name="checklist[]" id="<?=$checklist_id; ?>" value="<?=$checklist_id; ?>" />
                                
							</td>
                            </tr>
							<?php
							endwhile;
							?>
							
                            </tbody>
                        </table>
                            </form>
						
                           
                        </div>
                        <div class="tab-pane" id="tab4">
                            <h2>Thank you!</h2>
                            <p>Please click finish to save this record.</p>
                        </div>
                        <div class="description">
                            <ul class="pager wizard">
                                <li class="previous">
                                    <button class="btn btn-primary pull-left"><i class="icon-caret-left"></i> Previous</button>
                                </li>
                                <li class="next">
                                    <button class="btn btn-primary pull-right">Next <i class="icon-caret-right"></i></button>
                                </li>
                                <li class="finish" style="display: none">
                                    <button id="verify" class="btn btn-success pull-right">Finish <i class="icon-ok"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
			<div id="ivan">
			
			</div>
            </section>
 
          
                
                
            </div>
			
            
        </div>
    </div>
</div>

				<div id="modal-account" class="modal hide fade" tabindex="-1" role="dialog">
						<form action="student-wizard.php" method="post" id="form-final" enctype="multipart/form-data" >
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
						

                        <div id="modal-error" class="modal hide fade" tabindex="-1" role="dialog">
                      
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 id="myModalLabel2">Registration Error!</h4>
                            </div>
                            <div class="modal-body" id="work-edit-body">
                               <h3>The Name '<span><?=$fname,' ',$mname,' ',$lname; ?>' Already Exists!</span>
                               </h3>
                            </div>
                            <div class="modal-footer">
                               
                               <button class="btn btn-primary" >Close</button data-dismiss="modal">
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


<!--backbone and friends -->
<script src="lib/backbone/underscore-min.js"></script>

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

<!-- bootstrap custom plugins -->

<script src="lib/bootstrap-select/bootstrap-select.js"></script>
<script src="lib/jquery.bootstrap.wizard.js"></script>
<script src="lib/bootstrap-datepicker.js"></script>
<script src="lib/bootstrap-select/bootstrap-select.js"></script>
<script src="lib/wysihtml5/wysihtml5-0.3.0_rc2.js"></script>
<script src="lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<!-- ui jquery family -->

<script src="jquery-ui-1.8.23.custom.min.js"></script>
<!-- ui jquery family-->
<!-- basic application js-->
<script src="js/app.js"></script>
<script src="js/settings.js"></script>

<!-- page specific js -->

<script src="js/forms.js"></script>
<script>
$(document).ready(function(){
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1 );
			}, 5 );
		}

 $("#account-link").click(function(e){

	$("#modal-account").modal("show");
	e.preventDefault();
	
	});
 <?php
 if(!$valid):
    ?>
    $("#modal-error").modal("show");
    <?php
 endif;
 ?>
 $("#test-sID").mask("-99-9999");
$("#test-contact").mask("+999-999-999-999");
$("#test-wcontact").mask("+999-999-999-999");
 $("#wizard").bootstrapWizard({onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
        var $wizard = $("#wizard");
        $wizard.find('.bar').css({width:$percent+'%'});
        if($current >= $total) {
            $wizard.find('.pager .next').hide();
            $wizard.find('.pager .finish').show();
                $wizard.find('.pager .finish').removeClass('disabled');
				$("#sID").val($("#test-sID").val());
                $("#fname").val($("#test-fname").val());
                $("#mname").val($("#test-mname").val());
                $("#lname").val($("#test-lname").val());
                $("#address").val($("#test-address").val());
                $("#gender").val($("#test-gender").val());
                $("#dob").val($("#test-dob").val());
                $("#contact").val($("#test-contact").val());
                $("#year").val($("#test-year").val());
                $("#block").val($("#test-block").val());
                $("#xsy").val($("#testsy").val());
				$("#sem").val($("#testsem").val());
                <?php
                foreach($arrworkdata as $v):
                ?>
                $("#company-<?=$v; ?>").val($("#test-<?=$v; ?>").val());
                <?php
                endforeach;
                ?>
                $.fx.speeds._default = 500;
				$("#verify").live("click",function(e){
						$.post("verify.php", $("#form-main").serialize(),
						function(result){
							if(result != "\0"){
							updateTips(result);
							$alert.dialog("open");
							return false;
							}else{
							updateTips("You succesfully Added new record");
							$alert.dialog("open");
							var progress = setInterval(function() {
							$("div#alert" ).dialog( "close" );
							$("#form-main").submit();
							},2000);
							
							
							return true;
							}
							
						});
						return false;
				e.preventDefault();
				});
				
				
				
				
                var progress = setInterval(function() {
				//$alert.dialog("open");
                    
                //$("#form-main").submit();
                },1000);
                
        } else {
            $wizard.find('.pager .next').show();
            $wizard.find('.pager .finish').hide();
            
        }
    }});
	$alert = $( "div#alert" ).dialog({
			autoOpen: false,
			height: "auto",
			width: "450",
			modal: true,
			show: "slide",
			hide: "drop",
			buttons:{
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	
	
});
</script>




<script type="text/template" id="message-template">
        <div class="sender pull-left">
            <div class="icon">
                <img src="img/2.jpg" class="img-circle" alt="">
            </div>
            <div class="time">
                just now
            </div>
        </div>
        <div class="chat-message-body">
            <span class="arrow"></span>
            <div class="sender">Tikhon Laninga</div>
            <div class="text">
                <%- text %>
            </div>
        </div>
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
						<div id="alert" title="Alert!">
							<p class="validateTips">All form fields are required.</p>
						</div>
</body>
</html>