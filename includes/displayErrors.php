<!-- 
	File:    displayErrors.php
	Purpose: to display errors on pages
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function displayErrors($errs){
	echo "<div>\n";
	echo '<h5 class="text-danger"> This form contains the following errors</h5>';
	echo "<ul>\n";
	foreach ($errs as $err){
		echo "<li>".$err."</li>\n";
	}
	echo "</ul>\n";
	echo "</div>\n";
}
?>
