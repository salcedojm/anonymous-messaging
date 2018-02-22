<?php
	session_start();
	require "dbconnect.php";
	date_default_timezone_set("Asia/Manila");
	if(!isset($_SESSION['currentUsername']))
	{
		header("location:index.php");
	}
	if(isset($_POST['sendbtn']))
	{
		$code_name=$_POST['code_name'];
		$message_body=$_POST['message_body'];
		$status="UNREAD";
        $message_from=$_SESSION['currentId'];
		$send_time=strtoupper(date("l"))." ".strtoupper(date("h:i:s a"));
		$sql="INSERT INTO public_messages(message_body,status, message_from, date_sent, code_name) 
			VALUES('$message_body', '$status', $message_from, '$send_time', '$code_name')";
		$conn->query($sql);
		echo "<script>alert('MESSAGE SENT')</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title><?php echo $_SESSION['currentUsername']; ?> | ANONYMOUS MESSAGING</title>

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style='font-size:12px;	' class="navbar-brand" href="#"><?php echo $_SESSION['currentLastname'].", ".$_SESSION['currentFirstname']; ?> | #MessageYourCrush</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="dashboard.php"><span class='glyphicon glyphicon-inbox'></span> INBOX</a></li>
            <li><a href="send-message.php"><span class='glyphicon glyphicon-pencil'></span> CREATE MESSAGE</a></li>
            <li><a href="public-message.php"><span class='glyphicon glyphicon-globe'></span> PUBLIC MESSAGE</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4><span class='glyphicon glyphicon-pencil'></span> CREATE A PUBLIC MESSAGE</h4><hr>
    	</div>
    	<div class="row">
    		<div class="col-md-12">
    			<form method="POST" class="form-inline">
    				<div class="form-group">
    					<label>CODE NAME: </label>
    					<input type="text" class="form-control" name="code_name" required>
    				</div><br>
    				<label>MESSAGE: </label>
    				<textarea class="form-control" style="width:98%; font-size:20px;" rows="10" required id="message_body" name="message_body"></textarea>
    				<div class="form-group">
    				<input type="reset" value="CLEAR MESSAGE" class="form-control">
    				<input type="submit" id="send_now" name="sendbtn" value="SEND MESSAGE" class="form-control">
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
</div>
  </body>
</html>
