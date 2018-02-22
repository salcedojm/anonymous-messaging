<?php
  session_start();
  require "dbconnect.php";
  if(!isset($_SESSION['currentUsername']))
  {
    header("location:index.php");
  }
  $currentUser=$_SESSION['currentUsername'];
  $currentId=$_SESSION['currentId'];
  $sql="SELECT * FROM messages WHERE message_to=$currentId AND status='UNREAD'";
  $unread_messages=$conn->query($sql);
  $sql="SELECT * FROM messages WHERE message_to=$currentId";
  $all_messages=$conn->query($sql);
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
          <a style="font-size: 12px;" class="navbar-brand" href="#"><?php echo $_SESSION['currentLastname'].", ".$_SESSION['currentFirstname']; ?> | #MessageYourCrush</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class='glyphicon glyphicon-inbox'></span> INBOX</a></li>
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
          <h4><span class='glyphicon glyphicon-inbox'></span> INBOX</h4><hr>
          <?php if($all_messages->num_rows>0) { ?>
          <table class="table">
            <thead>
              <tr>
                <th>DATE</th>
                <th>MESSAGE</th>
                <th>ACTION</th>
              </tr>
            </thead>
          <?php
            while($message=$all_messages->fetch_assoc())
            {
              $message_body=$message['message_body'];
              $message_to=$message['message_to'];
              $date_sent=$message['date_sent'];
              $message_id=$message['id'];
              if($message['status']==="UNREAD")
              {
                echo "<tr style='background-color: lightgrey; font-weight:bold;'>";
              }
              else
              {
                echo "<tr>";
              }
                echo "<td>".$date_sent."</td>";
                if(strlen($message_body)<10)
                {
                  echo "<td>".$message_body."</td>";
                }
                else
                {

                  echo "<td>".substr($message_body, 0,14)."....</td>";
                }
                echo "<td><a href='read_message.php?message_id=$message_id' class='btn btn-success'><span class='glyphicon glyphicon-eye-open'></span> READ</a></td>";
              echo "</tr>";
            }
            echo "</tbody></table>";
            }
            else
            {
          ?>
          <h4><center>WALANG MESSAGE. HAYS. SAD T_T</center></h4>
          <?php } ?>
      </div>
    </div>
  </body>
</html>
