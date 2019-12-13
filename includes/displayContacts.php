<!-- 
	File:    displayContacts.php
	Purpose: display the contact we entered
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php 
function displayContacts($db_conn){
	$field_data = array();
	$qry = "select ct_id, ct_disp_name, ad_city from contact left join contact_address on ct_id = ad_ct_id ".
		 " where ct_deleted = 'N'";
	if (isSet($_SESSION['ct_filter'])){ 
		if((strlen($_SESSION['ct_filter']) > 0)){
			$qry .= " and ct_disp_name like '%' :filter '%'";
			$field_data["filter"]= $_SESSION['ct_filter'];
		}
	}
	$qry .= " order by ct_disp_name;";
	$stmt = $db_conn->prepare($qry);
	if (!$stmt){
		echo "<p>Error in display prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
		exit(1);
	}
	
	$status = $stmt->execute($field_data);
	if ($status){
		if ($stmt->rowCount() > 0){
?>
			<table class="table table-bordered">
			<thead class="thead-light">
  			  <tr>
  			    <th scope="col">Select</th>
  			    <th scope="col">Name</th>
  			    <th scope="col">Location</th>
  			  </tr>
  			</thead>
			<tbody>  
<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
			<tr>
		  		<th scope="row"><input type="radio" name="list_select[]" value="<?php echo $row['ct_id']; ?>"></th>
     			<td><?php echo $row['ct_disp_name']; ?></td>
      			<td><?php echo $row['ad_city']; ?></td>
			</tr>
<?php } ?>
		  </tbody>
		  </table>
<?php
		} else {
			echo "<div>\n";
			echo "<p>No contacts to display</p>\n";
			echo "</div>\n";
		}
	} else {
		echo "<p>Error in display execute ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
		exit(1);
	}

?>

<?php	
}
?>

