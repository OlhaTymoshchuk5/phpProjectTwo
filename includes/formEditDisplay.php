<!-- 
	File:    formViewDetails.php
	Purpose: Show detais of a select contacts
	Authors: Barbara Bianca Zacchi
		    	 Millene L B S Cesconetto
			     Olha Tymoshchuk 
-->
<?php


function formViewEdit($db_conn){
	//create the session for the first time from db
	if($_SESSION['edit_part']== 1){
		$filter_data = array();
		$qry = "select * from contact c";
		$qry .= " left join contact_address ca ON c.ct_id = ca.ad_ct_id";
		$qry .= " left join contact_phone cp ON c.ct_id= cp.ph_ct_id";
		$qry .= " left join contact_email ce ON c.ct_id= ce.em_ct_id";
		$qry .= " left join contact_web cw   ON c.ct_id= cw.we_ct_id";
		$qry .= " left join contact_note cn  ON c.ct_id= cn.no_ct_id";
		$qry .= " where ct_id = ?";
		$filter_data[] = $_SESSION['ct_id']; 
	  $stmt = $db_conn->prepare($qry);
		if (!$stmt){
			echo "<p>Error in display prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
			exit(1);
		}
		$status = $stmt->execute($filter_data);
	
		if(!$status){
			echo "Error ".$stmt->errorCode()."\nMessage ".implode($stmt->errorInfo())."\n";
						$status = "ExecuteFail";
					}
	
		if ($status){
		  if ($stmt->rowCount() > 0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				if (isset($row['ct_type'])){
					$_SESSION['ct_type']=$row['ct_type'];
				}
				if (isset($row['ct_id'])){
					$_SESSION['ct_id']=$row['ct_id'];
				}
				if (isset($row['ct_first_name'])){
					$_SESSION['ct_first_name']= $row['ct_first_name'];
				}
				if (isset($row['ct_last_name'])){
					$_SESSION['ct_last_name']= $row['ct_last_name'];
				}
				if (isset($row['ct_disp_name'])){
					$_SESSION['ct_disp_name']= $row['ct_disp_name'];
				}
				if (isset($row['ad_type'])){
					$_SESSION['ad_type']= $row['ad_type'];
				}
				if (isset($row['ad_line_1'])){
					$_SESSION['ad_line_1']= $row['ad_line_1'];
				}
				if (isset($row['ad_line_2'])){
					$_SESSION['ad_line_2']= $row['ad_line_2'];
				}
				if (isset($row['ad_line_3'])){
					$_SESSION['ad_line_3']= $row['ad_line_3'];
				}
				if (isset($row['ad_city'])){
					$_SESSION['ad_city']= $row['ad_city'];
				}
				if (isset($row['ad_province'])){
					$_SESSION['ad_province']= $row['ad_province'];
				}
				if (isset($row['ad_post_code'])){
					$_SESSION['ad_post_code']= $row['ad_post_code'];
				}
				if (isset($row['ad_country'])){
					$_SESSION['ad_country']= $row['ad_country'];
				}
				if (isset($row['ph_type'])){
					$_SESSION['ph_type']= $row['ph_type'];
				}
				if (isset($row['ph_number'])){
					$_SESSION['ph_number']= $row['ph_number'];
				}
				if (isset($row['em_type'])){
					$_SESSION['em_type']= $row['em_type'];
				}
				if (isset($row['em_email'])){
					$_SESSION['em_email']= $row['em_email'];
				}
				if (isset($row['we_type'])){
					$_SESSION['we_type']= $row['we_type'];
				}
				if (isset($row['we_url'])){
					$_SESSION['we_url']= $row['we_url'];;
				}
				if (isset($row['no_note'])){
					$_SESSION['no_note']= $row['no_note'];
				}
			}
		  }		  
	   };
	}
		
?>
<form method="POST" >
    <table border="1" width="100%">
	  <tr>
	  	<td colspan="2" align="Center">Sumary</td>
	  </tr>
       <tr>
	  	<td colspan="2" align="Center" class="bg-success">Contact</td>
	   </tr>
