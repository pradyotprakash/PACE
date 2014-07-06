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
<link rel="stylesheet" type="text/css" href="passstyle.css">
<title>Change Password</title>
<script>
function verify(){
  var a = document.getElementsByName('newpass')[0].value;
  var b = document.getElementsByName('newpassconf')[0].value;
  if(a!=b){
    alert("The new passwords do not match!");
    return false;
  }
  return true;
}
</script>
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
   	<li class='last active'>
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
	<div id="form-main">
  <div id="form-div">
    <form class="form" method="post" action="passwordChangeForm.php" onsubmit="return verify()">
      <p class="comment">
        <input required name="oldpass" autocomplete="off" type="password" 
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Password" id="comment" />
      </p>
      
      <p class="comment">
        <input required name="newpass" autocomplete="off" type="password" 
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="New Password" id="comment" />
      </p>

      <p class="comment">
        <input required name="newpassconf" autocomplete="off" type="password" 
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Confirm New Password" id="comment" />
      </p>
      
      <div class="submit">
        <input type="submit" value="CHANGE PASSWORD" id="button-blue"/>
        <div class="ease"></div>
      </div>
    </form>
  </div>
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