<!DOCTYPE html>
<head>

</head>
<body background="background.jpg">
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$subject =  $_POST['inputSubject'];
	$difficulty = $_POST['inputDifficulty'];
	$questionType = $_POST['questionType'];
	$topic = $_POST['inputTopic'];
	$question = $_POST['inputQuestion'];
	$solution = $_POST['inputSolution'];
	$detailedSolution = $_POST['inputDetailedSolution'];
	$con = mysqli_connect($_SERVER['SERVER_ADDR'],'root','','PACE');
	if(!$con){
?>
	<p style="margin-top:20%;margin-left:43%">Sorry! There is some problem connecting to the database. Administrator has been informed.</p><br>
<?php
		mail();
		die();
	}
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
	<p style="margin-top:20%;margin-left:43%">Database successfully updated!</p><br>
<?php
	}
	else {
?>
	<p style="margin-top:20%;margin-left:43%">There is some problem updating the database. Please try again!</p><br>.
<?php
		die();
	}
}
?>
<br>
<span id="para" style="margin-top:20%;margin-left:43%">Redirecting to previous page in 5 . . .</span>
<script>
	count = 4;
	function decrement() {
	document.getElementById("para").innerHTML ="Redirecting to previous page in "+count+" . . .";
	count--;
	}
	function redirect() {
	window.location.assign("updateDbFields.html");
	}
	window.setTimeout(function(){redirect()},5000);
	window.setInterval(function(){decrement()},1000);
</script>
</body
</html>