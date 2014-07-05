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
</head>
<body background="">
	<div>
	<div id="cssmenu" style="z-index:1;">
	<ul>
   	<li class>
   		<a href="updateDbFields.php"<span>add questions</span></a>
   	</li>
   	<li>
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
	<div style="border-left:50px #FFFFFF;padding:50px;padding-bottom:0px;">
	<h3>Well here are the questions :</h3>
	<hr>
	<div class="list-group">
	<?php
		$type = array('single','multiple','integer');
		$difficulty = array('easy','medium','hard');
		$con = mysqli_connect($_SERVER['SERVER_ADDR'],'root','','PACE');
		$db = "SELECT * FROM PhysicsTopics";
		$res = mysqli_query($con,$db);
		$file = fopen('QuestionPaper.txt','w');
		while($row = mysqli_fetch_array($res)){
			$topic = $row['Topics'];
			$quantity=array();
			for($i=0;$i<9;++$i)
				$quantity[$i] = $_POST[$i.$topic];
			for($i=0;$i<3;++$i){
				for($j=0;$j<3;++$j){
					$export = "Topic=\"".$topic."\" AND QuestionType=\"".$type[$i]."\" AND Difficulty=\"".$difficulty[$j]."\") LIMIT ".$quantity[$i*3+$j].";";
			$db = "SELECT Question,Answer FROM AITS WHERE (".$export;
			$answer = mysqli_query($con,$db);
			while($fetch = mysqli_fetch_array($answer)){
				echo '<a class="list-group-item">';
		        echo '<h4 class="list-group-item-heading">'.$fetch[0].'</h4>';
		        echo '<p class="list-group-item-text">'.$fetch[1].'</p>';
			    echo '</a>';
			    fwrite($file,$fetch[0]."\n".$fetch[1]."\n");
			}}}
		}
	?>
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
	print("Unauthorized access not allowed");
	$_SESSION['isset']=true;
}
?>