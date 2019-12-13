<!-- 
	File:    formContactWeb.php
	Purpose: display form, validate and post into session
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function formContactWeb(){
	$type = "";
	$url = "";
	if (isset($_SESSION['we_type'])){
		$type = $_SESSION['we_type'];
	} else if (isset($_POST['we_type'])){
		$type1 = $_POST['we_type'];
		if (($type1 == "Personal") ||  ($type1 == "Work")
			|| ($type1 == "LinkedIn") ||  ($type1 == "Facebook")
			 || ($type1 == "Other")){
			$type = $_POST['we_type'];
		} 
	} 
	if (isset($_SESSION['we_url'])){
		$url = $_SESSION['we_url'];
	} else if (isset($_POST['we_url'])){
		$url = $_POST['we_url'];
	}

?>
	<h3>Contact Web Site</h3>
	<p>Both the Type and Web Site URL are required<br>
	   Press the 'Skip' button to continue without entering a web site</p>
	<br>
	<form method="POST" >
	<table>
	<tr><td><label for="we_type">Web Site Type:</label></td>
		<td><select id="we_type" name="we_type" size="1">
<?php if ($type == ""){ ?>
				<option selected="selected" value="Choice">Choose Type</option>
<?php } else { ?>
				<option  value="Choice">Choose Type</option>
<?php }
	  if ($type == "Personal"){ ?>
				<option selected="selected" value="Personal">Personal</option>
<?php } else { ?>
				<option  value="Personal">Personal</option>
<?php }
	  if ($type == "Work"){ ?>
				<option selected="selected" value="Work">Work</option>
<?php } else { ?>
				<option value="Work">Work</option>
<?php }
	  if ($type == "LinkedIn"){ ?>
				<option selected="selected" value="LinkedIn">LinkedIn</option>
<?php } else { ?>
				<option value="LinkedIn">LinkedIn</option>
<?php }
	  if ($type == "FaceBook"){ ?>
				<option selected="selected" value="Facebook">Facebook</option>
<?php } else { ?>
				<option value="Facebook">Facebook</option>
<?php }
	  if ($type == "Other"){ ?>
				<option selected="selected" value="Other">Other</option>
<?php } else { ?>
				<option value="Other">Other</option>
<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for="we_url">Web Site URL</label></td>
		<td><input type="url" id="we_url" name="we_url" size="50" maxlength="50" value="<?php echo $url; ?>"></td>
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
function validateContactWeb(){
	$err_msgs = array();
	if (!isset($_POST['we_type'])){
		$err_msgs[] = "A web site type must be selected";
	} else if (isset($_POST['we_type'])){
		$type = trim($_POST['we_type']);
		if (!(($type == "Personal") || ($type == "Work") 
				|| ($type == "LinedIn")
				|| ($type == "Facebook")|| ($type == "Other"))){
			$err_msgs[] = "A web site type must be selected";
		}
	}
	if(!isset($_POST['we_url'])){
		$err_msgs[] = "The URL field must not sbe empty";
	} else {
		$url = trim($_POST['we_url']);
		if (strlen($url) == 0){
			$err_msgs[] = "The URL field must not sbe empty";
		} else if (strlen($url) > 255){
			$err_msgs[] = "The URL is too long";
		}
	}
	if (count($err_msgs) == 0){
		$_POST['we_type'] = $type;
		$_POST['we_url'] = $url;
	}
	return $err_msgs;
}
?>

<?php
function contactWebPosttoSession(){
	$_SESSION['we_type'] = $_POST['we_type'];
	$_SESSION['we_url'] = $_POST['we_url'];
}
?>

