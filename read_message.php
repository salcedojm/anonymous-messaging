<?php
	session_start();
	require "dbconnect.php";
	if(!isset($_SESSION['currentUsername']))
	{
		header("location:index.php");
	}
  $message_id=$_GET['message_id'];
  $user_id=$_SESSION['currentId'];
  $sql="SELECT * FROM messages WHERE id=$message_id AND message_to=$user_id";
  $result=$conn->query($sql);
  $message=$result->fetch_assoc();
  $sql="UPDATE messages SET status='SEEN' WHERE id=$message_id AND message_to=$user_id";
  $conn->query($sql);
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
          <a style='font-size:12px;' class="navbar-brand" href="#"><?php echo $_SESSION['currentLastname'].", ".$_SESSION['currentFirstname']; ?> | #MessageYourCrush</a>
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4><span class='glyphicon glyphicon-envelope'></span> READ MESSAGE</h4><hr>
          <h4>DATE: <?php echo @$message['date_sent']; ?></h4>
          <h4>MESSAGE: </h4>
          <textarea class="form-control" style="width:98%; font-size:20px;" rows="10" readonly=""><?php echo @$message['message_body']; ?></textarea>
      </div>
    </div>
  </body>
</html>
