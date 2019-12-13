<?php 
	session_start(); 
	if (!isset($_SESSION['mode'])){
		$_SESSION['mode'] = "Display";
	}
	require_once("./includes/db_connection.php"); 
	require_once("./includes/displayContacts.php"); 
	require_once("./includes/formContactType.php");
	require_once("./includes/formContactName.php");
	require_once("./includes/formContactAddress.php");
	require_once("./includes/formContactPhone.php");
	require_once("./includes/formContactEmail.php");
	require_once("./includes/formContactWeb.php");
	require_once("./includes/formContactNote.php");
	require_once("./includes/formContactSave.php");
	require_once("./includes/clearAddContactFromSession.php");
	require_once("./includes/displayErrors.php");
	require_once("./includes/formViewDetails.php");
	require_once("./includes/deleteContacts.php");
	require_once("./includes/formEditDisplay.php");
	require_once("./includes/saveEditForm.php");
?>
<!-- 
	File:    index.php
	Purpose: Application home page
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<html>
  <head>
      <meta charset="utf-8">
	  <title>Contact List</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
<body>
<div class="content">
	<div class="row pt-5">
	   <div class="col-2"> </div>
	   <div class="col-8">
		<h1> Contacts </h1>
<?php  
  
if (isset($_POST['ct_b_add']) && ($_POST['ct_b_add'] == "Add New Contact")){
	$_SESSION['mode'] = "Add";
	$_SESSION['add_part'] = 0;
} else if (isset($_POST['ct_b_edit']) && ($_POST['ct_b_edit'] == "Edit")){
	$_SESSION['edit_part'] = 0;
	$_SESSION['mode'] = "Edit";
} else if (isset($_POST['ct_b_delete']) && ($_POST['ct_b_delete'] == "Delete")){
	$_SESSION['mode'] = "Delete";
} else if (isset($_POST['ct_b_view_details']) && ($_POST['ct_b_view_details'] == "View Details")){
	$_SESSION['mode'] = "View";
} else if (isset($_POST['ct_b_update']) && ($_POST['ct_b_update'] == "Update")){
	//echo "I entered here";
	$_SESSION['edit_part'] = 1;
	$_SESSION['mode'] = "Edit";
} else if (isset($_POST['ct_b_cancel']) && ($_POST['ct_b_cancel'] == "Cancel")){

	if ($_SESSION['mode'] == "Add"){
		$_SESSION['add_part'] = 0;
		clearAddContactFromSession();
	} 
	if ($_SESSION['mode'] == 'Edit'){
		$_SESSION['edit_part'] = 0;
		echo 'esdfsdfs';
		clearAddContactFromSession();
	}
	$_SESSION['mode'] = "Display";
}

//print_r($_SESSION);

