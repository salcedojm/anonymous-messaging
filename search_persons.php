<?php
	require "dbconnect.php";
	$filter=$_POST['q'];
	$sql="SELECT * FROM users WHERE firstname LIKE '%$filter%' OR lastname LIKE '%$filter%'";
	$result=$conn->query($sql);
	echo json_encode($result->fetch_assoc());
?>