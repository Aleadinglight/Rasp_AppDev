<!DOCTYPE HTML>
<html>
<head>  
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body bgcolor="#3c445c">
	
	<div class="bar">
	<form action="index.php" class="inline">
	<button class="barbut">
		<b>Main page</b>
	</button>
	</form>
	</div>

	<script>

		function updateplot(dps){
			console.log(dps);
			var data = {
				series:  [dps]
				};
			var options = {
				chartPadding: {
					right:-155,
					left:20,
					top:50,
					bottom:10
				},
				showArea: true,
				showPoint: false,
				lineSmooth: true,
				axisY: {
					low: 0,
					high: 80,
					offset: 60
				}
			};
			var Chart= new Chartist.Line('.ct-chart', data,options);
		}

		function timechoices(day){
			$.ajax({
       			url: "choosetime.php", 
       			type: "post",
       			data: {day: day},
       			success: function(result){
            		$("#divtime").html(result);
            	}
       		});
       		$("#divtime").on("change", "#selecttime", function(){
        		time=$("#selecttime").val();
	   			console.log(time);
	   			linkdata=day+"/"+time;
	   			$.ajax({
	       			url: "getsaveddata.php", 
	       			type: "post",
	       			data: {link: linkdata},
	       			success: function(result){
	       				result=JSON.parse(result);
	            		updateplot(result);
	            	}
	       		});
    		});
		}
		

		$(document).ready(function(){
    		$("#selectday").change(function(){
        		var day=$("#selectday").val();
        		console.log(day);
        		timechoices(day);
    		});

		});
	</script>
	
	<div class="between">
	<h1 style="color:white; text-align: center; padding-top:90px; font-size:40px;">Chose the day to see the saved data</h1>

	<?php
		
		$dir="plotdata";
		$files=scandir($dir);
		echo "<select id='selectday'>";
		echo "<option disabled selected value>Choose day</option><br>";
		foreach ($files as $file) {
			if(substr($file, 0, 1) != ".")
				echo "<option value='".$file."'>".$file."</option><br>";
		}
		echo "</select>";
	?>
	
	<div id="divtime" style="display:inline-block;">
	</div>
	</div>


	

	<div class="ct-chart ct-perfect-fourth" style="height:400px;width:100%; background-color:#556270;"></div>
</body>
</html>


