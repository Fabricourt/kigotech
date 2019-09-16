-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2019 at 04:53 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kigotech_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockedusers`
--

CREATE TABLE `blockedusers` (
  `id` int(11) NOT NULL,
  `blocker` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `blockee` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `blockdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `commented_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `code` text COLLATE utf8_unicode_ci,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `answer_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `commented_by`, `comment`, `code`, `comment_date`, `answer_id`, `quiz_id`) VALUES
(1, 'Georgemonk', 'comment', 'comment code', '2018-10-29 21:51:36', 6, 2),
(2, 'victor', 'Thats what I\'ll be looking at in our next tutorial', '', '2018-11-04 15:22:14', 7, 15),
(3, 'Georgemonk', 'hi Elizabeth. you wanted to configure my.ini file?', '', '2018-11-05 13:50:41', 8, 15),
(4, 'Elizabethmwania', 'Hi too ,,, I wanted the code that I have send to be edited to obtain minimal execution time', '', '2018-11-05 13:55:34', 8, 15),
(5, 'Elizabethmwania', 'Here', ' SELECT SQL_NO_CACHE * FROM actor\n    LEFT OUTER JOIN film_actor USING(actor_id)\n     LEFT OUTER JOIN film USING(film_id)\n     WHERE actor_id &lt;=(SELECT MAX(actor.actor_id) FROM actor)\n     AND film.description Not like \'% thought%\'\n     ORDER BY actor.first_name, actor.last_name;\n', '2018-11-05 13:56:38', 8, 15),
(6, 'Georgemonk', 'let me test your query and I\'ll get back to you shortly', '', '2018-11-05 13:58:23', 8, 15),
(7, 'Georgemonk', 'I will remove this post and post it as a new question Liz since its not related to the question above your were not supposed to add it as a reply  to the above question on how to  create a signup form with php. To post a new question you were supposed to scroll down to the question post section where you would found \'click here to post your question link\'. so for consistency I\'ll delete this post and post it again.', '', '2018-11-05 14:07:05', 8, 15),
(8, 'Georgemonk', 'Try creating INDEX on the actor_id as below', 'CREATE INDEX my_index_name\nON actor(actor_id); ', '2018-11-05 14:32:09', 10, 24),
(9, 'Georgemonk', 'If you want your index to work also remove LIKE %thought%. See the query below', '  SELECT * FROM actor\n    LEFT OUTER JOIN film_actor USING(actor_id)\n     LEFT OUTER JOIN film USING(film_id)\n     WHERE actor_id &lt;=(SELECT MAX(actor.actor_id) FROM actor)\n    ORDER BY actor.first_name, actor.last_name;', '2018-11-05 14:37:58', 10, 24),
(10, 'Elizabethmwania', 'Thanks monk ,, what if I want to tune the query ,,,is it the same??  Just from the above query', '', '2018-11-06 05:42:47', 10, 24),
(11, 'Lykie', 'link for more information on database connection using php: http://masenocommunity.000webhostapp.com/index.php?linkId=11', '', '2018-11-28 03:09:19', 13, 26),
(12, 'Lykie', 'for more information on how to backup database go to : https://web.archive.org/web/20160121160157/http://www.php-mysql-tutorial.com/wikis/mysql-tutorials/using-php-to-backup-mysql-databases.aspx', '', '2018-11-28 03:23:04', 15, 26),
(13, 'Lykie', 'Format for mysqldump is mysqldump ---user [user name] ---password=[password]  \n[database name] &gt; [dump file]\nwhere: user is the username of your server in xampp the default is root;\n             password for your server, in xampp the default is empty string;\n             database name of the db you want to backup and finally;\n             dump file which is the directory where you want to create the backup', '', '2018-11-28 03:37:01', 14, 26),
(14, 'georgekanage', 'nice answer', '', '2019-08-15 15:15:35', 16, 27);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `initiator` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `app` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `did_read` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programming_answers`
--

CREATE TABLE `programming_answers` (
  `id` int(11) NOT NULL,
  `answered_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci,
  `code` text COLLATE utf8_unicode_ci,
  `views` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `answer_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quiz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `programming_answers`
--

INSERT INTO `programming_answers` (`id`, `answered_by`, `answer`, `code`, `views`, `likes`, `answer_date`, `quiz_id`) VALUES
(7, 'victor', 'How can one create a form using javascript and php', '', 0, 0, '2018-11-04 15:19:25', 15),
(8, 'Elizabethmwania', ' \nEdit the query below  to obtain minimal time execution\n\nSELECT SQL_NO_CACHE * FROM actor\n    LEFT OUTER JOIN film_actor USING(actor_id)\n     LEFT OUTER JOIN film USING(film_id)\n     WHERE actor_id &lt;=(SELECT MAX(actor.actor_id) FROM actor)\n     AND film.description Not like \'% thought%\'\n     ORDER BY actor.first_name, actor.last_name;\n', '', 0, 0, '2018-11-05 13:32:52', 15),
(10, 'Georgemonk', 'Remove the SQL_NO_CACHE and your question will minimize its execution time. This is because the query will be fetch from the memory CACHE instead of being loaded from the disk which is much slower. Also consider INDEXing your colums. ', ' SELECT * FROM actor\n    LEFT OUTER JOIN film_actor USING(actor_id)\n     LEFT OUTER JOIN film USING(film_id)\n     WHERE actor_id &lt;=(SELECT MAX(actor.actor_id) FROM actor)\n     AND film.description Not like \'% thought%\'\n     ORDER BY actor.first_name, actor.last_name;', 0, 0, '2018-11-05 14:27:18', 24),
(11, 'Georgemonk', 'To shrink database just type the command below. x is the amount of space in megabytes you want to allocate your shrunk db. ', ' USE YourDatabase;\nGO\nDBCC SHRINKFILE (DataFile1, x);\nGO', 0, 0, '2018-11-14 16:09:37', 25),
(12, 'Georgemonk', 'And finaly, write the script below to rebuild your indexes ', ' USE YourDBName\n\nDECLARE @TbName VARCHAR(255)\nDECLARE @FullTbName VARCHAR(255)\nDECLARE @IxName VARCHAR(255)\nDECLARE myCursor CURSOR FOR\n    SELECT OBJECT_NAME(dmi.object_id) AS TableName,i.name AS IndexName\n    FROM sys.dm_db_index_physical_stats(14, NULL, NULL, NULL , \'LIMITED\') dmi\n    JOIN  sys.indexes i on dmi.object_id = i.object_id and dmi.index_id = i.index_id\n    WHERE avg_fragmentation_in_percent &gt; 30\n    ORDER BY avg_fragmentation_in_percent\nOPEN myCursor\nFETCH NEXT FROM myCursor INTO @TbName, @ixName\nWHILE @@FETCH_STATUS = 0\nBEGIN\n    IF EXISTS(SELECT * FROM INFORMATION_SCHEMA.TABLES  WHERE TABLE_SCHEMA = \'dba\' AND TABLE_NAME = @TbName)\nBEGIN\n        SET @FullTbName = \'dba.\'   @TbName\n        IF (@ixName IS NULL)\n        BEGIN\n            PRINT \'Reindexing Table \'   @FullTbName\n            DBCC DBREINDEX(@FullTbName, \'\', 0)\n        END\n        ELSE\n        BEGIN\n             PRINT \'Reindexing Table \'   @FullTbName   \', Index \'   @IxName\n             DBCC DBREINDEX(@FullTbName, @IxName, 0)\n        END\n    END\n    FETCH NEXT FROM myCursor INTO @TbName, @ixName\nEND\nCLOSE myCursor\nDEALLOCATE myCursor', 0, 0, '2018-11-14 16:10:31', 25),
(13, 'Lykie', 'Am going to create a database backup using php and system() function. The first thing you need before creating a database back up si the database itself, so first we will create a new database and a table to work on. After creating a database (in my case am using db named school_db although you can use any database of choice). The code below will create a database backup database named school_db_backup001.sql in my db_backups folder located in disk partition H:/ in my computer. The label of the disk is new volume but it doesn\'t matter what your disk label is, it can be any name, the only important thing is the drive letter. create new folder in any drive and name it as \'db_backups\' in your drive root directory. This is where we are going to place our database backup, if you are working on online server, you need to know the url of your dist location and replace the \'backupFile\' with the url. But first lets connect to our database using the code below, if you don\'t know how to create a database connection using php you copy paste this link in your browser for more information. I have my database on local server so am going to connect to it via local host with the default username (root) and no password.', '&lt;?php\n$server = \'localhost\';\n$server_username = \'root\';\n$server_password = \'\';\n$database = \'school_db\';\n\n$connection = mysqli_connect($server,$server_username,$server_password,$database);\n\nif (mysqli_connect_errno()) {\n	echo &quot;&lt;script&gt;alert(\'database connection failed, check if database exists and the server is started\');&lt;/script&gt;&quot;;\n}else{\n	echo &quot;&lt;script&gt;alert(\'database connection successful\');&lt;/script&gt;&quot;;\n}\n?&gt;', 0, 0, '2018-11-28 03:07:10', 26),
(14, 'Lykie', 'Now lets backup our db using the code below', '&lt;?php\n$backupFile = \'H:/db_backups/school_db_backup001.sql\';\n$command = &quot;mysqldump -u $server_username -p$server_password $dbname &gt; $backupFile&quot;;\n$results = system($command);\n\nif ($results) {\n	echo &quot;backup successful&quot;;\n}else{\n	echo &quot;backup failed&quot;;\n}\n?&gt;', 0, 0, '2018-11-28 03:11:06', 26),
(15, 'Lykie', 'Finally use this code to archive your tables. But you\'ll need to create a new tables with the same column names and types as the tables you want to archive. In my case, am creating a backup for my table students and sending it to another table named student_archive table in the same database(school_db)', '&lt;?php\n//create table backup\n$tableName  = \'students\';\n$backupFile = \'H:/db_backups/students.sql\';\n$query      = &quot;SELECT * INTO OUTFILE \'$backupFile\' FROM $tableName&quot;;\n$result = mysqli_query($connection,$query);\nif ($result) {\n	echo &quot;backup successful&quot;;\n}else{\n	echo &quot;backup failed&quot;;\n}\n//finally send the data to archive\n\n$tableName  = \'students_archive\';\n$backupFile = \'H:/db_backups/students.sql\';\n$query      = &quot;LOAD DATA INFILE \'$backupFile\' INTO TABLE $tableName&quot;;\n$result = mysqli_query($connection,$query);\nif ($result) {\n	echo &quot;archive successful&quot;;\n}else{\n	echo &quot;archive failed&quot;;\n}\n?&gt; ', 0, 0, '2018-11-28 03:19:00', 26),
(16, 'georgekanage', 'html is hypertext markup language used to create webpages', '&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n&lt;head&gt;\n	&lt;title&gt;CK Editor&lt;/title&gt;\n	&lt;script type=&quot;text/javascript&quot; src=&quot;ckeditor/ckeditor.js&quot;&gt;&lt;/script&gt;\n&lt;/head&gt;\n&lt;body&gt;\n&lt;form action=&quot;&quot;&gt;\n	\n&lt;/form&gt;\n&lt;/body&gt;\n&lt;/html&gt;', 0, 0, '2019-08-15 15:15:10', 27),
(17, 'georgekanage', 'Another one', '', 0, 0, '2019-09-09 16:58:18', 27);

-- --------------------------------------------------------

--
-- Table structure for table `programming_quizes`
--

CREATE TABLE `programming_quizes` (
  `id` int(11) NOT NULL,
  `asked_by` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `question` varchar(255) NOT NULL,
  `description` text,
  `code` text,
  `views` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `ask_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `answer_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programming_quizes`
