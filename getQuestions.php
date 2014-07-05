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
<title>Get Questions</title>
<style>
input{
	width:15%;
	padding-left: 10px;
	padding-right: 10px;
	text-align: center;
}
table th{
	text-align: center;
}
table td{
	text-align: center;
}
</style>
</head>
<body background="">
	<div>
	<div id="cssmenu" style="z-index:1;">
	<ul>
   	<li>
   		<a href="updateDbFields.php"<span>add questions</span></a>
   	</li>
   	<li class='active'>
   		<a href='getQuestions.php'><span>access questions</span></a>
   	</li>
   	<li class='last'>
   		<a href='logout.php'><span>logout</span></a>
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
	<form action="displayQuestions.php" method="post">
	<div style="border-left:50px #FFFFFF;padding:50px;padding-bottom:0px;">
	<h3>Physics</h3>
	<hr>
	<table
		class="table table-striped table-hover">
		<tr>
			<th style="width:20%;">Topics</th>
			<th align="center">Single</th>
			<th align="center">Multiple</th>
			<th align="center">Integer</th>
		</tr>
	<?php
		$con = mysqli_connect($_SERVER['SERVER_ADDR'],'root','','PACE');
		$db = "SELECT * from PhysicsTopics";
		$result = mysqli_query($con,$db);
		while($row = mysqli_fetch_array($result)) {
			$field = $row['Topics'];
			echo "
				<tr>
					<td>".$field."</td>".
					"<td>E <input placeholder='0' name=\"0".$field."\" value='0'> M <input placeholder='0' name=\"1".$field."\" value='0'> H <input placeholder='0' name=\"2".$field."\" value='0'></td>".
					"<td>E <input placeholder='0' name=\"3".$field."\" value='0'> M <input placeholder='0' name=\"4".$field."\" value='0'> H <input placeholder='0' name=\"5".$field."\" value='0'></td>".
					"<td>E <input placeholder='0' name=\"6".$field."\" value='0'> M <input placeholder='0' name=\"7".$field."\" value='0'> H <input placeholder='0' name=\"8".$field."\" value='0'></td>".
				"</tr>";
		}
	?>
	</table>
	</div>

	<div style="border-left:50px #FFFFFF;padding:50px;padding-bottom:0px;">
	<h3>Chemistry</h3>
	<hr>
	<table
		class="table table-striped table-hover">
		<tr>
			<th style="width:20%;">Topics</th>
			<th align="center">Single</th>
			<th align="center">Multiple</th>
			<th align="center">Integer</th>
		</tr>
	<?php
		$db = "SELECT * from ChemistryTopics";
		$result = mysqli_query($con,$db);
		while($row = mysqli_fetch_array($result)) {
			$field = $row['Topics'];
			echo "
				<tr>
					<td>".$field."</td>".
					"<td>E <input placeholder='0' name=\"0".$field."\" value='0'> M <input placeholder='0' name=\"1".$field."\" value='0'> H <input placeholder='0' name=\"2".$field."\" value='0'></td>".
					"<td>E <input placeholder='0' name=\"3".$field."\" value='0'> M <input placeholder='0' name=\"4".$field."\" value='0'> H <input placeholder='0' name=\"5".$field."\" value='0'></td>".
					"<td>E <input placeholder='0' name=\"6".$field."\" value='0'> M <input placeholder='0' name=\"7".$field."\" value='0'> H <input placeholder='0' name=\"8".$field."\" value='0'></td>".
				"</tr>";
		}
	?>
	</table>
	</div>

	<div style="border-left:50px #FFFFFF;padding:50px;padding-bottom:0px;">
	<h3>Maths</h3>
	<hr>
	<table
		class="table table-striped table-hover">
		<tr>
			<th style="width:20%;">Topics</th>
			<th align="center">Single</th>
			<th align="center">Multiple</th>
			<th align="center">Integer</th>
		</tr>
	<?php
		$db = "SELECT * from MathsTopics";
		$result = mysqli_query($con,$db);
		while($row = mysqli_fetch_array($result)) {
			$field = $row['Topics'];
			echo "
				<tr>
					<td>".$field."</td>".
					"<td>E <input placeholder='0' name=\"0".$field."\" value='0'> M <input placeholder='0' name=\"1".$field."\" value='0'> H <input placeholder='0' name=\"2".$field."\" value='0'></td>".
					"<td>E <input placeholder='0' name=\"3".$field."\" value='0'> M <input placeholder='0' name=\"4".$field."\" value='0'> H <input placeholder='0' name=\"5".$field."\" value='0'></td>".
					"<td>E <input placeholder='0' name=\"6".$field."\" value='0'> M <input placeholder='0' name=\"7".$field."\" value='0'> H <input placeholder='0' name=\"8".$field."\" value='0'></td>".
				"</tr>";
		}
	?>
	</table>
	</div>
	<br><br><hr><hr><br>
        <input type="submit" class="submit-align btn btn-default" value="FETCH">
      </form>
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
	print("Unauthorized access not allowed");
	$_SESSION['isset']=true;
}
?>