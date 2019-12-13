<!-- 
	File:    formContactEmail.php
	Purpose: to display, validate and post into session Email
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function formContactEmail(){
	$type = "";
	$email = "";
	if (isset($_SESSION['em_type'])){
		$type = $_SESSION['em_type'];
	} else if (isset($_POST['em_type'])){
		$type1 = $_POST['em_type'];
		if (($type1 == "Home") ||  ($type1 == "Work")
			 || ($type1 == "Other")){
			$type = $_POST['em_type'];
		} 
	} 
	if (isset($_SESSION['em_email'])){
		$email = $_SESSION['em_email'];
	} else if (isset($_POST['em_email'])){
		$email = $_POST['em_email'];
	}

?>
	<h3>Contact Email Address</h3>
	<p>Both the Type and Email Address are required<br>
	   Press the 'Skip' button to continue without entering an Email Address</p>
	<br>
	<form method="POST" >
	<table>
	<tr><td><label for="em_type">Email Type:</label></td>
		<td><select id="em_type" name="em_type" size="1">
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
				<option value="Work">Work</option>
<?php }
	  if ($type == "Other"){ ?>
				<option selected="selected" value="Other">Other</option>
<?php } else { ?>
				<option value="Other">Other</option>
<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for="em_email">Email Address</label></td>
		<td><input type="email" id="em_email" name="em_email" size="50" maxlength="50" value="<?php echo $email; ?>"></td>
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
function validateContactEmail(){
	$err_msgs = array();
	if (!isset($_POST['em_type'])){
		$err_msgs[] = "An email type must be selected";
	} else if (isset($_POST['em_type'])){
		$type = trim($_POST['em_type']);
		if (!(($type == "Home") || ($type == "Work") 
				|| ($type == "Other"))){
			$err_msgs[] = "An email type must be selected";
		}
	}
	if(!isset($_POST['em_email'])){
		$err_msgs[] = "The email address field must not sbe empty";
	} else {
		$email = trim($_POST['em_email']);
		if (strlen($email) == 0){
			$err_msgs[] = "The email address field must not sbe empty";
		} else if (strlen($email) > 50){
			$err_msgs[] = "The email address is too long";
		}
		else if(!preg_match("/^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/",$email)){
			$err_msgs[] = "The email address should be in the format user@local.xxx";
		}
	}
	if (count($err_msgs) == 0){
		$_POST['em_type'] = $type;
		$_POST['em_email'] = $email;
	}
	return $err_msgs;
}
?>

<?php
function contactEmailPosttoSession(){
	$_SESSION['em_type'] = $_POST['em_type'];
	$_SESSION['em_email'] = $_POST['em_email'];
}
?>

