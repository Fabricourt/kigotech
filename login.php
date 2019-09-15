<?php
session_start();
if (isset($_SESSION['email'])) {
	header("location: index.php");
}
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_connection.php");
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
$email = $password = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 $email = $_POST['e'];
 $password = $_POST['p'];
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$e = mysqli_real_escape_string($db_connection, $email);
	$p = md5($password);
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($e == "" || $p == ""){
		echo "login_failed|empty_fields";
			//echo '<h2>login failed, empty fields. check your email and password and try again</h2><br><a href="login.php"><button id="loginbtn">Back To Login</button></a>';
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT id, username, email, password FROM users WHERE email='$e' AND activated='1' LIMIT 1";
        $query = mysqli_query($db_connection, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_username = $row[1];
		$db_email = $row[2];
        $db_pass_str = $row[3];
        if ($e != $db_email) {
			echo "login_failed|wrong_email";
        }
		else if($p != $db_pass_str){
			echo "login_failed|wrong_password";
			//echo '<h2>login failed. check your email and password and try again</h2><br><a href="login.php"><button id="loginbtn">Back To Login</button></a>';
            exit();
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			
			$_SESSION['userid'] = $db_id;
			$_SESSION['email'] = $db_email;
			$_SESSION['password'] = $db_pass_str;
			setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("email", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
    		setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE); 
    		
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
            $query = mysqli_query($db_connection, $sql);
           // echo $db_username;
		if($p == $db_pass_str){
			echo "login_successful|Welcome $db_username";
			//header("location: index.php?u=".$db_username."&id=".$db_id);
		    exit();
            }
		}
	}
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Maseno community</title>

   <script src="js/main.js"></script>
   <script src="js/ajax.js"></script>
   <script type="text/javascript" src="login.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
<body>

<div class="container">

	<div style="margin-left: 20%">
<img src="images/maseno_logo.png" width="100" height="100" style="margin:auto;">
<h1>MASENO COMMUNITY</h1>
<div class="col-lg-9" >
		<form onsubmit="return false">
			<fieldset>
				<legend>Login Here</legend>
				<span id="infostatus" style="float: middle;color: red;"></span>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" class="form-control" id="email" onfocus="emptyElement('infostatus')">
				</div>
				<div class="form-group">
					<label for="pw">Password</label>
					<input type="Password" name="password" class="form-control" id="password" onfocus="emptyElement('infostatus')">
				</div>
				<div class="form-group" style="display: block;" id="loginbtn">
					<button class="btn btn-primary pull-right" onclick="loginUser()" name="login"><span class="glyphicon glyphicon-log-in"> </span>Login</button>
				</div>
				<span id="waitingstatus" style="float: middle;color: green;"></span>
			</fieldset>
		</form>
		<div>
    <a href="signup.php"><button class="btn btn-default" id="createaccountbtn">Create Account?</button></a></div>
		<div>
			 <a href="pass_reset/forgot_pass.php" class="pull-right">Forgot Your Password?</a>
		</div>
   </div>
	</div>
</div>
</body>
</html>