
<?php
	$source = $this->session->userdata("source");

    $var = $this->session->userdata("external_questions");
    $external_questions = isset($var) ? $var : FALSE;
    $var = $this->session->userdata("external_test");
    $external_test = isset($var) ? $var : FALSE;
	
	$var = $this->session->userdata("logged");
    $logged = isset($var) ? $var : '0';

	$email_guest = $this->session->userdata('email_guest');
	$email_guest = isset($email_guest) ? $email_guest : '0';					
	if ($email_guest == '1') {
		$this->session->set_userdata("logged", '0') ;
		$this->session->set_userdata('email_guest','0');
	}						
									
												// Load Header, Content and Footer
	if ($logged == '1' && $source == 'home') { 				
		include_once "includes/header_control_panel.php";			// header administrative menu 					
		
	} else {		
		if ( $external_questions || $external_test ) {				// access without login
			include_once "includes/external/header.php";        	// header main page
			
		} else {
			include_once "includes/header.php";        				// header main page	
		}    	
	}
?>

<!-- <section id="first_line" class="" style="margin-top: 0px;"> -->    
	<?php $this->load->view($name_view); ?>        
<!-- </section> -->
   
<?php	
	
 	$source = $this->session->userdata("source");
    $var = $this->session->userdata("external_questions");
    $external_questions = isset($var) ? $var : FALSE;
    $var = $this->session->userdata("external_test");
    $external_test = isset($var) ? $var : FALSE;
	$var = $this->session->userdata("logged");
    $logged = isset($var) ? $var : '0';


	if ( ($logged == '1') && ($source == 'home') ) { 				
		include_once "includes/footer_control_panel.php";			// footer administrative menu
		 					
	} else {		
		if ( $external_questions || $external_test ) { 				// access without login
			include_once "includes/external/footer.php";        	// footer external 
			
		} else {		
 	   		include_once "includes/footer.php";						// footer main page
		}
	}    
?>
