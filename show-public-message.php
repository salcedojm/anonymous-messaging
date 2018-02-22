<?php
	session_start();
	require "dbconnect.php";
	if(!isset($_SESSION['currentUsername']))
	{
		header("location:index.php");
	}
  $sql="SELECT * FROM public_messages WHERE status='UNREAD' ORDER BY id LIMIT 1";
  $result=$conn->query($sql);
  $message=$result->fetch_assoc();
  $message_body=$message['message_body'];
  $code_name=$message['code_name'];
  $date_sent=$message['date_sent'];
  $id=$message['id'];
  $sql="UPDATE public_messages SET status='SEEN' WHERE id=$id";
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <center>
            <h1>VALENTINES PUBLIC MESSAGE</h1><hr>
          </center>
        </div>
        <div class="col-md-12">
          <div id="public_messages">

          </div>
        </div>
      </div>
    </div>
    <script>
      var timeCount=0;
      function showNew(){
        $.post('get-new-message.php',
          function(data, status){
          if(data!=0)
          {
            data=JSON.parse(data);
            alert(data.message);
          }
        });
      }
      showNew();
    </script>
  </body>
</html>
