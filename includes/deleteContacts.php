<!-- 
	File:    deleteContacts.php
	Purpose: soft delete part
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function deleteContact($db_conn){
  $filter_data = array();
  // Update table Contact
  $qry = "update contact set ct_deleted = ? where ct_id =?";
  $filter_data[] = 'Y';
  $filter_data[] = $_SESSION['ct_id'];

  $stmt = $db_conn->prepare($qry);
  if (!$stmt){
      echo "<p>Error in contact prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
      exit(1);
  }
  $status = $stmt->execute($filter_data);
  if (!$status){
      echo "<p>Error in contact execute: ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
      exit(1);
  } 
}

  

?>

