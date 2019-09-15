<?php
  include_once("php_includes/db_connection.php");
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
  $username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
  $sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
      echo '<strong style="color:#F00;">Username must be between 3 - 16 characters please</strong>';
      exit();
    }
  if (is_numeric($username[0])) {
      echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
      exit();
    }
    if ($uname_check < 1) {
      echo '<strong style="color:#009900;">' . $username . ' is available :)</strong>';
      exit();
    } else {
      echo '<strong style="color:#F00;">' . $username . ' is taken :(</strong>';
      exit();
    }
}
?>
<?php
// Ajax calls this EMAIL CHECK code to execute
if(isset($_POST["emailcheck"])){
  $email = mysqli_real_escape_string($db_connection,$_POST['emailcheck']);
  $sql = "SELECT id FROM users WHERE email='$email' LIMIT 1";
    $query = mysqli_query($db_connection, $sql); 
    $email_check = mysqli_num_rows($query);
    if (strlen($email) < 3 || strlen($email) > 50) {
      echo '<strong style="color:#F00;">Email must be between 5 - 50 characters please</strong>';
      exit();
    }
  if (is_numeric($email[0])) {
      echo '<strong style="color:#F00;">Email must begin with a letter</strong>';
      exit();
    }
    if ($email_check < 1) {
      echo '<strong style="color:#009900;">' . $email . ' is available :)</strong>';
      exit();
    } else {
      echo '<strong style="color:#F00;">' . $email . ' is taken :(</strong>';
      exit();
    }
}
?>