<?php if(!empty($settings[0]['custom_css'])) { 
 	header("Content-type: text/css");
	echo $settings[0]['custom_css'];
}
?>
