<?php
session_start();
    // CONNECT TO THE DATABASE
   include_once("php_includes/db_connection.php");

    $id=$username=$email=$phone=$password=$db_gender=$gender=$description=$country=$county_or_state=$userlevel=$ip=$signup=$lastlogin=$notescheck=$activated='';
    $avatar=null;
    $profileLink = '';

$loginLink = '<ul class="nav navbar-nav navbar-right"><li><a href="login.php"><span class="glyphicon glyphicon-log-in"> Login</span></a></li><li><a href="signup.php"><span class="glyphicon glyphicon-user"> SignUp</span></a></li></ul>';
$u = '';
$join_login_btns = ' <button class="btn btn-default" onclick="signup()">Sign UP</button> <button class="btn btn-default" onclick="login()">Log In</button>';
//if (isset($_SESSION['username'])) {
    if (isset($_SESSION['email'])) {
    $profileLink = ' <li><a href="profile.php"><span class="glyphicon glyphicon-shopping-notification">Profile</span></a></li>';

   $e = htmlentities($_SESSION['email']);
   $sql = "SELECT * FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($db_connection,$sql);

    while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
     $id = $row['id'];
     $username = $row['username'];
     $email = $row['email'];
    $phone = $row['phone'];
    $db_gender = $row['gender'];
    $userlevel = $row['userlevel'];
     $description = $row['description'];
    $country = $row['country'];
    $county_or_state = $row['county_or_state'];
    $userlevel = $row['userlevel'];
    $avatar = $row['avatar'];
    $ip = $row['ip'];
    $signup = $row['signup'];
    $gender = $row['notescheck'];
    $activated = $row['activated'];

    }

    if ($avatar == null) {
    $loginLink = '<ul class="nav navbar-nav navbar-right"><li><a href="profile.php"><span class="glyphicon glyphicon-user"> ' .$username.'</span></a></li><li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li></ul>';
    }else{

    $loginLink = '<ul class="nav navbar-nav navbar-right"><li><a href="profile.php"><img src="user/'.$username.'/'.$avatar.'" alt="'.$username.' img not found" width="50px" height="50px" style="border-radius:3px;margin-right:5px;"> '.$username.'</a></li><li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li></ul>';
    }
  $join_login_btns = '';
}else{
  $activated = 'session username unavailable';
}

?>