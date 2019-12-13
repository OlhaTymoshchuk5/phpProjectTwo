<!-- 
	File:    formContactSave.php
	Purpose: display validate and insert contact to db
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function formContactSave(){
?>
	<h3>Save Contact </h3>
	<form method="POST" >
	<table>
	<tr><td>Contact Type</d><td><?php echo $_SESSION['ct_type']; ?></td></tr>
	<tr><td>Display/Business Name</d><td><?php echo $_SESSION['ct_disp_name']; ?></td></tr>
	<tr><td>First Name</td><td><?php echo $_SESSION['ct_first_name']; ?></td></tr>
	<tr><td>Last Name</td><td><?php echo $_SESSION['ct_last_name']; ?></td></tr>
<?php if (isset($_SESSION['ad_type'])){ ?>
	<tr><td><br></td><td></td></tr>
	<tr><td>Address Type</td><td><?php echo $_SESSION['ad_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_line_1'])){ ?>
	<tr><td>Address Line 1</td><td><?php echo $_SESSION['ad_line_1']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_line_2'])){ ?>
	<tr><td>Address Line 2</td><td><?php echo $_SESSION['ad_line_2']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_line_3'])){ ?>
	<tr><td>Address Line 3</td><td><?php echo $_SESSION['ad_line_3']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_city'])){ ?>
	<tr><td>City</td><td><?php echo $_SESSION['ad_city']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_province'])){ ?>
	<tr><td>Province</td><td><?php echo $_SESSION['ad_province']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_post_code'])){ ?>
	<tr><td>Post Code</td><td><?php echo $_SESSION['ad_post_code']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_country'])){ ?>
	<tr><td>Country</td><td><?php echo $_SESSION['ad_country']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ph_type'])){ ?>
	<tr><td><br></td><td></td></tr>
	<tr><td>Phone Type</td><td><?php echo $_SESSION['ph_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ph_number'])){ ?>
	<tr><td>Phone Number</td><td><?php echo $_SESSION['ph_number']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['em_type'])){ ?>
	<tr><td><br></td><td></td></tr>
	<tr><td>Email Type</td><td><?php echo $_SESSION['em_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['em_email'])){ ?>
	<tr><td>Email Address</td><td><?php echo $_SESSION['em_email']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['we_type'])){ ?>
	<tr><td><br></td><td></td></tr>
	<tr><td>Web Site Type</td><td><?php echo $_SESSION['we_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['we_url'])){ ?>
	<tr><td>Web Site URL</td><td><?php echo $_SESSION['we_url']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['no_note'])){ ?>
	<tr><td><br></td><td></td></tr>
	<tr><td>Note</td><td><?php echo $_SESSION['no_note']; ?></td></tr>
<?php } ?>
	</table>
    <table>
    <tr>
        <td><input type="submit" name="ct_b_back" value="Back"></td>
        <td><input type="submit" name="ct_b_next" value="Save"></td>
    </tr>
    <tr>
		<td><input type="submit" name="ct_b_cancel" value="Cancel"></td>
    </tr>
    </table>
	</form>
