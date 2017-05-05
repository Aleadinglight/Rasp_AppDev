<?php
	$record ="";

	$dir="plotdata/";
	if (!file_exists($dir)){
		mkdir($dir);
		chmod($dir, 0775);
	}

	if (isset($_POST["data"])) {
		$tdate = date("Y-m-d");
		$time = date("H:i:s");
		$record = $_POST["data"]."\r\n";
		$RESS=8;
		// This data is to be saved.
		
		$dir=$dir.$tdate."/";
		if (!file_exists($dir)){
			mkdir($dir);
			chmod($dir, 0775);
		}	
		$filesave=$dir.$time;
		file_put_contents($filesave, $record);
		chmod($filesave,0777);
		
		//This data is used for dynamic display.
		$file ="sound.log";
		chmod($file,0775);
		$fp = fopen($file,"w");
		
		fwrite($fp,$record);
		fclose(fp);
		echo "Data received.\n";
	}	
?>
