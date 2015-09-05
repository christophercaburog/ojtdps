<?php
session_start();
	require_once("inc/dbconnect.php");
	require_once("inc/functions.php");

$valid=true;
$username="";
$password="";

if(isset($_POST['username'])):
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	if(!login($username,$password)):
		$valid=false;
	endif;
endif;

if(isset($_SESSION['coordinator'])){
		if($_SESSION['coordinator'] == 00001){
			header("location:./admin.php");
		}else{
			header("location:./index.php");
		}
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ojt</title>
    <link href="css/application.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta charset="utf-8" />
    <script src="lib/jquery/jquery.1.9.0.min.js"> </script>
    <script src="lib/backbone/underscore-min.js"></script>
    <script src="js/settings.js"> </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<div class="single-widget-container">
 <div class="row-fluid">
        <div class="span12">
            <h2 class="page-title text-align-center"><?=$set['title']; ?></h2>
        </div>
    </div>

    <section class="widget login-widget">
        <header class="text-align-center">
            <h4>Login to your account</h4>
			<?php
			if(!$valid):
			?>
			<div class="alert alert-error">
			<small>
				Username/Password Combination Incorrect!			</small>			</div>
			<?php
			endif;
			?>
      </header>
        <div class="body">
            <form class="no-margin" action="login.php" method="post" />
                <fieldset>
                    <div class="control-group no-margin">
                        <label class="control-label" for="username">Username</label>
                        <div class="control">
                            <div class="input-prepend input-padding-increased">
                                <span class="add-on">
                                    <i class="eicon-user icon-large"></i>
                                </span>
                                <input id="username" type="text" name="username" value="<?=$username; ?>" placeholder="Your Username" />
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="control">
                            <div class="input-prepend input-padding-increased">
                                <span class="add-on">
                                    <i class="icon-lock icon-large"></i>
                                </span>
                                <input id="password" type="password" name="password" value="<?=$password; ?>" placeholder="Your Password" />
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-actions">
                    <button type="submit" class="btn btn-block btn-large btn-danger">
                        <span class="small-circle"><i class="icon-caret-right"></i></span>
                        <small>Sign In</small>                    </button>
                  <div class="forgot"></div>
                </div>
            </form>
        </div>
        <footer>
         
        </footer>
    </section>
</div>
</body>
</html>