<?php
}
?>
<?php
function saveContact($db_conn){
	$field_data = array();
	$qry_ct = "insert into contact set ct_type= ?";
	$field_data[] = $_SESSION['ct_type'];
	if (isset($_SESSION['ct_first_name'])){
		$qry_ct .= ", ct_first_name= ?";
		$field_data[] = $_SESSION['ct_first_name'];
	}
	if (isset($_SESSION['ct_last_name'])){
		$qry_ct .= ", ct_last_name= ?";
		$field_data[] = $_SESSION['ct_last_name'];
	}
	if (isset($_SESSION['ct_disp_name'])){
		$qry_ct .= ", ct_disp_name= ?";
		$field_data[] = $_SESSION['ct_disp_name'];
	}
	$qry_ct .= ", ct_deleted= ?";
	$field_data[] = "N";
	$stmt = $db_conn->prepare($qry_ct);
	if (!$stmt){
		echo "<p>Error in contact prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
		exit(1);
	}
	$status = $stmt->execute($field_data);
	if (!$status){
		echo "<p>Error in contact execute: ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
		exit(1);
	}
	$id = $db_conn->lastInsertId();
	unset($field_data);

	$field_data = array();
	if (isset($_SESSION['ad_type'])){
		$qry_ad = "insert into contact_address set ad_ct_id= ?, ad_type= ?";
		$field_data[] = $id;
		$field_data[] = $_SESSION['ad_type'];
		if (isset($_SESSION['ad_line_1'])){
			$qry_ad .= ", ad_line_1= ?";
			$field_data[] = $_SESSION['ad_line_1'];
		}
		if (isset($_SESSION['ad_line_2'])){
			$qry_ad .= ", ad_line_2= ?";
			$field_data[] = $_SESSION['ad_line_2'];
		}
		if (isset($_SESSION['ad_line_3'])){
			$qry_ad .= ", ad_line_3= ?";
			$field_data[] = $_SESSION['ad_line_3'];
		}
		if (isset($_SESSION['ad_city'])){
			$qry_ad .= ", ad_city= ?";
			$field_data[] = $_SESSION['ad_city'];
		}
		if (isset($_SESSION['ad_province'])){
			$qry_ad .= ", ad_province= ?";
			$field_data[] = $_SESSION['ad_province'];
		}
		if (isset($_SESSION['ad_post_code'])){
			$qry_ad .= ", ad_post_code= ?";
			$field_data[] = $_SESSION['ad_post_code'];
		}
		if (isset($_SESSION['ad_contry'])){
			$qry_ad .= ", ad_country= ?";
			$field_data[] = $_SESSION['ad_country'];
		}
		$qry_ad .= ", ad_active= ?;";
		$field_data[] = "y";
		$stmt = $db_conn->prepare($qry_ad);
		if (!$stmt){
			echo "<p>Error in address prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
			exit(1);
		}
		$status = $stmt->execute($field_data);
		if (!$status){
			echo "<p>Error in address execute ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
			exit(1);
		}
	}
	unset($field_data);

	$field_data = array();
	if (isset($_SESSION['ph_type'])){
		$qry_ph = "insert into contact_phone  set ph_ct_id= ?, ph_type = ?";
		$field_data[] = $id;
		$field_data[] = $_SESSION['ph_type'];
		if (isset($_SESSION['ph_number'])){
			$qry_ph .= ", ph_number= ?";
			$field_data[] = $_SESSION['ph_number'];
		}
		$qry_ph .= ", ph_active= ?;";
		$field_data[] = "Y";
		$stmt = $db_conn->prepare($qry_ph);
		if (!$stmt){
			echo "<p>Error in phones prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
			exit(1);
		}
		$status = $stmt->execute($field_data);
		if (!$status){
			echo "<p>Error in phone execute ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
			exit(1);
		}
	}
	unset($field_data);

	$field_data = array();
	if (isset($_SESSION['em_type'])){
		$qry_em = "insert into contact_email  set em_ct_id= ?, em_type  = ?";
		$field_data[] = $id;
		$field_data[] = $_SESSION['em_type'];
		if (isset($_SESSION['em_email'])){
			$qry_em .= ", em_email= ?";
			$field_data[] = $_SESSION['em_email'];
		}
		$qry_em .= ", em_active= ?;";
		$field_data[] = "Y";
		$stmt = $db_conn->prepare($qry_em);
		if (!$stmt){
			echo "<p>Error in email prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
			exit(1);
		}
		$status = $stmt->execute($field_data);
		if (!$status){
			echo "<p>Error in email execute ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
			exit(1);
		}
	}
	unset($field_data);

	$field_data = array();
	if (isset($_SESSION['we_type'])){
		$qry_we = "insert into contact_web  set we_ct_id= ?, we_type = ?";
		$field_data[] = $id;
		$field_data[] = $_SESSION['we_type'];
		if (isset($_SESSION['we_url'])){
			$qry_we .= ", we_url= ?";
			$field_data[] = $_SESSION['we_url'];
		}
		$qry_we .= ", we_active= ?";
		$field_data[] = "Y";
		$stmt = $db_conn->prepare($qry_we);
		if (!$stmt){
			echo "<p>Error in URL prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
			exit(1);
		}
		$status = $stmt->execute($field_data);
		if (!$status){
			echo "<p>Error in URL execute ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
			exit(1);
		}
	}
	unset($field_data);

	$field_data = array();
	if (isset($_SESSION['no_note'])){
		$qry_no = "insert into contact_note  set no_ct_id= ?";
		$field_data[] = $id;
		$qry_no .= ", no_type= ?";
		$field_data[] = "";
		$qry_no .= ", no_note= ?";
		$field_data[] = $_SESSION['no_note'];
		$stmt = $db_conn->prepare($qry_no);
		if (!$stmt){
			echo "<p>Error in note prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
			exit(1);
		}
		$status = $stmt->execute($field_data);
		if (!$status){
			echo "<p>Error in note execute ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
			exit(1);
		}
	}
	unset($field_data);
}
?>
