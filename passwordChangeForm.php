<?php session_start(); ?>
<?php
$id = $_SERVER['PHP_AUTH_USER'];
$pass = sha1($_SERVER['PHP_AUTH_PW']);
$con = mysqli_connect($_SERVER['SERVER_ADDR'],'root','','PACE');
$db = "SELECT COUNT(*) FROM Authenticate WHERE Id='$id' AND Pass='$pass'";
$flag = mysqli_fetch_array(mysqli_query($con,$db))[0];
if($_SESSION['isset'] == true and $flag){
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<title>Change Password</title>
</head>
<body background="">
	<div>
	<div id="cssmenu" style="z-index:1;">
	<ul>
   	<li>
   		<a href="updateDbFields.php"<span>add questions</span></a>
   	</li>
   	<li>
   		<a href='getQuestions.php'><span>access questions</span></a>
   	</li>
   	<li>
   		<a href='logout.php'><span>logout</span></a>
   	</li>
   	<li class='last'>
   		<a href='changePassword.php'><span>Change password</span></a>
   	</li>
	</ul>
	</div>


	<br><br>
	<div class="col-sm-10" style="width:16%;margin-left:45%;"><br>
		<div class="form-control">
		<p id="time" style="color:white;">PACE</p>
		</div>
	</div>
	<br>
	<br>
	<script>
		var x = setInterval(function(){func()},1000);
		function func()
		{
			document.getElementById("time").style.color="black";
			var d=new Date();
			var t=d.toLocaleDateString()+" || "+d.toLocaleTimeString();
			document.getElementById("time").innerHTML=t;
		}
	</script>
	<div class="well">
	<div style="border-left:50px #FFFFFF;padding:50px;padding-bottom:0px;">
	<h3>
	<?php
		$oldpass = sha1($_POST['oldpass']);
		$newpass = sha1($_POST['newpass']);
		$id = $_SERVER['PHP_AUTH_USER'];
		$con = mysqli_connect($_SERVER['SERVER_ADDR'],'root','','PACE');
		$db = "SELECT COUNT(*) FROM Authenticate WHERE (Id='$id' AND Pass='$oldpass')";
		$flag = mysqli_fetch_array(mysqli_query($con,$db))[0];
		if($flag){
			$db = "UPDATE Authenticate SET Pass='$newpass' WHERE Id='$id'";
			if(mysqli_query($con,$db)){
				$_SERVER['PHP_AUTH_PW'] = sha1($newpass);
				echo 'Password changed successfully! :D <br>Please login again.';
			}
			else 
				echo 'There was some problem trying to update the password! Please try again later!<br>';
		}
		else
			echo 'The entered password do not match any records! Try again!<br>';
	?>
	</h3>
	</div>
</div>
</body>
</html>
<?php
}
else 
{
	header("WWW-Authenticate: " .
		"Basic realm=\"Please Authenticate\"");
	header("HTTP/1.0 401 Unauthorized");//1.0 200 OK
	$_SESSION['isset']=true;
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<title>Please login</title>
</head>
<body background="">
  <div>
  <div id="cssmenu" style="z-index:1;">
  <ul>
    <li>
      <a href="updateDbFields.php"<span>add questions</span></a>
    </li>
    <li>
      <a href='getQuestions.php'><span>access questions</span></a>
    </li>
    <li>
      <a href='logout.php'><span>logout</span></a>
    </li>
    <li class='last'>
      <a href='changePassword.php'><span>change password</span></a>
    </li>
  </ul>
  </div>


  <br><br>
  <div class="col-sm-10" style="width:16%;margin-left:45%;"><br>
    <div class="form-control">
    <p id="time"></p>
    </div>
  </div>
  <br>
  <br>
  <script>
    var x = setInterval(function(){func()},1000);
    function func()
    {
      document.getElementById("time").style.color="black";
      var d=new Date();
      var t=d.toLocaleDateString()+" || "+d.toLocaleTimeString();
      document.getElementById("time").innerHTML=t;
    }
  </script>
  <div class="well">
  <div style="border-left:50px #FFFFFF;padding:50px;padding-bottom:0px;">
  <h3>Login to see the portal.</h3>
  
  </div>
  </div>
</body>
</html>
<?php
}
mysqli_close($con);
?>