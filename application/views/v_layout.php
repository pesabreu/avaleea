
<?php
	$source = $this->session->userdata("source");
	
	$var = $this->session->userdata("logged");
    $logged = isset($var) ? $var : '0';
	
	if ($logged == '1' && $source == 'home') { 				
		include "includes/header_control_panel.php";			// header administrative menu 					
	} else {
    	include "includes/header.php";        					// header main page
	}

	$email_guest = $this->session->userdata('email_guest');
	$email_guest = isset($email_guest) ? $email_guest : '0';					
	if ($email_guest == '1') {
		$this->session->set_userdata("logged", '0') ;
		$this->session->set_userdata('email_guest','0');
	}						
?>


<!-- <section id="first_line" class="" style="margin-top: 0px;"> -->    
	<?php $this->load->view($name_view); ?>        
<!-- </section> -->

   
<?php	
	$source = $this->session->userdata("source");
	
	$var = $this->session->userdata("logged");
    $logged = isset($var) ? $var : '0';

	if ($logged == '1' && $source == 'home') { 				
		include "includes/footer_control_panel.php";			// footer administrative menu 					
	} else {
 	   	include "includes/footer.php";		
	}    
?>
