<!-- 
	File:    saveEditForm.php
	Purpose: uddate the contact in the db
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php 

function editContact($db_conn){

	$field_data = array();
	$qry_ct = "update contact set ct_type= ?";
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

	$qry_ct .= " where ct_id =?;";
	$field_data[] = $_SESSION['ct_id'];


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


	unset($field_data);

	$field_data = array();
	if (isset($_SESSION['ad_type'])){

		$qry_ad = "update contact_address set ad_type= ?";
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
		$qry_ad .= ", ad_active= ?";
		$field_data[] = "y";
	        $qry_ad .= " where ad_ct_id= ?;";
		$field_data[] = $_SESSION['ct_id'];

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
		$qry_ph = "update contact_phone set ph_type = ?";
		$field_data[] = $_SESSION['ph_type'];
		if (isset($_SESSION['ph_number'])){
			$qry_ph .= ", ph_number= ?";
			$field_data[] = $_SESSION['ph_number'];
		}
		$qry_ph .= " where ph_ct_id= ?";
		$field_data[] = $_SESSION['ct_id']; 
//print_r($field_data);
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
		$qry_em = "update contact_email set em_type  = ?";

		$field_data[] = $_SESSION['em_type'];
		if (isset($_SESSION['em_email'])){
			$qry_em .= ", em_email= ?";
			$field_data[] = $_SESSION['em_email'];
		}
		$qry_em .= ", em_active= ?";
		$field_data[] = "Y";
		$qry_em .= "where em_ct_id= ?;";
		$field_data[] = $_SESSION['ct_id'];
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
		$qry_we = "update contact_web  set we_type = ?";
		$field_data[] = $_SESSION['we_type'];
		if (isset($_SESSION['we_url'])){
			$qry_we .= ", we_url= ?";
			$field_data[] = $_SESSION['we_url'];
		}
		$qry_we .= ", we_active= ?";
		$field_data[] = "Y";
		$qry_we .= "where we_ct_id= ?;";
		$field_data[] = $_SESSION['ct_id'];
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
		$qry_no = "update contact_note set no_type= ?";
		$field_data[] = "";
		$qry_no .= ", no_note= ?";
		$field_data[] = $_SESSION['no_note'];
		$qry_no .= " where no_ct_id= ?;";
		$field_data [] =  $_SESSION['ct_id'];
		
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
//echo "REGISTRO ALTERADO!"; 
//print_r($qry_no);

}



?>