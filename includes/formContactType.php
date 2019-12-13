<!-- 
	File:    FormContactType.php
	Purpose: Select Contact Type 
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php 

function formContactType(){
	$t = "";
	if (isset($_SESSION['ct_type'])) {
		$t = $_SESSION['ct_type'];
	} else if (isset($_POST['ct_type'])){
		$t1 = $_POST['ct_type'];
		if (($t1 == "Friend") || ($t1 == "Family") 
			|| ($t1 == "Business") || ($t1 == "Other")) {
			$t = $_POST['ct_type'];
		}
 	}
?>


		
		<div>


<form method="POST" >
	<h5>1) What type of contact do yo want to add?</h5>
	<table>
		<tr><td><label for="ct_type">Contact Type:</label></td>
			<td><select class="custom-select" id="ct_type" name="ct_type" size="1">
<?php if((strlen($t) ==0) ){ ?>
				<option selected="selected" value="Choice">Select type</option>
<?php } else { ?>
				<option value="Choice">Select type</option>
<?php }
	  if ($t == "Family"){ ?>
				<option selected="selected" value="Family">Family</option>
<?php } else { ?>
				<option value="Family">Family</option>
<?php }
	  if ($t == "Friend"){ ?>
				<option selected="selected" value="Friend">Friend</option>
<?php } else { ?>
				<option value="Friend">Friend</option>
<?php }
	  if ($t == "Business"){ ?>
				<option selected="selected" value="Business">Business</option>
<?php } else { ?>
				<option value="Business">Business</option>
<?php }
	  if ($t == "Other"){ ?>
				<option selected="selected" value="Other">Other</option>
<?php } else { ?>
				<option value="Other">Other</option>
<?php } ?>
			</select></td>
		</tr>
	</table>
	<br>
	</div>
      <div class="row">
	    <div class="col-6" style="text-align: left;">
		<input type="submit" name="ct_b_cancel" value="Cancel">
		</div>
	    <div class="col-6" style="text-align: right;">
		<input type="submit" disabled="disabled" name="ct_b_back" value="Back">             
	    <input type="submit" name="ct_b_next" value="Next">

	    </div>
	  </div>
	</div>
<?php
}
?>

<?php

function validateContactType(){
	$err_msgs = array();
	if (!isset($_POST['ct_type'])){
		$err_msgs[] = "No contact type specified";
	} else {
		$ct_type = trim($_POST['ct_type']);
		if (!(($ct_type == "Friend") 
			  || ($ct_type == "Family")
			  || ($ct_type == "Business")
			  || ($ct_type == "Other"))){
			$err_msgs[] = "A valid contact type must be chosen.";
		}
	}
	if (count($err_msgs) == 0){
		$_POST['ct_type'] = $ct_type;
	}
	return $err_msgs;
}
?>

<?php
function contactTypePostToSession(){
	$_SESSION['ct_type'] = $_POST['ct_type'];
}
?>
