<?php
	//EWAN KO NA LANG TALAGA....
	session_start();
	require "dbconnect.php";
	$err="";
	if(isset($_POST['loginbtn']))
	{
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$username=mysqli_real_escape_string($conn,$username);
		$password=mysqli_real_escape_string($conn,$password);
		$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			$result=$result->fetch_assoc();
			$_SESSION['currentUsername']=$result['username'];
			$_SESSION['currentFirstname']=$result['firstname'];
			$_SESSION['currentLastname']=$result['lastname'];
			$_SESSION['currentId']=$result['id'];
			header("location:dashboard.php");
		}
		else
		{
			$err="INVALID USERNAME OR PASSWORD";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>ANONYMOUS MESSAGING | PANDUWAG NA SYSTEM</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4" style="margin-top:30px;">
				<div class="panel panel-primary" style="border-color: red;">
					<div class="panel-heading" style="background-color: red !important;">
						<h3>
							<center>
								<span class="glyphicon glyphicon-heart-empty"></span> 
								I MESSAGE MO SI CRUSH
								<span class="glyphicon glyphicon-heart-empty"></span> 
							</center>
						</h3>
					</div>
					<div class="panel-body">
					<form role="form" class="form" method="POST">
					  <div class="form-group">
					    <label for="username">USERNAME: </label>
					    <input type="text" class="form-control" name="username" autofocus required>
					  </div>
					  <div class="form-group">
					    <label for="pwd">PASSWORD:</label>
					    <input type="password" class="form-control" name="password" required>
					  </div>
					  <span style="color:red;">
					  	<b>
					  		<center>
					  			<?php echo $err; ?>
					  		</center>
					  	</b>
					  </span>
					  <div class="form-group">
					    <input type="submit" class="btn btn-danger form-control" name="loginbtn" value="LOGIN" style="font-weight: bold; font-size: 14px;">
					  </div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$(document).ready(function(){

	});
</script>
</body>
</html>