<?php if(isset($_SESSION['ct_type'])){ $t = $_SESSION['ct_type']; ?>

	  <tr>
	  	<td>Type</td>
	  	<td><select class="custom-select" id="ct_type" name="ct_type" size="1">
<?php if((strlen($t) == 0) ){ ?>
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
<?php }
   if(isset($_SESSION['ct_first_name'])){ $fname = $_SESSION['ct_first_name'];
?>

<tr>
	  <td>First Name</td>
      <td><input type="text" name="ct_first_name" id="ct_first_name" size="40" maxlength="100"  value="<?php echo $fname; ?>"></td>
</tr>

<?php }
   if(isset($_SESSION['ct_last_name'])){ $lname = $_SESSION['ct_last_name'];
?>

<tr>
      <td><label for="ct_last_name">Last Name</label></td>
		  <td><input type="text" name="ct_last_name" id="ct_last_name" size="40" maxlength="100"  value="<?php echo $lname; ?>"></td>
</tr>


<?php }
   if(isset($_SESSION['ct_disp_name'])){ $dname = $_SESSION['ct_disp_name'];
?>
<tr>
      <td><label for="ct_disp_name">Display Name</label></td>
      <td><input type="text" name="ct_disp_name" id="ct_disp_name" size="40" maxlength="200" value="<?php echo $dname; ?>"></td>
</tr>

<?php }
   if(isset($_SESSION['ad_type'])){ $type = $_SESSION['ad_type'];
?>
<tr>
      <td><label for="ad_type">Address Type:</label></td>
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


<?php }
   if(isset($_SESSION['ad_line_1'])){ $line1 = $_SESSION['ad_line_1'];
?>
<tr>
    <td><label for="ad_line_1">Address Line 1</label></td>
		<td><input type="text" id="ad_line_1" name="ad_line_1" size="40" maxlength="100" value="<?php echo $line1; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['ad_line_2'])){ $line2 = $_SESSION['ad_line_2'];
?>
<tr>
    <td><label for="ad_line_2">Address Line 2</label></td>
		<td><input type="text" id="ad_line_2" name="ad_line_2" size="40" maxlength="100" value="<?php echo $line2; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['ad_line_3'])){ $line3 = $_SESSION['ad_line_3'];
?>
<tr>
    <td><label for="ad_line_3">Address Line 3</label></td>
		<td><input type="text" id="ad_line_3" name="ad_line_3" size="40" maxlength="100" value="<?php echo $line3; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['ad_city'])){ $city = $_SESSION['ad_city'];
?>
<tr>
    <td><label for="ad_city">City</label></td>
		<td><input type="text" id="ad_city" name="ad_city" size="40" maxlength="50" value="<?php echo $city; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['ad_province'])){ $province = $_SESSION['ad_province'];
?>
<tr>
    <td><label for="ad_province">Province</label></td>
		<td><input type="text" id="ad_province" name="ad_province" size="40" maxlength="50" value="<?php echo $province; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['ad_post_code'])){ $postcode = $_SESSION['ad_post_code'];
?>
<tr>
    <td><label for="ad_post_code">Post Code</label></td>
		<td><input type="text" id="ad_post_code" name="ad_post_code" size="40" maxlength="50" value="<?php echo $postcode; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['ad_country'])){ $country = $_SESSION['ad_country'];
?>
<tr>
    <td><label for="ad_country">Country</label></td>
		<td><input type="text" id="ad_country" name="ad_country" size="40" maxlength="50" value="<?php echo $country; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['ph_type'])){ $type = $_SESSION['ph_type'];
?>
<tr>
    <td><label for="ph_type">Phone # Type:</label></td>
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
<?php }
   if(isset($_SESSION['ph_number'])){ $number = $_SESSION['ph_number'];
?>
<tr>
    <td><label for="ph_number">Phone Number</label></td>
		<td><input type="tel" id="ph_number" name="ph_number" size="40" maxlength="50" value="<?php echo $number; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['em_type'])){ $type = $_SESSION['em_type'];
?>
<tr>
    <td><label for="em_type">Email Type:</label></td>
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
<?php }
   if(isset($_SESSION['em_email'])){ $email = $_SESSION['em_email'];
?>
<tr>
    <td><label for="em_email">Email Address</label></td>
		<td><input type="email" id="em_email" name="em_email" size="40" maxlength="50" value="<?php echo $email; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['we_type'])){ $type = $_SESSION['we_type'];
?>
<tr>
    <td><label for="we_type">Web Site Type:</label></td>
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
	<?php }
   if(isset($_SESSION['we_url'])){ $url = $_SESSION['we_url'];
?>
<tr>
    <td><label for="we_url">Web Site URL</label></td>
		<td><input type="url" id="we_url" name="we_url" size="40" maxlength="50" value="<?php echo $url; ?>"></td>
</tr>
<?php }
   if(isset($_SESSION['no_note'])){ $note = $_SESSION['no_note'];
?>
<tr>
    <td><label for="no_note">Note</label></td>
		<td><textarea id="no_note" name="no_note" rows="10" cols="40" maxlength="65530" ><?php echo $note; ?></textarea></td>
</tr>
<?php } ?>
</table>


    <div class="col-12 py-2" style="text-align: center;">
     <input type="submit" class="btn btn-success" name="ct_b_update" value="Update">
     <input type="submit" class="btn btn-success" name="ct_b_cancel" value="Cancel">
    </div>
    </form> 
<?php
} //close function
?>
