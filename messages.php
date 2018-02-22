<?php
	require "dbconnect.php";
	session_start();
	if(!isset($_SESSION['currentUsername']))
	{
		header("location:index.php");
	}
	$currentUser=$_SESSION['currentUsername'];
	if(isset($_GET['delete_id']))
	{
		$sql="DELETE FROM messages WHERE id=".$_GET['delete_id']." AND message_to='$currentUser'";
		$conn->query($sql);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div style="width: 32%;display: inline-block; border: 2px solid black; padding: 2px; height: 90vh; overflow-y: scroll;">
	<?php
		$sql="SELECT * FROM messages WHERE message_to='$currentUser'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			echo 
			"<table border=1>
			<tr>
				<td>MESSAGE</td>
				<td>DATE</td>
				<td>ACTION</td>
			</tr>";
			while($row=$result->fetch_assoc())
			{
				$message=substr($row['message_body'],0, 20)."...";
				$date=$row['date_sent'];
				$id=$row['id'];
				echo
				"<tr>
					<td>$message</td>
					<td>$date</td>
					<td>
						<a href=messages.php?read_id=$id>READ</a>
						<a href=messages.php?delete_id=$id>DELETE</a>
					</td>
				</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "NO MESSAGE(S)";
		}
	?>
</div>
<div style="width: 66%;display: inline-block; border: 2px solid black;vertical-align: top; padding: 5px;">
	<?php
		if(isset($_GET['read_id']))
		{
			$sql="SELECT * FROM messages WHERE message_to='$currentUser' AND id=".$_GET['read_id'];
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			echo $row['message_body']."<br>DATE SENT: ".$row['date_sent'];
		}
	?>
</div>
</body>
</html>