--

INSERT INTO `programming_quizes` (`id`, `asked_by`, `category`, `question`, `description`, `code`, `views`, `likes`, `ask_date`, `answer_count`) VALUES
(9, 'Georgemonk', 'html', 'Introduction', 'we are going to have series of tutorial from various programming languages, but mostly we are going to do website design. For this semester we decided to do a school management system, which is a fancy name for student portal. This project we did it last semester but we programmed it in java, now we are going to program the same with php and javascript. We are going to start with local server configuration i.e. installing apache on our computers. We will use Xampp or Wamp in this project', '', 0, 0, '2018-11-01 11:21:04', 0),
(10, 'Georgemonk', 'php', 'How to install Xampp or Wamp', 'Go to your browser and type Xampp download, click the first download link that appers. Mostly this will be from apache friends site <a href=\"https://www.apachefriends.org/download.html\">xampp download</a>. After downloading the setup, double click on it to install. You will get variety of options and pop up, just say yes to everything and click on next to install. After installation the default install location for Xampp is C://xampp. Go to c://xampp/htdocs folder to save your projects.', '', 0, 0, '2018-11-01 11:27:07', 0),
(11, 'Georgemonk', 'php', 'How to create a database connection using php.', 'In the previous lesson we learned how to install xampp server on our computer. Php usually goes to htdocs to since its the default location where we save our projects so that apache can interpret the php. The first thing we are going to do is create a folder in  htdocs and name it as \'maseno student portal\' the in that folder create another folder called \'back_end\' this is the folder that will contain all the php proccessing, it will handle the back end of our website. In the back_end folder create db_connections.php file and paste the code below to connect to the database. But something you have to note is that php cannot connect to non-existing db. That is to say that you need to create your database first before trying to connect to it. so open xampp, start apache and mysql then click on admin on the mysql row. This will open your default browser and take you to the phpMyAdmin page. Or you can start you xampp then go to your browser the type \'localhost\' without the quotes it will take you to dashboard, click on phpMyAdmin from there and create a new database named maseno_student_portal_db', '&lt;?php\n$server = \'localhost\';\n$server_username = \'root\';\n$server_password = \'\';\n$database = \'maseno_student_portal_db\';\n\n$connection = mysqli_connect($server,$server_username,$server_password,$database);\n\nif (mysqli_connect_errno()) {\n	echo &quot;&lt;script&gt;alert(\'database connection failed, check if database exists and the server is started\');&lt;/script&gt;&quot;;\n}\n?&gt;', 0, 0, '2018-11-01 11:41:45', 0),
(12, 'Georgemonk', 'php', 'use php to create sql databases ', 'Now that we have created database connection we need to include it in our make_db_tables file, so in the same folder we created db_connection.php - back_end - create new file called make_db_tables.php. Make sql table using the code below, just copy paste it into this file. In this code, we first we start by defining the sql statement and then passing it to mysqli_query to be processed. mysqli_query is a php function that takes as argument the db_connection and your sql statement. The first table we create is students and lecturer, this is where we are going to put their personal details after signup. If the code doesnt work for you for any reason or you have something you want to clerify about it just leave a reply below and al get back at you as soon as I can.', '&lt;?php\ninclude_once(&quot;db_connection.php&quot;);//calls database connection\n?&gt;\n&lt;?php\n//define sql query\n$sql = &quot;CREATE TABLE IF NOT EXISTS students(\nadm_no VARCHAR(255) NOT NULL,\nPRIMARY KEY(adm_no),\nname VARCHAR(255) NOT NULL,\nage INT(11) NOT NULL,\ngender ENUM(\'m\',\'f\') NULL,\nid_no INT(11) NULL,\nemail VARCHAR(255) NULL,\njoin_date DATETIME DEFAULT now(),\nlast_login DATETIME NULL,\npassword VARCHAR(255) NOT NULL,\nphoto  VARCHAR(255) NULL)&quot;;\n\n$query = mysqli_query($connection,$sql);\n\nif ($query) {\n	echo &quot;&lt;h1&gt;students table created successfully&lt;/h1&gt;&quot;;\n}else{\n		echo &quot;&lt;h1&gt;students table not created &lt;/h1&gt;&quot;;\n}\n\n##################################################################################\n//create lec table\n$sql = &quot;CREATE TABLE IF NOT EXISTS lectures(\nlec_no VARCHAR(255) NOT NULL,\nPRIMARY KEY(lec_no),\nname VARCHAR(255) NOT NULL,\ngender ENUM(\'m\',\'f\') NULL,\nid_no INT(11) NULL,\nemail VARCHAR(255) NULL,\nemployment_date DATETIME DEFAULT now(),\nlast_login DATETIME NULL,\npassword VARCHAR(255) NOT NULL,\nphoto  VARCHAR(255) NULL)&quot;;\n\n$query = mysqli_query($connection,$sql);\n\nif ($query) {\n	echo &quot;&lt;h1&gt;lectures table created successfully&lt;/h1&gt;&quot;;\n}else{\n		echo &quot;&lt;h1&gt;lectures table not created &lt;/h1&gt;&quot;;\n}\n?&gt;', 0, 0, '2018-11-01 15:20:21', 0),
(13, 'Georgemonk', 'bootstrap', 'How to intergrate bootstrap into your website', ' If you are going to upload your website to an online server, include the bootsrap folder as shown below to get the framework from maxcdn.\r\n\r\n\r\nFor offline go to bootstrap website and download the zip file, unzip and you will find two folders inside i.e. css and js download <a href=\"https://getbootstrap.com/\">bootstrap here</a>. Now we are going to use this framework to create our website fron_end. Go to your maseno student portal folder and create a new folder name fron_end inside this folder create another named assets. Now we are going to put our bootstrap framework in here. Copy and paste your bootstrap css and js here and you are good to go.\r\n  Include the two line below in you other files to include bootstrap offline', '//include this in the header section of your html	\r\n//bootstrap online\r\n\r\n    &lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css&quot;&gt;\r\n    &lt;script src=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js&quot;&gt;&lt;/script&gt;\r\n\r\n//bootstrap offline\r\n\r\n\r\n      &lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;assets/css/bootstrap.min.css&quot;&gt;\r\n	&lt;script type=&quot;text/javascript&quot; src=&quot;assets/js/bootstrap.min.js&quot;&gt;&lt;/script&gt;\r\n', 0, 0, '2018-11-01 16:11:42', 0),
(14, 'Georgemonk', 'bootstrap', 'How to create a signup page using bootstrap and HTML', 'The first thing we are going to do is create an admin folder inside the front_end that we created in the previous tutorial. Now Inside the admin folder create student_registration.php. This form will take all the student registration data and send it to php for processing.', '&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n&lt;head&gt;\n	&lt;title&gt;student registration form&lt;/title&gt;\n	&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;../assets/css/bootstrap.min.css&quot;&gt;\n	&lt;script type=&quot;text/javascript&quot; src=&quot;../assets/js/bootstrap.min.js&quot;&gt;&lt;/script&gt;\n\n	&lt;style type=&quot;text/css&quot;&gt;\n		#body{\n			width: 60%;\n			margin: auto;\n			margin: 20px;\n		}\n		h1{\ncolor: dodgerblue;\n		}\n	&lt;/style&gt;\n&lt;body&gt;\n&lt;div class=&quot;container&quot;&gt;\n&lt;div class=&quot;row&quot;&gt;\n	\n	&lt;h1&gt;Welcome to maseno student portal registration&lt;/h1&gt;\n	&lt;div id=&quot;body&quot;&gt;\n		&lt;h4&gt;Register students here&lt;/h4&gt;\n		&lt;form action=&quot;student_registration.php&quot; method=&quot;POST&quot; class=&quot;form-group&quot;&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;adm_no&quot;&gt;Adm no: &lt;/label&gt;\n				&lt;input type=&quot;text&quot; name=&quot;adm_no&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;name&quot;&gt;Name: &lt;/label&gt;\n				&lt;input type=&quot;text&quot; name=&quot;name&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;age&quot;&gt;Age: &lt;/label&gt;\n				&lt;input type=&quot;number&quot; name=&quot;age&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;=gender&quot;&gt;Gender: &lt;/label&gt;\n				&lt;select class=&quot;form-control&quot; name=&quot;gender&quot;&gt;\n					&lt;option value=&quot;&quot;&gt;&lt;/option&gt;\n					&lt;option value=&quot;m&quot;&gt;Male&lt;/option&gt;\n					&lt;option value=&quot;f&quot;&gt;Female&lt;/option&gt;\n				&lt;/select&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;name&quot;&gt;Email: &lt;/label&gt;\n				&lt;input type=&quot;text&quot; name=&quot;email&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;name&quot;&gt;Id NO: &lt;/label&gt;\n				&lt;input type=&quot;number&quot; name=&quot;id_no&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;epassword&quot;&gt;password: &lt;/label&gt;\n				&lt;input type=&quot;password&quot; name=&quot;epassword&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;cpassword&quot;&gt;confirm password: &lt;/label&gt;\n				&lt;input type=&quot;password&quot; name=&quot;cpassword&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;create account&quot; class=&quot;btn btn-default&quot;&gt;\n			&lt;/div&gt;\n		&lt;/form&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/body&gt;\n&lt;/html&gt;', 0, 0, '2018-11-01 18:33:44', 0),
(15, 'Georgemonk', 'php', 'How to create a signup form with php', 'The previous tutorial I showed you how to make a raw form using Bootstrap and HTML. I this tutorial we are going to see how we can take the details that we entered in our form, validate them and send them to php for processing. So first we create the php code inside the &lt;?php  ?&gt; tags, then we include the database connection we created in the back_end to connect to the database. after that we check if the submit button is clicked throught php isset() function, and if the function returns true we take the values from our form using the $_POST[ ] method since this is the one we used to submit our form data. If the form contains data, we sanitise them data to remove through htmlentities() any malicious code that the user may have input. This converts all the html entities such as &lt;, &gt; to their equivalent values i.e. ', '&lt;?php\ninclude_once(&quot;../../back_end/db_connection.php&quot;);//calls database connection\n\nif (isset($_POST[\'submit\'])) {\n\n	$adm_no = mysqli_real_escape_string($connection,htmlentities($_POST[\'adm_no\']));\n	$name = mysqli_real_escape_string($connection,htmlentities($_POST[\'name\']));\n	$age = $_POST[\'age\'];\n	$gender = $_POST[\'gender\'];\n	$id_no = $_POST[\'id_no\'];\n	$email = $_POST[\'email\'];\n	$password = md5(htmlentities($_POST[\'epassword\']));\n\n	$sql = &quot;INSERT INTO students(adm_no,name,age,gender,id_no,email,password)\n	VALUES(\'$adm_no\',\'$name\',\'$age\',\'$gender\',\'$id_no\',\'$email\',\'$password\')&quot;;\n\n\n	$query = mysqli_query($connection,$sql);\n	if ($query) {\n		echo &quot;registration successfull&quot;;\n	}else{\n		echo &quot;registration not successfull&quot;;\n	}\n}\n?&gt;\n&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n&lt;head&gt;\n	&lt;title&gt;student registration form&lt;/title&gt;\n	&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;../assets/css/bootstrap.min.css&quot;&gt;\n	&lt;script type=&quot;text/javascript&quot; src=&quot;../assets/js/bootstrap.min.js&quot;&gt;&lt;/script&gt;\n\n	&lt;style type=&quot;text/css&quot;&gt;\n		#body{\n			width: 60%;\n			margin: auto;\n			margin: 20px;\n		}\n		h1{\ncolor: dodgerblue;\n		}\n	&lt;/style&gt;\n&lt;body&gt;\n&lt;div class=&quot;container&quot;&gt;\n&lt;div class=&quot;row&quot;&gt;\n	\n	&lt;h1&gt;Welcome to maseno student portal registration&lt;/h1&gt;\n	&lt;div id=&quot;body&quot;&gt;\n		&lt;h4&gt;Register students here&lt;/h4&gt;\n		&lt;form action=&quot;student_registration.php&quot; method=&quot;POST&quot; class=&quot;form-group&quot;&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;adm_no&quot;&gt;Adm no: &lt;/label&gt;\n				&lt;input type=&quot;text&quot; name=&quot;adm_no&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;name&quot;&gt;Name: &lt;/label&gt;\n				&lt;input type=&quot;text&quot; name=&quot;name&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;age&quot;&gt;Age: &lt;/label&gt;\n				&lt;input type=&quot;number&quot; name=&quot;age&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;=gender&quot;&gt;Gender: &lt;/label&gt;\n				&lt;select class=&quot;form-control&quot; name=&quot;gender&quot;&gt;\n					&lt;option value=&quot;&quot;&gt;&lt;/option&gt;\n					&lt;option value=&quot;m&quot;&gt;Male&lt;/option&gt;\n					&lt;option value=&quot;f&quot;&gt;Female&lt;/option&gt;\n				&lt;/select&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;name&quot;&gt;Email: &lt;/label&gt;\n				&lt;input type=&quot;text&quot; name=&quot;email&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;name&quot;&gt;Id NO: &lt;/label&gt;\n				&lt;input type=&quot;number&quot; name=&quot;id_no&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;epassword&quot;&gt;password: &lt;/label&gt;\n				&lt;input type=&quot;password&quot; name=&quot;epassword&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;label for=&quot;cpassword&quot;&gt;confirm password: &lt;/label&gt;\n				&lt;input type=&quot;password&quot; name=&quot;cpassword&quot; required=&quot;&quot; class=&quot;form-control&quot;&gt;\n			&lt;/div&gt;\n			&lt;div&gt;\n				&lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;create account&quot; class=&quot;btn btn-default&quot;&gt;\n			&lt;/div&gt;\n		&lt;/form&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/body&gt;\n&lt;/html&gt;', 0, 0, '2018-11-01 18:54:55', 0),
(24, 'Elizabethmwania', 'php', 'Analyse the query below and edit it to obtain minimal execution time', 'Writing query of minimum execution time', ' SELECT SQL_NO_CACHE * FROM actor\n    LEFT OUTER JOIN film_actor USING(actor_id)\n     LEFT OUTER JOIN film USING(film_id)\n     WHERE actor_id &lt;=(SELECT MAX(actor.actor_id) FROM actor)\n     AND film.description Not like \'% thought%\'\n     ORDER BY actor.first_name, actor.last_name;\n', 0, 0, '2018-11-05 14:22:55', 0),
(25, 'Lykie', 'SQL', 'How to right an sql script that automatically :backups the database, archive tables, re-index all tables,  shrink database file, shrink log file,.Every table that has more than 1000 records should be archived .however not all records are archived .use FIF', '', '', 0, 0, '2018-11-11 12:36:12', 0),
(26, 'Elizabethmwania', 'SQL', 'Write an SQL script that does the following automatically;\n1. Backup the database. \n2. Archive tables', '', '', 0, 0, '2018-11-17 20:42:46', 0),
(27, 'georgekanage', 'html', 'what is html?', 'intro to html', '&lt;html&gt;', 0, 0, '2019-08-15 15:13:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `useroptions`
--

CREATE TABLE `useroptions` (
  `id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `useroptions`
--

INSERT INTO `useroptions` (`id`, `username`, `background`, `question`, `answer`, `temp_pass`) VALUES
(2, 'Motari', 'original', NULL, NULL, NULL),
(3, 'victor', 'original', NULL, NULL, NULL),
(4, 'Walter', 'original', NULL, NULL, NULL),
(5, 'Elizabethmwania', 'original', NULL, NULL, NULL),
(6, 'Leon', 'original', NULL, NULL, NULL),
(7, 'Lykie', 'original', NULL, NULL, NULL),
(8, 'Muyundo', 'original', NULL, NULL, NULL),
(9, 'Monk', 'original', NULL, NULL, ''),
(16, 'MonkMchizi', 'original', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('m','f') COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `county_or_state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userlevel` enum('a','b','c','d','e','f') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'f',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signup` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `notescheck` datetime NOT NULL,
  `activated` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `gender`, `description`, `country`, `county_or_state`, `userlevel`, `avatar`, `ip`, `signup`, `lastlogin`, `notescheck`, `activated`) VALUES
(2, 'Motari', 'kephamotari@gmail.com', 0, 'e807f1fcf82d132f9bb018ca6738a19f', 'm', '', 'Kenya', 'Kisumu', 'f', NULL, '41.89.192.2', '2018-10-29 14:00:22', '2018-10-29 14:05:43', '2018-10-29 14:00:22', '1'),
(3, 'victor', 'victormakau97@gmail.com', 0, 'f89a7a9ed62e65b2c8aed08d811ae826', 'm', '', 'Kenya', 'Makueni', 'f', NULL, '154.123.152.112', '2018-11-04 15:17:59', '2018-11-06 05:49:48', '2018-11-04 15:17:59', '1'),
(4, 'Walter', 'walterbirir@gmail.com', 0, '73461aa48fa550bb5c5cbd6db8f94ca0', 'm', '', 'Kenya', 'Uasingishu', 'f', NULL, '154.123.38.107', '2018-11-04 19:00:41', '2018-11-04 19:01:54', '2018-11-04 19:00:41', '1'),
(5, 'Elizabethmwania', 'elizabethmwania257@gmail.com', 0, '96ddcf158bf81d2393d707ab7121f032', 'f', '', 'Kitui', 'Kitui', 'f', NULL, '154.122.168.205', '2018-11-05 13:29:30', '2018-11-17 20:39:44', '2018-11-05 13:29:30', '1'),
(6, 'Leon', 'leonkip254@gmail.com', 0, 'ae291c459e51541a7bc1310bcb15e026', 'm', '', 'Kenya', 'Nairobi', 'f', NULL, '41.89.192.2', '2018-11-06 07:19:43', '2018-11-06 07:20:23', '2018-11-06 07:19:43', '1'),
(7, 'Lykie', 'Jameslykie@gmail.com', 0, '8625692920a2e21f09b7904633272427', 'm', '', 'Kenya', 'Nairobi', 'f', NULL, '154.122.9.102', '2018-11-11 12:07:44', '2018-11-28 02:48:48', '2018-11-11 12:07:44', '1'),
(8, 'Muyundo', 'muyundobrian@gmail.com', 0, '63255d9ed73e647efe7df90d77c381ed', 'm', '', 'Kenya', 'Kisumu', 'f', NULL, '154.123.148.74', '2018-11-14 18:39:46', '2018-11-14 18:40:41', '2018-11-14 18:39:46', '1'),
(9, 'Monk', 'georgekanage97@gmail.com', 778043963, 'dd932190a0ec160ecae0ca46f413aa60', 'm', 'Edited on 11th sept', 'kenya', 'Kiambu', 'a', 'WIN_20190911_15_27_22_Pro.jpg', '1', '2019-08-14 14:00:49', '2019-09-16 17:51:39', '2019-08-14 14:00:49', '1'),
(16, 'MonkMchizi', 'monkmchizi97@gmail.com', 712345679, '5bfe2f44c924cc2df3b655f84d3dc3ad', 'm', 'sfd f', 'Kenya', 'Nairobi', 'f', 'WIN_20190911_15_27_22_Pro.jpg', '127.0.0.1', '2019-09-15 15:35:26', '2019-09-16 11:12:31', '2019-09-15 15:35:26', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockedusers`
--
ALTER TABLE `blockedusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programming_answers`
--
ALTER TABLE `programming_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programming_quizes`
--
ALTER TABLE `programming_quizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useroptions`
--
ALTER TABLE `useroptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blockedusers`
--
ALTER TABLE `blockedusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programming_answers`
--
ALTER TABLE `programming_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `programming_quizes`
--
ALTER TABLE `programming_quizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