if(($_SESSION['mode'] == "Add") && ($_SERVER['REQUEST_METHOD'] == "GET")){ 
	switch ($_SESSION['add_part']) {
		case 0:
		case 1:
			formContactType();
			break;
		case 2:
			formContactName();
			break;
		case 3:
			formContactAddress();
			break;
		case 4:
			formContactPhone();
			break;
		case 5:
			formContactEmail();
			break;
		default:
	}
} else if($_SESSION['mode'] == "Add"){ 
	switch ($_SESSION['add_part']) {
		case 0:
			echo '<h4 class="text-success"> Add New Contact - 1/8 </h4>';
			$_SESSION['add_part'] = 1;
			formContactType();
			break;
		case 1:
	    	$err_msgs = validateContactType();
			if (count($err_msgs) > 0){
				displayErrors($err_msgs);
				echo '<h4 class="text-success"> Add New Contact - 1/8 </h4>';
				formContactType();
			} else {
				contactTypePostToSession();
				$_SESSION['add_part'] = 2;
				echo '<h4 class="text-success"> Add New Contact - 2/8 </h4>';
				formContactName();
			}
			break;
		case 2:
			$err_msgs = validateContactName();
			if (count($err_msgs) > 0){
				displayErrors($err_msgs);
				echo '<h4 class="text-success"> Add New Contact - 2/8</h4>';
				formContactName();
			} else if ((isset($_POST['ct_b_next']))
					&& ($_POST['ct_b_next'] == "Next")){
				contactNamePostToSession();
				$_SESSION['add_part'] = 3;
				echo '<h4 class="text-success"> Add New Contact - 3/8</h4>';
				formContactAddress();
			} else if ((isset($_POST['ct_b_back']))
						&& ($_POST['ct_b_back'] == "Back")){
				contactNamePostToSession();
				$_SESSION['add_part'] = 1;
				echo '<h4 class="text-success"> Add New Contact - 1/8</h4>';
				formContactType();
			}
			break;
		case 3:
			echo '<h4 class="text-success"> Add New Contact </h4>';
			$err_msgs = validateContactAddress();
			if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)){
				displayErrors($err_msgs);
				formContactAddress();
			} else if (isset($_POST['ct_b_skip'])){
				$_SESSION['add_part'] = 4;
				formContactPhone();
			} else if ((isset($_POST['ct_b_next']))
					&& ($_POST['ct_b_next'] == "Next")){
				contactAddressPostToSession();
				$_SESSION['add_part'] = 4;
				formContactPhone();
			} else if ((isset($_POST['ct_b_back']))
						&& ($_POST['ct_b_back'] == "Back")){
				contactAddressPostToSession();
				$_SESSION['add_part'] = 2;
				formContactName();
			}
			break;
		case 4:
			echo '<h4 class="text-success"> Add New Contact </h4>';
			$err_msgs = validateContactPhone();
			if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)){
				displayErrors($err_msgs);
				formContactPhone();
			} else if (isset($_POST['ct_b_skip'])){
				$_SESSION['add_part'] = 5;
				formContactEmail();
			} else if ((isset($_POST['ct_b_next']))
					&& ($_POST['ct_b_next'] == "Next")){
				contactPhonePostToSession();
				$_SESSION['add_part'] = 5;
				formContactEmail();
			} else if ((isset($_POST['ct_b_back']))
						&& ($_POST['ct_b_back'] == "Back")){
				contactPhonePostToSession();
				$_SESSION['add_part'] = 3;
				formContactAddress();
			}
			break;
		case 5:
		   echo '<h4 class="text-success"> Add New Contact </h4>';
			$err_msgs = validateContactEmail();
			if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)){
				displayErrors($err_msgs);
				formContactEmail();
			} else if (isset($_POST['ct_b_skip'])){
				$_SESSION['add_part'] = 6;
				formContactWeb();
			} else if ((isset($_POST['ct_b_next']))
					&& ($_POST['ct_b_next'] == "Next")){
				contactEmailPostToSession();
				$_SESSION['add_part'] = 6;
				formContactWeb();
			} else if ((isset($_POST['ct_b_back']))
						&& ($_POST['ct_b_back'] == "Back")){
				contactEmailPostToSession();
				$_SESSION['add_part'] = 4;
				formContactPhone();
			}
			break;
		case 6:
		echo '<h4 class="text-success"> Add New Contact </h4>';
			$err_msgs = validateContactWeb();
			if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)){
				displayErrors($err_msgs);
				formContactWeb();
			} else if (isset($_POST['ct_b_skip'])){
				$_SESSION['add_part'] = 7;
				formContactNote();
			} else if ((isset($_POST['ct_b_next']))
					&& ($_POST['ct_b_next'] == "Next")){
				contactWebPostToSession();
				$_SESSION['add_part'] = 7;
				formContactNote();
			} else if ((isset($_POST['ct_b_back']))
						&& ($_POST['ct_b_back'] == "Back")){
				contactWebPostToSession();
				$_SESSION['add_part'] = 5;
				formContactEmail();
			}
			break;
		case 7:
		    echo '<h4 class="text-success"> Add New Contact </h4>';
			$err_msgs = validateContactNote();
			if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)){
				displayErrors($err_msgs);
				formContactNote();
			} else if (isset($_POST['ct_b_skip'])){
				$_SESSION['add_part'] = 8;
				formContactSave();
			} else if ((isset($_POST['ct_b_next']))
					&& ($_POST['ct_b_next'] == "Next")){
				contactNotePostToSession();
				$_SESSION['add_part'] = 8;
				formContactSave();
			} else if ((isset($_POST['ct_b_back']))
						&& ($_POST['ct_b_back'] == "Back")){
				contactNotePostToSession();
				$_SESSION['add_part'] = 6;
				formContactWeb();
			}
			break;
		case 8:
			if ((isset($_POST['ct_b_next']))
					&& ($_POST['ct_b_next'] == "Save")){
				$db_conn = connectDB();
				saveContact($db_conn);
				$db_conn = NULL;
				$_SESSION['add_part'] = 0;
				clearAddContactFromSession();
				$_SESSION['mode'] = "Display";
				formContactDisplay();
			} else if ((isset($_POST['ct_b_back']))
						&& ($_POST['ct_b_back'] == "Back")){
				echo '<h4 class="text-success"> Add New Contact </h4>';
				$_SESSION['add_part'] = 7;
				formContactNote();
			}
			break;
		default:
	}
} 
//EDIT PART----------------------------------------------------
else if($_SESSION['mode'] == "Edit"){ 
	switch ($_SESSION['edit_part']) {
		//edit part = 0 show the form
		case 0: 
		if (isset($_POST['list_select']) && isset($_POST['list_select'][0])){
			$_SESSION['ct_id'] = $_POST['list_select'][0];
			$_SESSION['edit_part'] = 1;
			$db_conn = connectDB();
			clearAddContactFromSession();
			formViewEdit($db_conn);
			$db_conn = NULL;
		} else{
			displayErrors(['Select a contact!']);
			$_SESSION['mode'] = "Display";
			formContactDisplay();
		}
		break;
		//edit part = 1 validate the fields
		case 1:
	
		$error_Global = array();
		  if(isset($_SESSION['ct_type'])){
			$error0 = validateContactType();
			$error1 = validateContactName();
			$error3 = array_merge($error0,$error1);
			if (count($error3) >0) {
				$error_Global = array_merge($error0,$error1);
			} else 
			{
				contactTypePostToSession();
				contactNamePostToSession();	
			}
		  }
		  if(isset($_SESSION['ad_type'])){
			$error4 = validateContactAddress();
			if (count($error4) >0) {
				
				$error_Global = array_merge($error4);
			}
			else{
				contactAddressPosttoSession();
			}
		  }
		  if(isset($_SESSION['ph_type'])){
			$error5 = validateContactPhone();
			if (count($error5) >0) {
				$error_Global = array_merge($error5);
			}
			else{
				contactPhonePosttoSession();
			}
		  }
		  if(isset($_SESSION['em_type'])){
			$error6 = validateContactEmail();
			if (count($error6) >0) {
				
				$error_Global = array_merge($error6);
			}
			else{
				contactEmailPosttoSession();
			}
		  }
		  if(isset($_SESSION['em_type'])){
			$error7 = validateContactEmail();
			if (count($error7) >0) {
				
				$error_Global = array_merge($error7);
			}
			else{
				contactWebPosttoSession();
			}
		  }
		  if(isset($_SESSION['we_type'])){
			$error8 = validateContactWeb();
			if (count($error8) >0) {
				
				$error_Global = array_merge($error8);
			}
			else{
				contactWebPosttoSession();
			}
		  }

		  if(isset($_SESSION['no_note'])){
			$error9 = validateContactNote();
			if (count($error9) >0) {
				
				$error_Global = array_merge($error9);
			}
			else{
				contactNotePosttoSession();
			}
		  } 
		
		  //merge little error arrays into one bit ERROR array
		  if (count($error_Global) > 0){
			  displayErrors($error_Global);
			  //print_r($errors);
			  $_SESSION['edit_part'] = 2;
			  formViewEdit(null);
		  } else {
			//print_r($_SESSION);
			  //Save updated  data to the DB
			  $db_conn = connectDB();
			  editContact($db_conn);
			  $db_conn = NULL;
			  $_SESSION['mode'] = "Display";
			  formContactDisplay();
			  clearAddContactFromSession();
		  }
		
		break;	
	}



}//End of edit part -----------------------------------------	 
	
