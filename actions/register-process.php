<?php
	//SO SLOWWWWWW.....
	session_start();
	require "../dbconnect.php";
	$query=$conn->prepare("INSERT INTO 
		users(firstname, lastname, username, password)
		VALUES(?,?,?,?)");
	$query->bind_param("ssss",$firstname, $lastname, $username, $password);
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$query->execute();
	header("location: ../index.php");
?>