<?php	
require("head_php.php"); 
  
$btnType= 'Edit';

#############################select user personal details######################
if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];


				if ($description == NULL) {
					$btnType = 'Write';
				}
				if ($db_gender == 'm') {
					$gender = 'Male';
				}else{
					$gender = 'Female';
				}
				switch ($userlevel) {
					case 'a':
					$userlevel = 'ADMINISTRATOR';
						break;
					case 'b':
					$userlevel = 'VICE CHAIRPERSON';
						break;
					case 'c':
					$userlevel = 'SECRETARY';
						break;
					case 'd':
					$userlevel = 'TRESURER';
						break;
					case 'e':
					$userlevel = 'QUALITY AND CONTROL';
						break;
					case 'f':
					$userlevel = 'USER';
						break;

					default:
						$userlevel = 'UNIQUE USER';
						break;
				}
				if ($avatar == NULL) {
		$profilepic = '<img src="images/avatar_default.png" width="200px" height="200px" alt="default img not found">';
	}else{
		$profilepic = '<img src="user/'.$username.'/'.$avatar.'" width="200px" height="200px" alt="'.$username. ' img not found">';
	}
	

#############################edit user personal details######################
if (isset($_POST['uname']) && isset($_POST['new_email'])) {
	$uname = preg_replace('#[^a-z0-9]#i', '', $_POST['uname']);
		$new_email = mysqli_real_escape_string($db_connection, $_POST['new_email']);
	$gender = preg_replace('#[^a-z]#i', '', $_POST['gender']);
		$phone = $_POST['phone'];





	// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	$sql = "SELECT id FROM users WHERE username='$uname' AND id != '$id' LIMIT 1";//1 EXCEPT SELECT id FROM users WHERE username='$u'LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
	$u_check = mysqli_num_rows($query);
	// -------------------------------------------
	$sql = "SELECT id FROM users WHERE email='$new_email' AND id != '$id' LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
	$e_check = mysqli_num_rows($query);
	// FORM DATA ERROR HANDLING
	if($uname == "" || $new_email == "" || $phone == "" || $gender == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($u_check > 0){ 
        echo "The username you entered is alreay taken";
        exit();
	} else if ($e_check > 0){ 
        echo "That email address is already in use in the system, if this is your email please go and login";
        exit();
	} else if (strlen($uname) < 3 || strlen($uname) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else if (is_numeric($uname[0])) {
        echo 'Username cannot begin with a number';
        exit();
    }else{
    	$sql = "UPDATE `kigotech_db`.`users` SET `username` = '$uname', `gender` = '$gender', `email` = '$new_email', `phone` = '$phone' WHERE `users`.`email` = '$email'  LIMIT 1";
			$query = mysqli_query($db_connection,$sql);

			if ($query) {

		if ($email != $new_email) {
			$_SESSION['email'] = $new_email;
			setcookie("email", $new_email, strtotime( '+30 days' ), "/", "", "", TRUE);
		}
		if ($username != $uname) {
			$sql = "UPDATE `kigotech_db`.`useroptions` SET `username` = '$uname' WHERE `useroptions`.`id` = '$id'  LIMIT 1";
			$query = mysqli_query($db_connection,$sql);

	    if (file_exists("user/$username")) { rename("user/$username", "user/$uname"); }else{mkdir("user/$uname");}
		}
		echo "update_success";
		exit();
	}else{
		echo "error_updating_details";
			exit();
	}
    }
			
			}

#############################add or edit executive userlevel######################
if (isset($_POST['PersonalDescription']) && isset($_POST['PersonalBtn'])) {
	$description = $_POST['PersonalDescription'];
		$btn = $_POST['PersonalBtn'];

			$sql = "UPDATE users SET description='$description' WHERE email='$email' LIMIT 1";
			$query = mysqli_query($db_connection,$sql);

			if ($query) {
			echo $btnType." success";
			exit();

			}else{
			echo $btnType." failed";
			exit();
		}
}

#############################change password######################
if (isset($_POST['cp']) && isset($_POST['np'])) {
	$cp = md5($_POST['cp']);
		$np = md5($_POST['np']);

	$sql = "SELECT password FROM users WHERE email='$email' LIMIT 1";

	$query = mysqli_query($db_connection, $sql);
	if ($row = mysqli_fetch_row($query)) {
			$db_cp = $row[0];
		}
		if ($db_cp == $cp) {
			$sql = "UPDATE `kigotech_db`.`users` SET `password` = '$np' WHERE `users`.`email` = '$email'  LIMIT 1";
			$query = mysqli_query($db_connection,$sql);

			if ($query) {

		echo "password_changed_successfully";
		exit();
	}else{
		echo "an error occured while changing your password";
		exit();
	}
		}else{
			echo "your current password do not match";
			exit();
		}
			
			}

###############################upload profile picture#######################
if (isset($_FILES['uploadImage'])) {
	$img_name = $_FILES['uploadImage']['name'];
	$img_tempLoc = $_FILES['uploadImage']['tmp_name'];

	$folder='user/'.$username.'/';
	$image_name=$_FILES['uploadImage']['name'];
	echo $image_name;
	$sql = "UPDATE users SET avatar='$image_name'  WHERE email='$email' LIMIT 1";
	$query = mysqli_query($db_connection, $sql);
	if ($query) {
			if (!file_exists("user/$username")) {
			mkdir("user/$username", 0);
		}
	if (move_uploaded_file($img_tempLoc, $folder."$img_name")) {
		header("location:profile.php");
	}else {
		echo "<script>alert('photo upload error');</script>";
	}
	}
}
}
####################redirect users to login page if they are not logged in###################
/*
else {
	header("location: login.php");
}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>profile</title>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="apps/ckeditor/ckeditor.js"></script>

<script src="js/ajax.js"></script>
<script src="js/main.js"></script>

	<script type="text/javascript">
		function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /['"]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}else if(elem == "phone"){
		rx = /[^0-9 ]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
		function checkusername(){
	var u = _("name").value;
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

		function uploadProfilePic(){
         var id = document.getElementById("imageUploadDiv");
         if (id.style.display == 'none') {
         	id.style.display = 'block';
         }else{
         	id.style.display = 'none';
         }
		}

		function addContentToEditor(componentId, editorId,btnType){
			var data = _(componentId).innerHTML;
			alert(data+" button");
			
			if (btnType == 'Edit') {
			alert(data);
			_(editorId).value = data;

			}
			
		}
		function PersonalDescription(descriptionType){
			var PersonalDescription = _("PersonalDescriptionArea").value;
			if (PersonalDescription ==  "") {
					alert("Please a brief introduction about yourself");
			}else{

				_("rstatus").innerHTML = 'Please wait...';
				_("PersonalBtn").style.display = "none";
			var ajax =  new XMLHttpRequest();
			ajax.open("POST","profile.php",true);
			ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					alert(this.responseText);
				_("PersonalDisplayTextDiv").innerHTML = PersonalDescription;
				toggleHtmlElement('PersonalDescriptionDiv','showPersonalDescriptionArea');
				_("PersonalDescriptionArea").innerHTML = '';
				_("rstatus").innerHTML = '';
				_("PersonalBtn").style.display = "block";
				}
			}
			ajax.send("PersonalDescription="+PersonalDescription+"&PersonalBtn="+PersonalBtn);
			}

		}
		function editPersonalDetails(){
			var uname = _("name").value;
			var email = _("email").value;
			var gender = _("gender").value;
			var phone = _("phone").value;
			if (uname == ""||email == ""||gender == ""||phone == "") {
				alert("PLEASE FILL OUT ALL THE FIELDS");
			}else{

				_("dstatus").innerHTML = 'Please wait...';
			var ajax =  new XMLHttpRequest();
			ajax.open("POST","profile.php",true);
			ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					if (ajax.responseText == "update_success") {
						alert("details updated");
				window.location='profile.php';
					}else{
						alert(this.responseText);
					}
				}
			}
			ajax.send("uname="+uname+"&new_email="+email+"&gender="+gender+"&phone="+phone);
			}
		}	function editMyPassword(){
			var cp = _("cpassword").value;
			var np = _("npassword").value;
			if (cp == "") {
				alert("PLEASE ENTER YOUR CURRENT PASSWORD");
			}else if (np == "") {
				alert("PLEASE ENTER YOUR NEW PASSWORD");
			}else{

				_("pstatus").innerHTML = 'Please wait...';
			var ajax =  new XMLHttpRequest();
			ajax.open("POST","profile.php",true);
			ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					if (ajax.responseText == "password_changed_successfully") {
			alert("Your new password is: "+np);
			_("cpassword").innerHTML = '';
			_("npassword").innerHTML = '';
					}else{
						alert(this.responseText);
					}
				}
			}
			ajax.send("cp="+cp+"&np="+np);
			}
		}
		function toggleHtmlElement(id1,id2){

			var id1 = _(id1);
			var id2 = _(id2);

			if (id1.style.display == "none") {
				 id1.style.display = "block";

			}else {
				 id1.style.display = "none";
				}
					if (id2.style.display == "none") {
				 id2.style.display = "block";

			}else {
				 id2.style.display = "none";
				}
				}
		function emptyElement(id){
			_(id).innerHTML = '';
		}
	</script>
	<style type="text/css">
	h1{
		color: blue;
	}
		h4{
			color: dodgerblue;
		}
	</style>
</head>
<body style="">
	<?php include("header.php"); ?>
<div class="container">
	<div class="row" style="margin-top: 50px; text-align: center;">

			<div><h1>My Profile</h1></div>

			<div class="col-sm-3">
				<div class="profilePicDiv" style="margin: 5px;">
					<?php echo '<h3>'.$username.'</h3>'; ?>
					<?php echo $profilepic; ?>
	
			</div>	
			</div>

		<div class="col-sm-9" style="margin-top:25px;">

<div id="toolbar" class="settings-toolbar">
<ul class="nav nav-tabs settings-tabs" role="tablist">
<li class="active settings-tab-active">
<a href="#" aria-controls="my_profile" role="tab">my profile</a>
</li>
<li class="settings-tab-inactive">
<a href="#" aria-controls="payments" role="tab">Messages</a>
</li>
<li class="settings-tab-inactive">
<a href="#" aria-controls="subscription" role="tab">Saved</a>
</li>
</ul>
</div>

			<div id="description_div" style="text-align:centre;">
			<div>
					<h4>Personal Details</h4><hr>
				<h5>User Id: <?php echo $id; ?></h5>
				<form onsubmit="return false;">
					<div class="form-group" id="editnamediv" style="display: block;">
						<label for="name">Name: </label>
						<input type="text" name="name" id="name" onfocus="emptyElement('unamestatus')" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16"  class="form-control" value="<?php echo $username; ?>">
					</div>
	    	<span id="unamestatus"></span>
					<div class="form-group" id="editemaildiv" style="display: block;">
						<label for="email">Emai: </label>
						<input type="text" name="email" id="email" onfocus="emptyElement('emailstatus')" onblur="checkemail()" onkeyup="restrict('email')" maxlength="16"  class="form-control" value="<?php echo $email; ?>">
					</div>
	    	<span id="emailstatus"></span>
					<div class="form-group" id="editgenderdiv" style="display: block;">
						<label for="gender">Gender: </label>
						<select class="form-control" id="gender">
							<option value="<?php echo $db_gender; ?>"><?php echo $gender; ?></option>
							<option value="m">Male</option>
							<option value="f">Female</option>
						</select>
					</div>
					<div class="form-group" id="editphonediv" style="display: block;">
						<label for="phone">Phone: </label>
						<input type="number" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>">
					</div>
					<div class="form-group">
						
				<span><p id="dstatus" style="color: green;"></p></span>

						<input type="submit" name="submit" class="btn btn-primary pull-right" value="Save" onclick="editPersonalDetails()">
					</div>
				</form>
			</div>
				<div style="margin-top: 50px;">
			<h4 style="text-align:centre;">userlevel: </h4><hr>
			<b><?php echo strtoupper($userlevel); ?></b><br>
						<div id="PersonalDisplayTextDiv">
								<?php echo $description; ?>
							</div></div>
<div class="form-group" style="display:none;margin-top:20px;" id="PersonalDescriptionDiv">
 <label for="description">Describe yourself briefly:</label>
 <textarea class="form-control" id="PersonalDescriptionArea" placeholder="Enter <?php echo $userlevel; ?> description here"></textarea>
				<span><p id="rstatus" style="color: green;"></p></span>
 <button class="btn btn-primary pull-right" id="PersonalBtn" style="margin:3px;" onclick="PersonalDescription('<?php echo $btnType; ?>')"><?php echo $btnType; ?> Summary</button>
</div>
<div  id="showPersonalDescriptionArea"  style="display:block;">
						<a href="#" class="pull-right" onclick="return false;" onfocus="addContentToEditor('PersonalDisplayTextDiv','PersonalDescriptionArea','<?php echo $btnType; ?>')" onmousedown="toggleHtmlElement('PersonalDescriptionDiv','showPersonalDescriptionArea')"><?php echo $btnType; ?> a brief intro</a>
					</div>
<div id="passwordchange" style="margin-top: 50px;">
	<h4>Password</h4><hr>
	<form onsubmit="return false;">
		<div class="form-group" id="editMyPassworddiv" style="display: block;">
						<label for="cpassword">Current Password: </label>
						<input type="password" name="cpassword" id="cpassword" class="form-control">
						<label for="npassword">New Password: </label>
						<input type="password" name="npassword" id="npassword" class="form-control">
					</div>
					<div class="form-group">
						
				<span ><p id="pstatus" style="color: green;"></p></span>

						<input type="submit" name="submit" class="btn btn-primary pull-right" value="Save" onclick="editMyPassword()">
					</div>
	</form>
</div>
	<div id="imageUploadDiv" style="display: block; margin-top: 50px;">
 					<h4>Profile Picture</h4><hr>
					<form method="POST" action="profile.php" enctype="multipart/form-data">
						<div class="form-group">
							<input type="file" name="uploadImage" class="form-control" required="this field is required" style=" max-width: 90%;margin-bottom: 10px;">
							<button type="submit" name="submit" class="btn btn-primary pull-right">Upload profile picture</button>
							<p>Your profile picture will automatically be save once you upload it</p>
		</div>
					</form>
				</div>

					</div>
	
				</div>
		</div>
	</div>
		<?php //include("footer.php");?>
</div>
</body>
</html>
