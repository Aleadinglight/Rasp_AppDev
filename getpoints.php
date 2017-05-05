<?php
$file = "sound.log";

if (file_exists($file)){
	$fp = fopen($file,"r");
	chmod($file,0775);
	$input=file_get_contents($file);
	fclose(fp);		
	$points = explode(" ",$input);
	$RESS=8;
	for ($i=0;$i<$RESS-1;$i++)
		echo $points[$i].",";
	echo $points[$RESS-1];
}
?>