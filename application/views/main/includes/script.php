<?php if(!empty($settings[0]['custom_js'])) { 
 	header("Content-type: text/javascript");
	echo $settings[0]['custom_js'];
}
?>
