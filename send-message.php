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
		$message_to=$_POST['to_id'];
		$message_body=$_POST['message_body'];
		$message_from=$_SESSION['currentId'];
		$status="UNREAD";
		$send_time=strtoupper(date("l"))." ".strtoupper(date("h:i:s a"));
		$sql="INSERT INTO messages(message_body,message_to,status, message_from, date_sent) 
			VALUES('$message_body', '$message_to', '$status', $message_from, '$send_time')";
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
            <li><a href="#"><span class='glyphicon glyphicon-pencil'></span> CREATE MESSAGE</a></li>
            <li><a href="public-message.php"><span class='glyphicon glyphicon-globe'></span> PUBLIC MESSAGE</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4><span class='glyphicon glyphicon-pencil'></span> CREATE MESSAGE</h4><hr>
    	</div>
    	<div class="row">
    		<div class="col-md-3">
    			<form class="form-inline" method="POST">
    				<div class="form-group">
    					<div class="row">
    						<div class="col-md-9 col-xs-9">
    							<input  style="width: 108%;" type="text" placeholder="SEARCH" name="search_filter" class="form-control" required>
    						</div>
    						<div class="col-md-3 col-xs-3">
    							<button style="width: 99%;" class="form-control"><span class="glyphicon glyphicon-search"></button>
    						</div>
    					</div>
    				</div>
    			</form><br>
    			<div class="container-fluid" style="overflow-y: scroll; max-height:20vh;" id="search_div">
    				<?php
    					if(isset($_POST['search_filter']))
    					{
    						$filter=$_POST['search_filter'];
							if($filter!="")
							{
								$sql="SELECT * FROM users WHERE firstname LIKE '%$filter%' OR lastname LIKE '%$filter%'";
							$result=$conn->query($sql);
							while($row=$result->fetch_assoc())
							{
								$firstname=$row['firstname'];
								$lastname=$row['lastname'];
								$id=$row['id'];
								echo "<button onclick=\"send_message('$id', '$firstname', '$lastname');\" class='form-control btn btn-danger' style='width:98%;font-size:90%;'><span class='glyphicon glyphicon-heart'></span> $firstname $lastname</button>";
							}
							}
    					}
    				?>
    			</div>
    		</div>
    		<div class="col-md-9">
    			<form method="POST" class="form-inline">
    				<div class="form-group">
    					<label>TO: </label>
    					<input type="text" disabled class="form-control" id="to_name" name="to_name" required>
    					<input type="hidden" name="to_id" id="to_id">
    				</div><br><br>
    				<label>MESSAGE: </label>
    				<textarea class="form-control" style="width:98%; font-size:20px;" rows="10" required id="message_body" name="message_body"></textarea>
    				<div class="form-group">
    				<input type="reset" value="CLEAR MESSAGE" class="form-control">
    				<input type="submit" id="send_now" name="sendbtn" value="SEND MESSAGE" class="form-control" disabled>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
</div>
 <script>
 	function send_message(id, firstname, lastname)
 	{
 		$("#to_name").val(firstname+" "+lastname);
 		$("#to_id").val(id);
 		$("#message_body").focus();
 		$("#search_div").slideUp();
 		$("#send_now").attr("disabled", false);
 	}
 </script>
  </body>
</html>
