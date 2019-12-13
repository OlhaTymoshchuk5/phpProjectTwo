<!-- 
	File:    formContactAddress.php
	Purpose: to display, validate and post to the session Address
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function formContactAddress(){
	$type = "";
	$line1 = "";
	$line2 = "";
	$line3 = "";
	$city = "";
	$province = "";
	$postcode = "";
	$country = "";
	if (isset($_SESSION['ad_type'])){
		$type = $_SESSION['ad_type'];
	} else if (isset($_POST['ad_type'])){
		$type1 = $_POST['ad_type'];
		if (($type1 == "Home") ||  ($type1 == "Work")
			|| ($type1 == "Other")){
			$type = $_POST['ad_type'];
		} 
	} 
	if (isset($_SESSION['ad_line_1'])){
		$line1 = $_SESSION['ad_line_1'];
	} else if (isset($_POST['ad_line_1'])){
		$line1 = $_POST['ad_line_1'];
	}
	if (isset($_SESSION['ad_line_2'])){
		$line2 = $_SESSION['ad_line_2'];
	} else if (isset($_POST['ad_line_2'])){
		$line2 = $_POST['ad_line_2'];
	}
	if (isset($_SESSION['ad_line_3'])){
		$line3 = $_SESSION['ad_line_3'];
	} else if (isset($_POST['ad_line_3'])){
		$line3 = $_POST['ad_line_3'];
	}
	if (isset($_SESSION['ad_city'])){
		$city = $_SESSION['ad_city'];
	} else if (isset($_POST['ad_city'])){
		$city = $_POST['ad_city'];
	}
	if (isset($_SESSION['ad_province'])){
		$province = $_SESSION['ad_province'];
	} else if (isset($_POST['ad_province'])){
		$province = $_POST['ad_province'];
	}
	if (isset($_SESSION['ad_post_code'])){
		$postcode = $_SESSION['ad_post_code'];
	} else if (isset($_POST['ad_post_code'])){
		$postcode = $_POST['ad_post_code'];
	}
	if (isset($_SESSION['ad_country'])){
		$country= $_SESSION['ad_country'];
	} else if (isset($_POST['ad_country'])){
		$country = $_POST['ad_country'];
	}

?>
    <h3>Contact Address</h3>
    <p>The Type, Address Line 1 and City are required<br>
       Press the 'Skip' button to continue without entering an Address</p>
	<br>
	<form method="POST" >
	<table>
	<tr><td><label for="ad_type">Address Type:</label></td>
		<td><select id="ad_type" name="ad_type" size="1">
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
	<tr><td><label for="ad_line_1">Address Line 1</label></td>
		<td><input type="text" id="ad_line_1" name="ad_line_1" size="50" maxlength="100" value="<?php echo $line1; ?>"></td>
	</tr>
	<tr><td><label for="ad_line_2">Address Line 2</label></td>
		<td><input type="text" id="ad_line_2" name="ad_line_2" size="50" maxlength="100" value="<?php echo $line2; ?>"></td>
	</tr>
	<tr><td><label for="ad_line_3">Address Line 3</label></td>
		<td><input type="text" id="ad_line_3" name="ad_line_3" size="50" maxlength="100" value="<?php echo $line3; ?>"></td>
	</tr>
	<tr><td><label for="ad_city">City</label></td>
		<td><input type="text" id="ad_city" name="ad_city" size="30" maxlength="50" value="<?php echo $city; ?>"></td>
	</tr>
	<tr><td><label for="ad_province">Province</label></td>
		<td><input type="text" id="ad_province" name="ad_province" size="30" maxlength="50" value="<?php echo $province; ?>"></td>
	</tr>
	<tr><td><label for="ad_post_code">Post Code</label></td>
		<td><input type="text" id="ad_post_code" name="ad_post_code" size="30" maxlength="50" value="<?php echo $postcode; ?>"></td>
	</tr>
	<tr><td><label for="ad_country">Country</label></td>
		<td><input type="text" id="ad_country" name="ad_country" size="30" maxlength="50" value="<?php echo $country; ?>"></td>
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
function validateContactAddress(){
	$err_msgs = array();
	if (!isset($_POST['ad_type'])){
		$err_msgs[] = "An address type must be selected";
	} else if (isset($_POST['ad_type'])){
		$type = trim($_POST['ad_type']);
		if (!(($type == "Home") || ($type == "Work") || ($type == "Other"))){
			$err_msgs[] = "A valid address type must be select5ed";
		}
	}
	if(!isset($_POST['ad_line_1'])){
		$err_msgs[] = "The first address line must not be empty";
	} else {
		$line1 = trim($_POST['ad_line_1']);
		if (strlen($line1) == 0){
			$err_msgs[] = "The first address line must not be empty";
		} else if (strlen($line1) > 100){
			$err_msgs[] = "The first address line is too long";
		}
	}
	if(isset($_POST['ad_line_2'])){
		$line2 = trim($_POST['ad_line_2']);
		if (strlen($line2) > 100){
			$err_msgs[] = "The second address line is too long";
		}
	}
	if(isset($_POST['ad_line_3'])){
		$line3 = trim($_POST['ad_line_3']);
		if (strlen($line3) > 100){
			$err_msgs[] = "The third address line is too long";
		}
	}
	if(!isset($_POST['ad_city'])){
		$err_msgs[] = "A city name must be entered";
	} else {
		$city = trim($_POST['ad_city']);
		if (strlen($city) == 0){
			$err_msgs[] = "A city name must be entered";
		} else if (strlen($city) > 50){
			$err_msgs[] = "The city name is too long";
		}
	}
	if(isset($_POST['ad_province'])){
		$prov = trim($_POST['ad_province']);
		if (strlen($prov) > 50){
			$err_msgs[] = "The province field is too long";
		}
	}
	if(isset($_POST['ad_post_code'])){
		$post = trim($_POST['ad_post_code']);
		if (strlen($post) > 15){
			$err_msgs[] = "The post code field is too long";
		}
	}
	if(isset($_POST['ad_country'])){
		$country = trim($_POST['ad_country']);
		if (strlen($country) > 50){
			$err_msgs[] = "The country field is too long";
		}
	}
	if (count($err_msgs) == 0){
		$_POST['ad_type'] = $type;
		$_POST['ad_line_1'] = $line1;
		$_POST['ad_city'] = $city;
	}
	return $err_msgs;
}
?>

<?php
function contactAddressPosttoSession(){
	$_SESSION['ad_type'] = $_POST['ad_type'];
	$_SESSION['ad_line_1'] = $_POST['ad_line_1'];
	$_SESSION['ad_city'] = $_POST['ad_city'];
	$_SESSION['ad_line_2'] = (isset($_POST['ad_line_2'])) ? 
								trim($_POST['ad_line_2']) : "";
	$_SESSION['ad_line_3'] = (isset($_POST['ad_line_3'])) ? 
								trim($_POST['ad_line_3']) : "";
	$_SESSION['ad_province'] = (isset($_POST['ad_province'])) ? 
								trim($_POST['ad_province']) : "";
	$_SESSION['ad_post_code'] = (isset($_POST['ad_post_code'])) ? 
								trim($_POST['ad_post_code']) : "";
	$_SESSION['ad_country'] = (isset($_POST['ad_country'])) ? 
								trim($_POST['ad_country']) : "";
}
?>

