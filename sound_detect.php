<!DOCTYPE HTML>
<html>
<head>  
  
    
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
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

	
	<div class="between">
	<h1 style="color:white; text-align: center; padding-top:90px; font-size:40px;">Sound Detector</h1>
	</div>


	<div class="ct-chart ct-perfect-fourth" style="height:400px;width:100%; background-color:#556270;"></div>
	<script > 
		
		function updatePoint(dps){
			//console.log(dps);
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
		// Create a new line chart object where as first parameter we pass in a selector
		// that is resolving to our chart container element. The Second parameter
		// is the actual data object.
		
		function GetPoints(){
			var xhttp;
			var dps, d=1;
			var params="link=sound.log";
			if (window.XMLHttpRequest) 
			    xhttp = new XMLHttpRequest(); 
			else 
		    	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    xhttp.onreadystatechange = function () {
       	 		if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
            		dps=JSON.parse("[" + xhttp.responseText + "]");
            		//console.log(dps);
            		//console.log(xhttp.responseText);
            		return dps;
        		}
    		};
			xhttp.open("POST","getpoints.php" , false);
			xhttp.send(params);
			//console.log(xhttp.onreadystatechange());
			return xhttp.onreadystatechange();
		}
		var temp=[], RESS=8;

		function rungraph(temp, count, fps) {
			var dps=temp.slice(0, RESS);
			updatePoint(dps);
			temp.shift();
			console.log(temp);
			if (count<RESS){
				 setTimeout(function(){ rungraph(temp, count+1, fps);},fps);
			}

		}

		
		function update(updateInterval){
			var newtemp=GetPoints();
			temp.push.apply(temp,newtemp);
			
			if (temp.length>RESS){
				var i=1, fps=updateInterval/RESS;
				console.log(temp);
				setTimeout(function(){ rungraph(temp, i,fps);},fps);
			}		
		}
		updateInterval=1001;
		update(updateInterval);
		var id=setInterval(function(){update(updateInterval)}, updateInterval);
		//setTimeout(function(){clearInterval(id);},10000);
	</script>
	<br><br><br><br>
	<a href="saved_plot.php" style="color:white; font-size:17px;">Click to see previous data</a>
</body>
</html>

