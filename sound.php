<?php
$tdate = date("Y-m-d H:i:s");
$record = $tdate;
$record .= ", ".$_SERVER["REMOTE_ADDR"];

if (isset($_POST["data"])) {
	
	$record .= ", ".$_POST["data"];
	
	$record .= "\r\n";
	$file = "sound.log";
	if (file_exists($file))
		$fp = fopen($file,"a");
	else
		$fp = fopen($file,"w");
	fwrite($fp,$record);
	fclose(fp);
	echo "Data received.";
}
?>
