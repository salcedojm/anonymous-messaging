<?php
	session_start();
	require "dbconnect.php";
	if(!isset($_SESSION['currentUsername']))
	{
		header("location:index.php");
	}
	$currentUser=$_SESSION['currentUsername'];
	$sql="SELECT * FROM messages WHERE message_to='$currentUser' AND status='UNREAD'";
	$result=$conn->query($sql);
	$unread=$result->num_rows;
	$sql="SELECT * FROM messages WHERE message_to='$currentUser'";
	$result=$conn->query($sql);
	$all_message=$result->num_rows;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['currentUsername']; ?> | ANONYMOUS MESSAGING</title>
</head>
<body>
HELLO <?php echo $_SESSION['currentFirstname']." ".$_SESSION['currentLastname']; ?>
<br>
<a href="messages.php">INBOX (<?php echo "$all_message MESSAGE(S), $unread UNREAD";?>)</a>
<br>
<form method="POST">
	<input type="text" name="searchString">
	<br>
	<input type="submit" name="searchBtn" value="SEARCH PERSON">
</form>
<?php
	if(isset($_POST['searchBtn']))
	{
		$search=$_POST['searchString'];
		$sql="SELECT * FROM users WHERE username LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			echo "<table border=1 cellpadding=3>";
			while($row=$result->fetch_assoc())
			{
				$username=$row['username'];
				echo "<tr>";
				echo "<td>".$row['firstname']."</td>";
				echo "<td>".$row['lastname']."</td>";
				echo "<td><a href='send-message.php?username=$username'>SEND MESSAGE</a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "NO RESULTS";
		}
	}
?>
</body>
</html>