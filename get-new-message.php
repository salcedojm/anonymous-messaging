<?php
require 'dbconnect.php';
	$sql="SELECT * FROM public_messages ORDER BY id LIMIT 1";
	$result=$conn->query($sql);
	$message=$result->fetch_assoc();
	$message_body=$message['message_body'];
	$code_name=$message['code_name'];
	$date_sent=$message['date_sent'];
	if($result->num_rows==0) echo 0;
	else echo json_encode($message);
?>