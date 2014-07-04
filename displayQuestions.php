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
   		<a href="updateDbFields.html"<span>add questions</span></a>
   	</li>
   	<li class='last'>
   		<a href='getQuestions.php'><span>access questions</span></a>
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
	<p>
	<?php
		$type = array('single','multiple','integer');
		$difficulty = array('easy','medium','hard');
		$con = mysqli_connect($_SERVER['SERVER_ADDR'],'root','','PACE');
		$db = "SELECT * FROM PhysicsTopics";
		$res = mysqli_query($con,$db);
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
				echo $fetch[0]."<br>".$fetch[1]."<br><br>";
			}}}
		}
	?>
	</p>
	</div>
	</div>
</body>
</html>