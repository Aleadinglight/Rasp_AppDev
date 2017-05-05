<?php
	
	if (isset($_POST["day"])){
		
		$dir="plotdata/".$_POST["day"]."/";

		if (file_exists($dir)){

			$files=scandir($dir);
			$files=scandir($dir);
			echo "<select id='selecttime'>";
			echo "<option disabled selected value>Choose time</option><br>";
			foreach ($files as $file) {
				if(substr($file, 0, 1) != ".")
					echo "<option value='".$file."'>".$file."</option><br>";
			}
			echo "</select>";
		}
		else echo "There is no comment yet.";	
	}
?>
