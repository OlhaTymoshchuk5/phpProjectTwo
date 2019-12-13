 <!-- 
	File:    formContactName.php
	Purpose: to display validate and post into session Name
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
 <?php
function formContactName(){
	$fname = "";
	$lname = "";
	$dname = "";
	if (isset($_SESSION['ct_first_name'])){
		$fname = $_SESSION['ct_first_name'];
	} else if (isset($_POST['ct_first_name'])){
		$fname = $_POST['ct_first_name'];
	}
	if (isset($_SESSION['ct_last_name'])){
		$lname = $_SESSION['ct_last_name'];
	} else if (isset($_POST['ct_last_name'])){
		$lname = $_POST['ct_last_name'];
	}
	if (isset($_SESSION['ct_disp_name'])){
		$dname = $_SESSION['ct_disp_name'];
	} else if (isset($_POST['ct_disp_name'])){
		$dname = $_POST['ct_disp_name'];
	}
?>
    <h3>Contact Name</h3>
    <p>For Business Contacts the Busness Name is required<br>
       For other types of contacts the first and last names are required</p>
	<br>
	<form method="POST" >
	<table>
	<tr><td><label for="ct_first_name">First Name</label></td>
		<td><input type="text" name="ct_first_name" id="ct_first_name" size="50" maxlength="100" value="<?php echo $fname; ?>"></td>
	</tr>
	<tr><td><label for="ct_last_name">Last Name</label></td>
		<td><input type="text" name="ct_last_name" id="ct_last_name" size="50" maxlength="100" value="<?php echo $lname; ?>"></td>
	</tr>
<?php if ($_SESSION['ct_type'] == "Business"){ ?>
	<tr><td><label for="ct_disp_name">Business Name</label></td>
<?php } else{ ?>
	<tr><td><label for="ct_disp_name">Display Name</label></td>
<?php } ?>
		<td><input type="text" name="ct_disp_name" id="ct_disp_name" size="50" maxlength="200" value="<?php echo $dname; ?>"></td>
	</tr>
	</table>
	<br>
	<div class="row">
	    <div class="col-6" style="text-align: left;">
		<input type="submit" name="ct_b_cancel" value="Cancel">
		</div>
	    <div class="col-6" style="text-align: right;">
		<input type="submit" name="ct_b_back" value="Back">             
	    <input type="submit" name="ct_b_next" value="Next">

	    </div>
	  </div>
	</form>
<?php
}
?>

<?php
function validateContactName(){
	$err_msgs = array();
	if ($_SESSION['ct_type'] == "Business"){
		if (!isset($_POST['ct_disp_name'])){
			$err_msgs[] = "A business name nust be specified";
		} else {
			$dname = trim($_POST['ct_disp_name']);
			if (strlen($dname) == 0){
				$err_msgs[] = "A business name nust be specified";
			} else if (strlen($dname) > 200) {
				$err_msgs[] = "The business name nust be no longer than 200 characters in length.";
			}
		}
		if (count($err_msgs) == 0){
			$_SESSION['ct_disp_name'] = $dname;
			$_SESSION['ct_first_name'] = (isset($_POST['ct_first_name'])) ?
										 trim($_POST['ct_first_name']) :
										 "";
			$_SESSION['ct_last_name'] = (isset($_POST['ct_last_name'])) ?
										trim($_POST['ct_last_name']) :
										"";
		}
	} else {
		if (!isset($_POST['ct_first_name'])){
			$err_msgs[] = "A first name numbe be specified";
		}else {
			$fname = trim($_POST['ct_first_name']);
			if (strlen($fname) == 0){
				$err_msgs[] = "A first name numbe be specified";
			} else if (strlen($fname) > 100) {
				$err_msgs[] = "The first name nust be no longer than 100 characters in length.";
			}
		}

		if (!isset($_POST['ct_last_name'])){
			$err_msgs[] = "A last name numbe be specified";
		}else {
			$lname = trim($_POST['ct_last_name']);
			if (strlen($lname) == 0){
				$err_msgs[] = "A last name numbe be specified";
			} else if (strlen($lname) > 100) {
				$err_msgs[] = "The last name nust be no longer than 100 characters in length.";
			}
		}


		
		if (isset($_POST['ct_disp_name'])){
			$dname = trim($_POST['ct_disp_name']);
			if (strlen($dname) > 200) {
				$err_msgs[] = "The display name nust be no longer than 200 characters in length.";
			}
		}

		if (count($err_msgs) == 0){
			$_POST['ct_first_name'] = $fname;
			$_POST['ct_last_name'] = $lname;
			if (strlen($dname) > 0){
				$_POST['ct_disp_name'] = $dname;
			} else {
				if ((strlen($fname) > 0) && (strlen($lname) > 0)){
				$_POST['ct_disp_name'] = $lname.", ".$fname;
			 	} else if (strlen($lname) > 0) {
				 		$_POST['ct_disp_name'] = $lname;
				} else {
				 		$_POST['ct_disp_name'] = $fname;
				}
			}
			// if ((!isset($_POST['ct_disp_name'])) && (strlen($dname) > 0)){
			// 	$_POST['ct_disp_name'] = $dname;
			// 	
			// } else {
			// 	print_r('else');
			// 	if ((strlen($fname) > 0) && (strlen($lname) > 0)){
			// 		$_POST['ct_disp_name'] = $lname.", ".$fname;
			// 	} else if (strlen($lname) > 0) {
			// 		$_POST['ct_disp_name'] = $lname;
			// 	} else {
			// 		$_POST['ct_disp_name'] = $fname;
			// 	}
			// }
		}
	}
	return $err_msgs;
}
?>

<?php
function contactNamePostToSession(){
	$_SESSION['ct_first_name'] = $_POST['ct_first_name'];
	$_SESSION['ct_last_name'] = $_POST['ct_last_name'];
	$_SESSION['ct_disp_name'] = $_POST['ct_disp_name'];
}
?>
