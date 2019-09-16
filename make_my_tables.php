<?php
include_once("php_includes/db_connection.php");
$tbl_users = "CREATE TABLE IF NOT EXISTS users (
			id INT(11) NOT NULL AUTO_INCREMENT,
			username VARCHAR(16) NOT NULL,
			email VARCHAR(255) NOT NULL,
                        phone INT(11) NOT NULL,
			password VARCHAR(255)NOT NULL,
			gender ENUM('m','f') NOT NULL,
			country VARCHAR(255) NOT NULL,
                        `county_or_state` VARCHAR(50) NOT NULL , 
			userlevel ENUM('a','b','c','d','e','f') NOT NULL DEFAULT 'f',
			avatar VARCHAR(255) NULL,
			ip VARCHAR(255) NOT NULL,
			signup DATETIME NOT NULL,
			lastlogin DATETIME NOT NULL,
			notescheck DATETIME NOT NULL,
			activated ENUM('0','1') NOT NULL DEFAULT '1', 
			PRIMARY KEY (id), 
			UNIQUE KEY username (username,email)

								)";
$query = mysqli_query($db_connection, $tbl_users);
if ($query == TRUE) {
	echo "<h3>User table created ok :)</h3>";
}else{

	echo "<h3>User table not created :(</h3>";
}

////////////////////////////////////////////////////////////
$sql = "ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `useroptions`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT";

$query = mysqli_query($db_connection, $sql);
if ($query == TRUE) {
        echo "<h3>Foreign Key added to useroptions :)</h3>";
}else{

        echo "<h3>Foreign Key not added to useroptions :(</h3>";
}
////////////////////////////////////
$tbl_useroptions = "CREATE TABLE IF NOT EXISTS useroptions ( 
                id INT(11) NOT NULL,
                username VARCHAR(16) NOT NULL,
				background VARCHAR(255) NOT NULL,
				question VARCHAR(255) NULL,
				answer VARCHAR(255) NULL,
                                temp_pass VARCHAR(255) NULL,
                PRIMARY KEY (id),
                UNIQUE KEY username (username) 
                )"; 
$query = mysqli_query($db_connection, $tbl_useroptions); 
if ($query === TRUE) {
	echo "<h3>useroptions table created OK :) </h3>"; 
} else {
	echo "<h3>useroptions table NOT created :( </h3>"; 
}
///////////////////////////////////


$tbl_blockedusers = "CREATE TABLE IF NOT EXISTS blockedusers ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                blocker VARCHAR(16) NOT NULL,
                blockee VARCHAR(16) NOT NULL,
                blockdate DATETIME NOT NULL,
                PRIMARY KEY (id) 
                )"; 
$query = mysqli_query($db_connection, $tbl_blockedusers); 
if ($query === TRUE) {
	echo "<h3>blockedusers table created OK :) </h3>"; 
} else {
	echo "<h3>blockedusers table NOT created :( </h3>"; 
}
////////////////////////////////////

///////////////////////////////////////////////////////////////
$tbl_notifications = "CREATE TABLE IF NOT EXISTS notifications ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                username VARCHAR(16) NOT NULL,
                initiator VARCHAR(16) NOT NULL,
                app VARCHAR(255) NOT NULL,
                note VARCHAR(255) NOT NULL,
                did_read ENUM('0','1') NOT NULL DEFAULT '0',
                date_time DATETIME NOT NULL,
                PRIMARY KEY (id) 
                )"; 
$query = mysqli_query($db_connection, $tbl_notifications); 
if ($query === TRUE) {
	echo "<h3>notifications table created OK :) </h3>"; 
} else {
	echo "<h3>notifications table NOT created :( </h3>"; 
}
///////////////////////////////////////////////////////////////
$programming_quizes = "CREATE TABLE IF NOT EXISTS programming_quizes(id INT (11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
asked_by VARCHAR(50) NOT NULL,
category  VARCHAR(20) NOT NULL,
question  VARCHAR(255) NOT NULL,
description  TEXT,
code  TEXT,
views INT DEFAULT '0',
likes INT DEFAULT '0',
ask_date DATETIME NOT NULL DEFAULT now(),
answer_count INT DEFAULT '0')";
$query = mysqli_query($db_connection, $programming_quizes); 
if ($query === TRUE) {
        echo "<h3>programming_quizes table created OK :) </h3>"; 
} else {
        echo "<h3>programming_quizes table NOT created :( </h3>"; 
}
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
$programming_answers = "CREATE TABLE IF NOT EXISTS programming_answers(
id INT (11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
answered_by VARCHAR(50) NOT NULL,
answer  TEXT,
code  TEXT,
views INT DEFAULT '0',
likes INT DEFAULT '0',
answer_date DATETIME NOT NULL DEFAULT now(),
quiz_id INT(11))";
$query = mysqli_query($db_connection, $programming_answers); 
if ($query === TRUE) {
        echo "<h3>programming_answers table created OK :) </h3>"; 
} else {
        echo "<h3>programming_answers table NOT created :( </h3>"; 
}
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
$comments = "CREATE TABLE IF NOT EXISTS comments(
id INT (11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
commented_by VARCHAR(50) NOT NULL,
comment  TEXT,
code  TEXT,
comment_date DATETIME NOT NULL DEFAULT now(),
answer_id INT(11),
quiz_id INT(11))";
$query = mysqli_query($db_connection, $comments); 
if ($query === TRUE) {
        echo "<h3>comments table created OK :) </h3>"; 
} else {
        echo "<h3>comments table NOT created :( </h3>"; 
}
///////////////////////////////////////////////////////////////
