<?php
/*
include_once("php_includes/check_login_status.php");
// If user is already logged in, header that weenis away
if($user_ok == true){
	header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
*/
?><?php

	// CONNECT TO THE DATABASE
	include_once("../php_includes/db_connection.php");
// AJAX CALLS THIS CODE TO EXECUTE
if(isset($_POST["e"])){
	$e = mysqli_real_escape_string($db_connection, $_POST['e']);
	$sql = "SELECT id, username FROM users WHERE email='$e' AND activated='1' LIMIT 1";
	$query = mysqli_query($db_connection, $sql);
	$numrows = mysqli_num_rows($query);
	if($numrows > 0){
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$id = $row["id"];
			$u = $row["username"];
		}
		$emailcut = substr($e, 0, 4);
		$randNum = rand(10000,99999);
		$tempPass = "$emailcut$randNum";
		$hashTempPass = md5($tempPass);
		$sql = "UPDATE useroptions SET temp_pass='$hashTempPass' WHERE username='$u' LIMIT 1";
	    $query = mysqli_query($db_connection, $sql);
		$to = $e;
		$subject ="Kigo Tech Temporary Password";
        $msg = '<h2 style="background-color: darkgrey;color: black"><img src="images/coding.png" width="50" height="50" alt="logo not found" style="margin-right: 50px;">This is <a href="#" style="text-decoration: none;">Kigo Tech</a> Password Reset</h2><h2>Hello '.$u.'</h2><p>This is an automated message from Kigo Tech. If you did not recently initiate the Forgot Password process, please disregard this email.</p><p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password from your profile page to anything you like.</p><p>After you click the link below your password to login will be:<br /><b>'.$tempPass.'</b></p><p><a href="localhost/kigotech/pass_reset/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'">Click here now to apply the temporary password shown below to your account</a></p><p>If the above link does not work, copy this address to your browser: <a href="localhost/kigotech/pass_reset/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'">localhost/kigotech/pass_reset/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'</a></p><p><strong>Note: </strong>If you do not click the link in this email, no changes will be made to your account. In order to set your login password to the temporary password you must click the link above.</p>';
	
	require("../myphpmailer.php");
    } else {
        echo "no_exist";
    }
    exit();
}
?><?php
// EMAIL LINK CLICK CALLS THIS CODE TO EXECUTE
if(isset($_GET['u']) && isset($_GET['p'])){
	$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
	$temppasshash = $_GET['p'];
	if(strlen($temppasshash) < 10){
		exit();
	}
	$sql = "SELECT id FROM useroptions WHERE username='$u' AND temp_pass='$temppasshash' LIMIT 1";
	$query = mysqli_query($db_connection, $sql);
	$numrows = mysqli_num_rows($query);
	if($numrows == 0){
		echo "A problem occurred while reseting your password. We cannot proceed.";
    	exit();
	} else {
		$row = mysqli_fetch_row($query);
		$id = $row[0];
		$sql = "UPDATE users SET password='$temppasshash' WHERE id='$id' AND username='$u' LIMIT 1";
	    $query = mysqli_query($db_connection, $sql);
		$sql = "UPDATE useroptions SET temp_pass='' WHERE username='$u' LIMIT 1";
	    $query = mysqli_query($db_connection, $sql);
	    header("location: ../login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>

<link rel="stylesheet" href="style/style.css">
<style type="text/css">
#pageMid_nodle{
	align-content: center;
	border-radius: 5px;
	text-align: center;
	margin: auto;
	wid_noth: 70%;
}
#forgotpassform{
	margin-top:24px;	
}
#forgotpassform > div {
	margin-top: 12px;	
}
#forgotpassform > input {
	wid_noth: 50%;
	padding: 3px;
	background: #F3F9DD;
}
#forgotpassbtn {
	wid_noth: 30%;
	font-size:15px;
	padding: 10px;
}
#backbtn {
	wid_noth: 20%;
	font-size:15px;
	padding: 10px;
}

</style>
<script src="../js/main.js"></script>
<script>

function forgotpass(){
	var e = _("email").value;
	if(e == ""){
		_("status").innerHTML = '<strong style="color: red;">Type in your email address</strong>';
	} else {
		_("forgotpassbtn").style.display = "none";
		_("status").innerHTML = '<br><strong style="color:#009900;">please wait ...</strong>';

	function ajaxObj(meth, url){
	var x = new XMLHttpRequest();
	x.open(meth, url, true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if (x.readyState ==4 && x.status == 200) {
		return true;
	}
}
		var ajax = ajaxObj("POST", "forgot_pass.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				var response = ajax.responseText.split("|");
				var response1 = response[0];
				var response2 = response[1];
				if(response1 == "success"){
					_("forgotpassform").innerHTML = '<h3 style="color: black;">Step 2. Password reset successful.<br> Check your email inbox in a few minutes</h3><p style="color: green;">You can close this window or tab. :)</p>';
					alert("Sent");
				} else if (response1 == "no_exist"){
					_("status").innerHTML = "<h3 style='background-color: red;'>Sorry that email address is not in our system</h3>";
		_("forgotpassbtn").style.display = "block";
				} else if(response1 == "email_send_failed"){
					_("status").innerHTML = "<h3 style='background-color: red;'>Mail function failed to execute</h3>";
		_("forgotpassbtn").style.display = "block";
					alert(response2);
				} else { 
					alert(response1);
					_("status").innerHTML = "<h3 style='background-color: red;'>An unknown error occurred  </h3>"+ajaxReturn(ajax);
		_("forgotpassbtn").style.display = "block";
				}
	        }else{
	        	_("status").innerHTML = "Ajax object is false";
		_("forgotpassbtn").style.display = "block";
	        }
        }
        ajax.send("e="+e);
	}
}
</script>

	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-8" style="margin-left: 15%">
				
<div id_no="pageMid_nodle" style="text-align: center;">
            <img src="../images/coding.png" width="100" height="100" alt="logo not found">
<h1>Kigo Tech Password Reset Form</h1>
  <h3>Generate a temorary log in password</h3>
  <form id="forgotpassform" onsubmit="return false;">
    <div class="form-group">Step 1: Enter Your Email Address
    <input id="email" type="text" onfocus="_('status').innerHTML='';" maxlength="88" class="form-control">
    <br /><br />
    <button id="forgotpassbtn" onclick="forgotpass()" class="btn btn-primary">Generate Temporary Log In Password</button> 
    </div>
    <span id="status"></span>
  </form>
  <a href="../login.php"> <button id="backbtn" class="btn btn-primary">Back</button></a>
</div>
			</div>
		</div>
	</div>
</body></html>