else if($_SESSION['mode'] == "Delete"){ 
	if (isset($_POST['list_select']) && isset($_POST['list_select'][0])){
		$_SESSION['ct_id'] = $_POST['list_select'][0];
		$db_conn = connectDB();
		deleteContact($db_conn);
		$_SESSION['mode'] = "Display";
		formContactDisplay();
		$db_conn = NULL;
	} else{
		displayErrors(['Select a contact!']);
		$_SESSION['mode'] = "Display";
		formContactDisplay();
	}
} else if($_SESSION['mode'] == "View"){ 
	
	if (isset($_POST['list_select']) && isset($_POST['list_select'][0])){
		$_SESSION['ct_id'] = $_POST['list_select'][0];
		$db_conn = connectDB();
		formViewDetails($db_conn);
		$_SESSION['mode'] = "Display";
		$db_conn = NULL;
	} else{
		displayErrors(['Select a contact!']);
		$_SESSION['mode'] = "Display";
		formContactDisplay();
	}

} else if($_SESSION['mode'] == "Display"){ 
	formContactDisplay();
} 
?>

	</body>

</html>

<?php
function formContactDisplay(){
	$db_conn = connectDB();
	$fvalue = "";
	if (isset($_POST['ct_b_filter']) && isset($_POST['ct_filter'])){
		$_SESSION['ct_filter'] = trim($_POST['ct_filter']);
		$fvalue = $_SESSION['ct_filter'];
	} else if (isset($_POST['ct_b_filter_clear'])){
		$_SESSION['ct_filter'] = "";
		$fvalue = $_SESSION['ct_filter'];
	} else if (isset($_SESSION['ct_filter'])){
		$fvalue = $_SESSION['ct_filter'];
	}
?>

		
		<div>
		  <form method="POST">


		  <div class="input-group px-2">
		    <label for="ct_filter" class="pr-2 my-1">Filter Value</label>
			<input type="text"   class="form-control" name="ct_filter" id="ct_filter" value="<?php echo $fvalue; ?>">
			<input type="submit" class="btn btn-outline-primary mx-1" name="ct_b_filter" value="Filter">
			<input type="submit" class="btn btn-outline-primary mx-1" name="ct_b_filter_clear" value="Clear Filter">
		  </div>



		  <div class="row">
		    <div class="col-12 p-3" style="text-align: left;">
		    	<input type="submit"  class="btn btn-success mx-1" name ="ct_b_add" value="Add New Contact">
		    </div>
		    
		  </div>
		<?php
			displayContacts($db_conn);
			$db_conn = NULL;
		?>
		</div>
            <div class="row">
		      <div class="col-6" style="text-align: left;">
			  	<input type="submit" class="btn btn-success mx-1" name ="ct_b_view_details" value="View Details">
              </div>
		      <div class="col-6" style="text-align: right;">
			    <input type="submit" class="btn btn-success mx-1" name ="ct_b_edit" value="Edit">
			  	<input type="submit" class="btn btn-success mx-1" name ="ct_b_delete" value="Delete">
			  </div>
			</div>
		</form>
		</div>
		<div class="col"> </div>
	</div>
	</div>
<?php } ?>

