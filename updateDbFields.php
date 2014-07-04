<?php session_start(); ?>
<?php
if($_SERVER['PHP_AUTH_USER'] == "pp" and $_SERVER['PHP_AUTH_PW'] == "pp"){
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<title>Add Questions</title>
</head>
<body background="">
	<div>
	<div id="cssmenu" style="z-index:1;">
	<ul>
   	<li class='active'>
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
	<form class="form-horizontal" roe="form" method="post" action="updateDatabase.php">
		<div class="form-group">
		<label class="col-sm-2 control-label">Subject
		</label>
		<div class="col-sm-10">
		<select style="width:10%;" class="form-control" name="inputSubject" value="physics">
		  	<option value="physics">Physics</option>
		  	<option value="chemistry">Chemistry</option>
		  	<option value="maths">Maths</option>
		  	</select>
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-2 control-label">Difficulty
		</label>
		<div class="col-sm-10">
		<select class="form-control" style="width:10%;" name="inputDifficulty" value="easy">
		  	<option value="easy">Easy</option>
		  	<option value="medium">Medium</option>
		  	<option value="hard">Hard</option>
		  	</select>
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-2 control-label">Type
		</label>
		<div class="col-sm-10">
		<select class="form-control" name="questionType" style="width:10%;" value="single">
		  	<option value="integer">Integer</option>
		  	<option value="single">Single</option>
		  	<option value="multiple">Multiple</option>
		  	</select>
		</div>
		</div>
	

	  <div class="form-group">
	    <label for="inputTopic" class="col-sm-2 control-label">Topic</label>
	    <div class="col-sm-10">
	      <input name="inputTopic" type="text" class="form-control" id="inputTopic" required style="width:25%;">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputQuestion" class="col-sm-2 control-label">Question</label>
	    <div class="col-sm-10">
	      <textarea name="inputQuestion" type="text" class="form-control" id="inputQuestion" cols="100" rows="5" required style="width:50%;"></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputSolution" class="col-sm-2 control-label">Solution</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="inputSolution" required name="inputSolution" style="width:25%;">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputDetailedSolution" class="col-sm-2 control-label">Detailed Solution</label>
	    <div class="col-sm-10">
	      <textarea name="inputDetailedSolution" type="text" class="form-control" id="inputDetailedSolution"  rows="5" cols="100" style="width:50%;"></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default">Update</button>
	    </div>
	  </div>
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
		"Basic realm=\"PHPEveryday's Protected Area\"");
	header("HTTP/1.0 401 Unauthorized");//1.0 200 OK
	print("This page is protected by HTTP ");
	session_destroy();
}
?>