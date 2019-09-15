<?php
session_start();
include_once("php_includes/db_connection.php");
// If user is logged in, header them away
if(isset($_SESSION["email"])){
	echo "Please logout first";
    exit();
}
?><?php
//$checkname = new UsernameChecker($_POST['usernamecheck']);
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
	include_once("php_includes/db_connection.php");
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong style="color:#009900;">' . $username . ' is OK :)</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $username . ' is taken :(</strong>';
	    exit();
    }
}
?><?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["u"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_connection.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
	$e = mysqli_real_escape_string($db_connection, $_POST['e']);
	$p = $_POST['p'];
	$g = preg_replace('#[^a-z]#', '', $_POST['g']);
	$c = preg_replace('#[^a-z ]#i', '', $_POST['c']);
	$county = preg_replace('#[^a-z0-9]#i', '', $_POST['county']);
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	$sql = "SELECT id FROM users WHERE username='$u' LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
	$u_check = mysqli_num_rows($query);
	// -------------------------------------------
	$sql = "SELECT id FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
	$e_check = mysqli_num_rows($query);
	// FORM DATA ERROR HANDLING
	if($u == "" || $e == "" || $p == "" || $c == "" || $g == "" || $county == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($u_check > 0){ 
        echo "The username you entered is alreay taken";
        exit();
	} else if ($e_check > 0){ 
        echo "That email address is already in use in the system, if this is your email please go and login";
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else if (is_numeric($u[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } else {
	// END FORM DATA ERROR HANDLING
	    // Begin Insertion of data into the database
		// Hash the password with md5 salt
		$p_hash = md5($p);
		// Add user info into the database table for the main site table
		/*
if($country == "k"){
	$country = "Kenya";
}else if($country == "u"){
	$country = "Uganda";
}else if ($county == "t"){
	$country = "Tanzania";
}else{
$country = "unkwown";
}*/
		$sql1 = "INSERT INTO users (username, email, password, gender, country,county_or_state, ip, signup, lastlogin, notescheck)       
		        VALUES('$u','$e','$p_hash','$g','$c','$county','$ip',now(),now(),now())";
		$query1 = mysqli_query($db_connection, $sql1);
		$uid = mysqli_insert_id($db_connection);
		// Establish their row in the useroptions table
		$sql2 = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
		$query2 = mysqli_query($db_connection, $sql2);
		//insert values into academic info
		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
		if (!file_exists("user/$u")) {
			mkdir("user/$u", 0);
		}if ($query1 !=true) {
			echo "database_error '$u','$e','$p_hash','$g','$c','$county' ".mysqli_error($db_connection);
			exit();
		}else if ($query1 && $query2) {
			$mail_status = "";
		// Email the user their activation link
		$to = "$e";							 
		$from = "GeorgeMonk@masenocommunity.com";
        $subject = 'Welcome to masenocommunity';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Welcome</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px;text-align: center; background:#333; font-size:24px; color:#CCC;"><a href="https://masenocommunitycom.000webhostapp.com"><img src="https://masenocommunitycom.000webhostapp.com/sc_images/sc_logo.png" width="60" height="30" alt="masenocommunity" style="border:none; float:left;"></a>maseno community</div><div style="padding:24px; font-size:17px;">Hello '.$u.',<br /><br />Click the link below to login:<br /><br /><a href="https://masenocommunitycom.000webhostapp.com/login.php">Login</a><br /><br />Your:<br />E-mail Address: <b>'.$e.'</b></div></body></html>';
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        if(mail($to, $subject, $message, $headers)){
        	$mail_status = ", mail sent";
            $name = $email = $phone = $message = $url = '';
        }
            echo "signup_success|".$mail_status;
		exit();
		}
		else{
			echo "An error eccured".mysqli_error($db_connection);
			
        exit();
		}
	exit();
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="style/style.css">

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

<script src="js/ajax.js"></script>
<script src="js/main.js"></script>
<script>
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /['"]/gi;
	} else if(elem == "username" || elem == "country" || elem == "county"){
		rx = /[^a-z0-9]/gi;
	}else if(elem == "phone"){
		rx = /[^0-9 ]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'checking ...';

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
		
		var ajax = ajaxObj("POST", "credentialschecker.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
        
	}
}
function checkemail(){
	var e = _("email").value;
	if(e != ""){
		_("emailstatus").innerHTML = 'checking ...';

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
		
		var ajax = ajaxObj("POST", "credentialschecker.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("emailstatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("emailcheck="+e);
        
	}
}
function signup(){
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var c = _("country").value;
	var g = _("gender").value;
	var county = _("county").value;
	var status = _("status");
	//alert(branch+school+course+county+estate+coach);
	if(u == "" || e == "" || p1 == "" || c == "" || g == "" || county == "" || phone == ""){
		alert("Fill out all of the form data");
	//} else if(p1 != p2){
		//status.innerHTML = "Your password fields do not match";
	}else if (p1 != p2) {
		alert("password mismatch");
	} else {

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
		
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	        	var signup_status = ajax.responseText.split("|");
	        	signup_status1 = signup_status[0];
	        	
	            if(signup_status1 === "signup_success"){
	        	alert(signup_status);

		_("signupbtn").style.display = "none";
		status.innerHTML = '<strong style="color:#009900;">please wait ...</strong>';
					window.location = 'login.php';

				}else{
					alert(ajax.responseText);
				} 
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1+"&c="+c+"&g="+g+"&county="+county);
        
	}
}
function openTerms(){
	_("terms").style.display = "block";
	//emptyElement("status");
}
/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */
</script>
<style type="text/css">

</style>
</head>
<body>
<div id="" class="container" style="">
	<div class="row">
	    <a href="login.php"><button class="btn btn default" id="loginbtn">Back To Login</button></a>
	    <h1 style="text-align: center;color: red;">MASENO COMMUNITY</h1>
		<form name="signupform" class="" id="signupform" onsubmit="return false;">
	    	<div class="form-group">
	    		<label  for="username">Username</label>
	        	<input id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16"  class="form-control">
	    	</div>
	    	<span id="unamestatus"></span>
		    <div  class="form-group">
		    	<label for="">Email Address:</label>
		    	<input id="email" type="email" onfocus="emptyElement('status')" onblur="checkemail()" onkeyup="restrict('email')" maxlength="88" class="form-control">
		    </div>
		    <span id="emailstatus"></span>
		    <div  class="form-group">
		    	<label for="">Phone:</label>
		    	<input id="phone" type="number" onfocus="emptyElement('status')" onkeyup="restrict('phone')" maxlength="11" class="form-control">
		    </div>
		    <span id="phonestatus"></span>
		    <div  class="form-group">
		    	<label for="">Create Password:</label>
		   		<input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="100" class="form-control">
		   	</div>
		    <div  class="form-group">
		    	<label for="">Confirm Password:</label>
		    	<input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="100" class="form-control">
		    </div>
		    <div  class="form-group">
		    	<label for="">Gender</label>
			    <select id="gender" onfocus="emptyElement('status')" class="form-control">
			      <option value=""></option>
			      <option value="m">Male</option>
			      <option value="f">Female</option>
			    </select>
			</div>
		    <div  class="form-group">
		    	<label>Country:</label>
		    	<input id="country" type="text" onfocus="emptyElement('status')" onkeyup="restrict('country')" maxlength="100" class="form-control">
		    </div>
	    	<div  class="form-group">
	    		<label for=""> County/State:</label>
	    		<input id="county" type="text" onfocus="emptyElement('status')" onkeyup="restrict('county')" maxlength="100" class="form-control">
	    	</div>
	    	<span id="status" style="float: right;"></span>
		    <div class="termsopen">
		      <a href="#" onclick="return false" onmousedown="openTerms()" class="pull-right">
		        View the Terms Of Use
		      </a>
	    	</div>

		    <div id="terms" style="display:none;">
		      <h3>masenocommunity Terms Of Use</h3>
		      <p>1. Respect other people privacy.</p>
		      <p>2. Provide genuine personal details.</p>
		      <p>3. <a href="#">View our privacy policy</a>.</p>
		    </div>

		    <br /><br />
		    <div class="form-group" style="margin-bottom: 100px;">
		    	
		    <button id="signupbtn" onclick="signup()" class="btn btn-success pull-right">Create Account</button>
		    </div>
	    </form>
	</div>
</div> 
</body>
</html>