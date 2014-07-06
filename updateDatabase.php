<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<title>Add Questions</title>
</head>
<body background="">

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
	
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$subject =  $_POST['inputSubject'];
	$difficulty = $_POST['inputDifficulty'];
	$questionType = $_POST['questionType'];
	$topic = ($_POST['inputTopic']);
	$question = htmlspecialchars($_POST['inputQuestion']);
	$solution = htmlspecialchars($_POST['inputSolution']);
	$detailedSolution = htmlspecialchars($_POST['inputDetailedSolution']);
	$con = mysqli_connect($_SERVER['SERVER_ADDR'],'root','','PACE');
	if(!$con){
?>
	<h3>Sorry! There is some problem connecting to the database. Administrator has been informed.</h3><br>
<?php
		mail();
		die();
	}
	$topic = mysqli_real_escape_string($con,$topic);
	switch($subject){
		case 'physics':
			$db = "INSERT INTO PhysicsTopics Values ('$topic');";
			mysqli_query($con,$db);
			break;
		case 'chemistry':
			$db = "INSERT INTO ChemistryTopics Values ('$topic');";
			mysqli_query($con,$db);
			break;
		case 'maths':
			$db = "INSERT INTO MathsTopics Values ('$topic');";
			mysqli_query($con,$db);
			break;
	}
	$db = "INSERT INTO AITS Values 
		('$subject','$difficulty','$questionType','$topic','$question','$solution','$detailedSolution')";
	if(mysqli_query($con,$db)){
?>
	<h3>Database successfully updated!</h3><br>
<?php
	}
	else {
?>
	<h3>There is some problem updating the database. Please try again!</h3><br>.
<?php
		die();
	}
	mysqli_close($con);
}
?>
<br>
<h3 id="para">Redirecting to previous page in 5 . . .</h3>
<script>
	count = 4;
	function decrement() {
	document.getElementById("para").innerHTML ="Redirecting to previous page in "+count+" . . .";
	count--;
	}
	function redirect() {
	window.location.assign("updateDbFields.php");
	}
	window.setTimeout(function(){redirect()},5000);
	window.setInterval(function(){decrement()},1000);
</script>
</div>
</div>
</body
</html>