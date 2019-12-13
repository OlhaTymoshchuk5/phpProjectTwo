<!-- 
	File:    clearAddContactFromSession.php
	Purpose: to clear the session 
	Authors: Barbara Bianca Zacchi
			 Millene L B S Cesconetto
			 Olha Tymoshchuk 
-->
<?php
function clearAddContactFromSession(){
	if (isset($_SESSION['ct_type'])){
		unset($_SESSION['ct_type']);
	}
	if (isset($_SESSION['ct_first_name'])){
        unset($_SESSION['ct_first_name']);
	}
	if (isset($_SESSION['ct_last_name'])){
        unset($_SESSION['ct_last_name']);
	}
	if (isset($_SESSION['ct_disp_name'])){
        unset($_SESSION['ct_disp_name']);
	}
	if (isset($_SESSION['ad_type'])){
        unset($_SESSION['ad_type']);
	}
	if (isset($_SESSION['ad_line_1'])){
        unset($_SESSION['ad_line_1']);
	}
	if (isset($_SESSION['ad_line_2'])){
        unset($_SESSION['ad_line_2']);
	}
	if (isset($_SESSION['ad_line_3'])){
        unset($_SESSION['ad_line_3']);
	}
	if (isset($_SESSION['ad_city'])){
        unset($_SESSION['ad_city']);
	}
	if (isset($_SESSION['ad_province'])){
        unset($_SESSION['ad_province']);
	}
	if (isset($_SESSION['ad_post_code'])){
        unset($_SESSION['ad_post_code']);
	}
	if (isset($_SESSION['ad_country'])){
        unset($_SESSION['ad_country']);
	}
	if (isset($_SESSION['ph_type'])){
        unset($_SESSION['ph_type']);
	}
	if (isset($_SESSION['ph_number'])){
        unset($_SESSION['ph_number']);
	}
	if (isset($_SESSION['em_type'])){
        unset($_SESSION['em_type']);
	}
	if (isset($_SESSION['em_email'])){
        unset($_SESSION['em_email']);
	}
	if (isset($_SESSION['we_type'])){
        unset($_SESSION['we_type']);
	}
	if (isset($_SESSION['we_url'])){
        unset($_SESSION['we_url']);
	}
	if (isset($_SESSION['no_note'])){
        unset($_SESSION['no_note']);
	}
}
?>
