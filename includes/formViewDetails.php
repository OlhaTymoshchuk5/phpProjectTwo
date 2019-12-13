<!-- 
	File:    formViewDetails.php
	Purpose: Show detais of  select contacts
	Authors: Barbara Bianca Zacchi
		    	 Millene L B S Cesconetto
			     Olha Tymoshchuk 
-->
<?php
function formViewDetails($db_conn){
  $filter_data = array();
  // Read first table Contacts
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
	if ($status){
		if ($stmt->rowCount() > 0){
?>
    <table border="1" width="100%">
	  <tr>
	  	<td colspan="2" align="Center">Sumary</td>
	  </tr>
       <tr>
	  	<td colspan="2" align="Center" class="bg-success">Contact</td>
	   </tr>
<?php
     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
?>
	  <tr>
	  	<td>Type</td>
	  	<td><?php  echo  $row['ct_type']; ?></td>
	  </tr>

	  <tr>
	  	<td>First Name</td>
        <td><?php  echo  $row['ct_first_name']; ?></td>
  	  </tr>

	  <tr>
		<td>Last Name</td>
        <td><?php  echo  $row['ct_last_name']; ?></td>
	  </tr>

	  <tr>
		<td>Display Name</td>
        <td><?php  echo  $row['ct_disp_name']; ?></td>
	  </tr>
<?php
      if (isset($row['ad_type'])){
?>
                <tr>
                  <td colspan="2" align="Center" class="bg-success">Contact Address</td>
                </tr>
                    <tr>
                      <td>Type</td>
                      <td><?php  echo  $row['ad_type']; ?></td>
                    </tr>

                    <tr>
                      <td>Address Line 1	</td>
                      <td><?php  echo  $row['ad_line_1']; ?></td>
                    </tr>

                    <tr>
                      <td>Address Line 2</td>
                        <td><?php  echo  $row['ad_line_2']; ?></td>
                      </td>
                    </tr>

                    <tr>
                      <td>Address Line 3</td>
                        <td><?php  echo  $row['ad_line_3']; ?></td>
                      </td>
                    </tr>

                    <tr>
                      <td>City</td>
                        <td><?php  echo  $row['ad_city']; ?></td>
                      </td>
                    </tr>

                    <tr>
                      <td>Province</td>
                        <td><?php  echo  $row['ad_province']; ?></td>
                      </td>
                    </tr>

                    <tr>
                      <td>Post Code</td>
                        <td><?php  echo  $row['ad_post_code']; ?></td>
                      </td>
                    </tr>

                    <tr>
                      <td>Country</td>
                        <td><?php  echo  $row['ad_country']; ?></td>
                      </td>
                    </tr>
<?php
            }//close if adre
            if (isset($row['ph_type'])){
?>
                <tr>
                  <td colspan="2" align="Center" class="bg-success">Contact Phone</td>
                </tr>
                    <tr>
                      <td>Type</td>
                      <td><?php  echo  $row['ph_type']; ?></td>
                    </tr>
                                
                    <tr>
                      <td>Phone</td>
                      <td><?php  echo  $row['ph_number']; ?></td>
                    </tr>
   
<?php
            }//close if pho
              if (isset($row['em_type'])){
?>
                <tr>
                  <td colspan="2" align="Center" class="bg-success">Contact Web</td>
                </tr>
                    <tr>
                      <td>Type</td>
                      <td><?php  echo  $row['em_type']; ?></td>
                    </tr>

                    <tr>
                      <td>E-mail</td>
                      <td><?php  echo  $row['em_email']; ?></td>
                    </tr>
<?php
            }//close if email
           if (isset($row['we_type'])){
?>
                <tr>
                  <td colspan="2" align="Center" class="bg-success">Contact Web</td>
                  </tr>
                    <tr>
                      <td>Type</td>
                      <td><?php  echo  $row['we_type']; ?></td>
                    </tr>

                    <tr>
                      <td>URL</td>
                      <td><?php  echo  $row['we_url']; ?></td>
                    </tr>
<?php
            }//if web
                if (isset($row['no_note'])){
?>
                <tr>
                  <td colspan="2" align="Center" class="bg-success">Contact Notes</td>
                </tr>
                    <tr>
                      <td>Note</td>
                      <td><?php  echo  $row['no_note']; ?></td>
                    </tr>
<?php
            }//close if note
?>
    </table>
<?php
     }
        }//close stmt1
    }//close status1    
?>
    <form method="POST" >
    <div class="col-12 py-2" style="text-align: center;">
     <input type="submit" class="btn btn-success" name="ct_b_cancel" value="Return">
    </div>
    </form> 
<?php
} //close function
?>