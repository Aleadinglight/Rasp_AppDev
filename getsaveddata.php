
<?php

if (isset($_POST["link"]) ){
	$file="plotdata/".$_POST["link"];
	$fp = fopen($file,"r");
	chmod($file,0775);
	$input=file_get_contents($file);
	fclose(fp);		
	$points = explode(" ",$input);
	$RESS=8;
	echo "[";
	for ($i=0;$i<$RESS-1;$i++)
		echo $points[$i].",";
	echo $points[$RESS-1];
	echo "]";
}
?>