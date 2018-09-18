<?php
$db_host = 'localhost';
$db_port = '3306';
$db_username = 'ovicko_admin';
$db_password = '2103@Theadmin';
$db_primaryDatabase = 'db_lyfey_v1';

// Connect to the database, using the predefined database variables in /assets/repository/mysql.php
$dbConnection = new mysqli($db_host, $db_username, $db_password, $db_primaryDatabase);

// If there are errors (if the no# of errors is > 1), print out the error and cancel loading the page via exit();
if (mysqli_connect_errno()) {
    printf("Could not connect to MySQL databse: %s\n", mysqli_connect_error());
    die("Hey check your ass");
}
$query1 = "CREATE TABLE `business_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$query2 = "CREATE TABLE `business_listing` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `website` varchar(255) NOT NULL,
  `established_year` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `emp_range` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `schedule` text NOT NULL,
  `products` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


$query3 = "CREATE TABLE `job_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$query4 = "CREATE TABLE `job_listing` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_added` datetime NOT NULL,
  `category` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `published` varchar(100) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


CREATE TABLE `project_ask`.`app_likes` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `item_id` INT NOT NULL , `item_type` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

	//$result = mysqli_query($dbConnection, $query);
	if ($dbConnection->query($query1)) {
		echo "\nGreat 1";
	} else {
		echo "\nOops 1";
	}

	// if ($dbConnection->query($query2)) {
	// 	echo "\nGreat 2";
	// } else {
	// 	echo "\nOops 2";
	// }

	// if ($dbConnection->query($query3)) {
	// 	echo "\nGreat 3";
	// } else {
	// 	echo "\nOops 3";
	// }

	// if ($dbConnection->query($query4)) {
	// 	echo "\nGreat 4";
	// } else {
	// 	echo "\nOops 4";
	// }
	
drop table if exists `auth_assignment`;
drop table if exists `auth_item_child`;
drop table if exists `auth_item`;
drop table if exists `auth_rule`;

create table `auth_rule`
(
`name` varchar(64) not null,
`data` text,
`created_at` integer,
`updated_at` integer,
    primary key (`name`)
) engine InnoDB;

create table `auth_item`
(
`name` varchar(64) not null,
`type` integer not null,
`description` text,
`rule_name` varchar(64),
`data` text,
`created_at` integer,
`updated_at` integer,
primary key (`name`),
foreign key (`rule_name`) references `auth_rule` (`name`) on delete set null on update cascade,
key `type` (`type`)
) engine InnoDB;

create table `auth_item_child`
(
`parent` varchar(64) not null,
`child` varchar(64) not null,
primary key (`parent`, `child`),
foreign key (`parent`) references `auth_item` (`name`) on delete cascade on update cascade,
foreign key (`child`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;

create table `auth_assignment`
(
`item_name` varchar(64) not null,
`user_id` varchar(64) not null,
`created_at` integer,
primary key (`item_name`, `user_id`),
foreign key (`item_name`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;

//select answers in the client_question table
$sql = "SELECT `id`,`answered_by`,`question_answer`,UNIX_TIMESTAMP(`answer_date`) FROM `client_question` WHERE 1 AND TRIM(IFNULL(`question_answer`,\'\')) <> \'\'";
//raw sql
SELECT `id`,`answered_by`,`question_answer`,UNIX_TIMESTAMP(`answer_date`) FROM `client_question` WHERE 1 AND TRIM(IFNULL(`question_answer`,'')) <> ''

//move question answers
INSERT INTO question_answer(`question_id`,`user_id`,`answer_content`,`answer_date`) SELECT `id`,`answered_by`,`question_answer`,UNIX_TIMESTAMP(`answer_date`) FROM `client_question` WHERE 1 AND TRIM(IFNULL(`question_answer`,'')) <> ''

INSERT INTO question_answer(  `question_id` ,  `user_id` ,  `answer_content` ,  `answer_date` ) 
SELECT  `id` ,  `answered_by` ,  `question_answer` , UNIX_TIMESTAMP(  `answer_date` ) 
FROM  `client_question` 
WHERE 1 
AND TRIM( IFNULL(  `question_answer` ,  '' ) ) <>  ''
?>