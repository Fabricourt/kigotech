<?php
$server = 'localhost';
$host_username = 'root';
$host_password = '';
$host_database = 'kigotech_db';
$db_connection = mysqli_connect($server,$host_username,$host_password,$host_database);
if (mysqli_connect_errno()) {
	echo '<script>var db = "'.$host_database.'"; alert("error connecting to "+db.toUpperCase()+" , check if "+db.toUpperCase()+" exists and is well configured");</script>'.$host_database;
	exit();
}
?>