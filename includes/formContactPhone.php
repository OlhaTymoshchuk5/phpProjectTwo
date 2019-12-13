<!-- 
	File:    formContactPhone.php
	Purpose: display validate and post into session phone
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function formContactPhone(){
	$type = "";
	$number = "";
	if (isset($_SESSION['ph_type'])){
		$type = $_SESSION['ph_type'];
	} else if (isset($_POST['ph_type'])){
		$type1 = $_POST['ph_type'];
		if (($type1 == "Home") ||  ($type1 == "Work")
			|| ($type1 == "Mobile") || ($type1 == "Fax")
			|| ($type1 == "Mobile") || ($type1 == "Other")){
			$type = $_POST['ph_type'];
		} 
	} 
	if (isset($_SESSION['ph_number'])){
		$number = $_SESSION['ph_number'];
	} else if (isset($_POST['ph_number'])){
		$number = $_POST['ph_number'];
	}

?>
    <h3>Contact Phone Number</h3>
    <p>Both the Type and Phone number are required<br>
       Press the 'Skip' button to continue without entering a Phone Number</p>
	<br>
	<form method="POST" >
	<table>
	<tr><td><label for="ph_type">Phone # Type:</label></td>
		<td><select id="ph_type" name="ph_type" size="1">
<?php if ($type == ""){ ?>
				<option selected="selected" value="Choice">Choose Type</option>
<?php } else { ?>
				<option  value="Choice">Choose Type</option>
<?php }
	  if ($type == "Home"){ ?>
				<option selected="selected" value="Home">Home</option>
<?php } else { ?>
				<option  value="Home">Home</option>
<?php }
	  if ($type == "Work"){ ?>
				<option selected="selected" value="Work">Work</option>
<?php } else { ?>
				<option  value="Work">Work</option>
<?php }
	  if ($type == "Mobile"){ ?>
				<option selected="selected" value="Mobile">Mobile</option>
<?php } else { ?>
				<option value="Mobile">Mobile</option>
<?php }
	  if ($type == "Fax"){ ?>
				<option selected="selected" value="Fax">Fax</option>
<?php } else { ?>
				<option value="Fax">Fax</option>
<?php }
	  if ($type == "Other"){ ?>
				<option selected="selected" value="Other">Other</option>
<?php } else { ?>
				<option value="Other">Other</option>
<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for="ph_number">Phone Number</label></td>
		<td><input type="tel" id="ph_number" name="ph_number" size="50" maxlength="50" value="<?php echo $number; ?>"></td>
	</tr>
	</table>
    <table>
    <tr>
        <td><input type="submit" name="ct_b_back" value="Back"></td>
        <td><input type="submit" name="ct_b_next" value="Next"></td>
    </tr>
    <tr>
		<td><input type="submit" name="ct_b_cancel" value="Cancel"></td>
		<td><input type="submit" name="ct_b_skip" value="Skip"></td>
    </tr>
    </table>
	</form>
<?php
}
?>

<?php
function validateContactPhone(){
	$err_msgs = array();
	if (!isset($_POST['ph_type'])){
		$err_msgs[] = "An phone number type must be selected";
	} else if (isset($_POST['ph_type'])){
		$type = trim($_POST['ph_type']);
		if (!(($type == "Home") || ($type == "Work") || ($type == "Mobile")
				|| ($type == "Fax")|| ($type == "Other"))){
			$err_msgs[] = "An phone number type must be selected";
		}
	}
	if(!isset($_POST['ph_number'])){
		$err_msgs[] = "The phone number field must not be empty";
	} else {
		$number = trim($_POST['ph_number']);
		if (strlen($number) == 0){
			$err_msgs[] = "The phone number field must not sbe empty";
		} else if (strlen($number) > 50){
			$err_msgs[] = "The phone number is too long";
		}
		else if(!preg_match('/^[(][0-9]{0,3}[)][0-9]{3}-[0-9]{4}$|^[0-9]{3}-[0-9]{3}-[0-9]{4}$|^[+][1][(][0-9]{3}[)][0-9]{3}-[0-9]{4}$/', $number)){
			$err_msgs[] = "The phone number should be in north american standard";
		}
	}
	//
	if (count($err_msgs) == 0){
		$_POST['ph_type'] = $type;
		$_POST['ph_number'] = $number;
	}
	return $err_msgs;
}
?>

<?php
function contactPhonePosttoSession(){
	$_SESSION['ph_type'] = $_POST['ph_type'];
	$_SESSION['ph_number'] = $_POST['ph_number'];
}
?>

