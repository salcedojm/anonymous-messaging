<?php
	//HAHAHAHAHA TANGINA....

	//SERVER CREDENTIALS
	$server="localhost";
	$username="root";
	$password="jmsalcedo";

	$database="anonymous_messaging";
	$user_table="users";
	$message_table="messages";
	$public_messages="public_messages";
	$db_found=$user_table_found=$message_table_found=$public_messages_table_found=false;
	$conn=new mysqli($server, $username, $password);
	$sql="show databases";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		if($row['Database']===$database){
			$db_found=true;
		}
	}
	if($db_found){
		$conn=new mysqli($server, $username, $password, $database);
	}
	else{
		echo "DATABASE NOT FOUND";
		$sql="CREATE database ".$database;
		$conn->query($sql);
		$conn=new mysqli($server, $username, $password, $database);
	}
	$sql="show tables";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		if($row['Tables_in_anonymous_messaging']===$user_table)
			$user_table_found=true;
		if($row['Tables_in_anonymous_messaging']===$message_table)
			$message_table_found=true;
		if($row['Tables_in_anonymous_messaging']===$public_messages)
			$public_messages_table_found=true;
	}
	if(!$user_table_found)
	{
		$sql="CREATE table users(
			id INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			username VARCHAR(30) NOT NULL,
			password VARCHAR(200) NOT NULL,
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL
		)";
		$conn->query($sql);
	}
	if(!$message_table_found)
	{
		$sql="CREATE table messages(
			id INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			message_body VARCHAR(500) NOT NULL,
			message_to int(5) NOT NULL,
			status VARCHAR(10) NOT NULL,
			message_from int(5) not null,
			date_sent VARCHAR(100) NOT NULL
		)";
		$conn->query($sql);
		echo $conn->error;
	}
	if(!$public_messages_table_found)
	{
		$sql="CREATE table public_messages(
			id INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
			message_body VARCHAR(500) NOT NULL,
			status VARCHAR(10) NOT NULL,
			message_from int(5) not null,
			date_sent VARCHAR(100) NOT NULL,
			code_name VARCHAR(100) NOT NULL
		)";
		$conn->query($sql);
		echo $conn->error;
	}
?>